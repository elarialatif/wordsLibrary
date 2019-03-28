<?php

namespace App\Http\Controllers\editor;

use App\ArticleCategory;
use App\Helper\Steps;
use App\Models\Article;
use App\Models\ArticleFiles;
use App\Models\AssignTask;
use App\Models\Categery;
use App\Models\ContentList;
use App\Repository\ArticalRepository;
use App\Repository\ContentListsRepository;
use App\Repository\ListRepository;
use App\Repository\NotificationRepository;
use App\Repository\TaskRepository;
use App\Repository\UserRateRepository;
use App\Repository\UsersRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use StreamLab\StreamLabProvider\Facades\StreamLabFacades;

class EditorController extends Controller
{
    private $articalRepo;

    public function __construct(ArticalRepository $articalRepo)
    {
        $this->articalRepo = $articalRepo;
    }

    public function index()
    {

        $tasks = AssignTask::where(['step' => Steps::UPLOADING_FILE, 'user_id' => auth()->id()])->get()->pluck('list_id')->toArray();
        $lists = ContentList::whereIn('id', $tasks)->where('step', Steps::INSERTING_ARTICLE)->get()->pluck('id')->toArray();
        $fiels = ArticleFiles::whereIn('list_id', $lists)->get();
        return view('editor.index', compact('fiels', 'categories_all'));
    }

    public function myLists()
    {

        $tasks = AssignTask::where(['step' => Steps::UPLOADING_FILE, 'user_id' => auth()->id()])->get()->pluck('list_id')->toArray();
        $lists = ContentList::whereIn('id', $tasks)->where('step', Steps::UPLOADING_FILE)->get();
        return view('editor.mylists', compact('lists', 'categories_all'));
    }

    public function createArticle($file_id, $level, $page = 'refused/lists', $flag = 0)
    {
        $articleObject = new Article();
        $type = $articleObject->getNormalArticleValue();
        $data = $this->articalRepo->analyze($file_id);
        if ($data == false) {
            return redirect()->back()->withErrors(['الملف فارغ او مكتوب بالانجليزية']);
        }

        $orginalFile = $data['orginalFile'];
        $list = $data['list'];
        if ($list == null) {
            return redirect()->back()->with('error', ' الموضوع غير موجود');
        }
        $categories_all = Categery::all();
        if ($list->step != Steps::INSERTING_ARTICLE && $list->step != Steps::reSendToEditorFormReviewer) {
            return redirect('editor/mylists')->withErrors('غير مسموح لك الدخول إلى هنا');
        }
        $articleCheck = Article::where(['list_id' => $list->id, 'level' => $level])->first();
        if ($flag != 0 && $articleCheck != null) {
            $type = $articleObject->getStretchArticleValue();
        }
        if ($flag == 1 && $articleCheck == null) {
            return redirect()->back()->withErrors(['ادخال المقال المختصر اولا ']);
        }
        return view('editor.article.create', compact('orginalFile', "list", "file_id", "categories_all", "level", 'page', 'type'));
    }


    public function saveArticle(Request $request)
    {
        if (\request('articleStretch')) {
            $request->validate([
                'articleStretch' => 'required',
            ],
                ['articleStretch.required' => 'المقال مطلوب ',]);
        } else {
            $request->validate([
                'articleNormal' => 'required',
                'hint' => 'required',
                'poll' => 'required',
            ],
                [
                    'articleNormal.required' => 'المقال مطلوب ',
                    'hint.required' => 'مقدمة السؤال مطلوبة ',
                    'poll.required' => 'السؤال  مطلوب ',
                    ]);
        }


        DB::transaction(function () {
            $articleCheck = Article::where(['list_id' => \request('list_id'), 'level' => \request('level')])->first();
            if ($articleCheck) {
                $article = Article::find($articleCheck->id);

            } else {
                $article = new Article();



            }
            if(\request('hint')){
                $article->pollHint = \request('hint');
                $article->poll = \request('poll');
            }


            $article->list_id = \request('list_id');
            $article->level = \request('level');

            $article->user_id = auth()->id();
            if (\request('articleStretch')) {
                $article->stretchArticle = \request('articleStretch');
            } else {
                $article->article = \request('articleNormal');

            }

            //  $article->step = Steps::INSERTING_ARTICLE;
            $article->save();

        });
        session()->flash('success', 'تمت اضافة المقال بنجاح ');
        return redirect()->back();
    }

    public function sendArticleOfListToReviewer($List_id)
    {
        $data['user_id'] = auth()->id();
        $data['list_id'] = $List_id;
        $data['active'] = 1;
        UserRateRepository::save($data);

        ContentListsRepository::updateStep($List_id, Steps::REVIEW_ARTICLE);
        $name = Carbon::now() . "  تم  الإرسال إلى المراجع بتاريخ ";
        Steps::SaveLogRow($name, ' إرسال', 'content_lists', $List_id);
        return redirect('editor/index')->with('success', 'تم الإرسال بنجاح');
    }

    public function reSendListOfArticleToReviewer($List_id)
    {
        $data['active'] = 1;
        UserRateRepository::update(auth()->id(), $List_id, $data);
        ContentListsRepository::updateStep($List_id, Steps::reSendToReviewerFormEditor);
//Notification/////
        NotificationRepository::notify($List_id, Steps::REVIEW_ARTICLE);
        $user_id = TaskRepository::findWhereAndStep('list_id', $List_id, Steps::REVIEW_ARTICLE);
        $user = UsersRepository::find($user_id);
        $name = Carbon::now() . "بتاريخ" . $user->name . "تمت إعادة الإرسال إلى المراجع ";
        Steps::SaveLogRow($name, 'إعادة إرسال', 'content_lists', $List_id);
        ///end Notification////
        return redirect()->back()->with('success', 'تمت إعادة الإرسال بنجاح');
    }

    public function refusedLists()
    {

        $tasks = AssignTask::where(['step' => Steps::UPLOADING_FILE, 'user_id' => auth()->id()])->get()->pluck('list_id')->toArray();
        $lists = ContentList::with('level', 'grade')->whereIn('id', $tasks)->where('step', Steps::reSendToEditorFormReviewer)->get();
        $tasksForAnlazer = AssignTask::where(['step' => Steps::ANALYZING_FILE])->whereIn('list_id', $tasks)->get()->pluck('list_id')->toArray();

        $Refusedlists = ContentList::with('level', 'grade')->where('step', Steps::UPLOADING_FILE)->whereIn('id', $tasksForAnlazer)->get();

        return view('editor.refusedLists', compact('lists', 'categories_all', 'Refusedlists'));

    }

}
