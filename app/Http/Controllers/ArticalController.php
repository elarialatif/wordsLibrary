<?php

namespace App\Http\Controllers;

use App\Exports\ArticalsExport;
use App\Helper\Steps;
use App\Helper\UsersTypes;
use App\Models\ArticleFiles;
use App\Models\AssignTask;
use App\Models\Categery;
use App\Models\ContentList;
use App\Models\Country;
use App\Models\Grade;
use App\Models\Word;
use App\Repository\ArticalRepository;
use App\Repository\ContentListsRepository;
use App\Repository\GradesRepository;
use App\Repository\LevelsRepository;
use app\Repository\ListRepository;
use App\Repository\TaskRepository;
use Complex\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ArticalController extends Controller
{

    private $articalRepo;

    public function __construct(ArticalRepository $articalRepo)
    {
        $this->articalRepo = $articalRepo;
    }


    public function uploadArticleFile($list_id)
    {


        //$artical = $this->articalRepo->hello();
        //return view('articles.upload', compact('artical'));
        $categories_all = Categery::with('children')->whereNull('parent_id')->get();
        //dd($artical);
        //  $countries = Country::all();
        $grades = GradesRepository::all();

        return view('editor.article.upload', compact('categories_all', 'grades', 'list_id'));
    }

    public function saveUploadedArticleFile(Request $request)
    {
        try {
            $name = "";
            if ($request->file('filename')) {
                $name = $request->file('filename')->getClientOriginalName();
            }
            $request->validate([
                'filename' => 'required|uniqueFileName:' . $name . '|mimes:docx,doc,txt',
                'articleName' => 'required',
                'cat_id_list' => 'required',
                'publish_details' => 'required',
                'editor' => 'required',
                'reference' => 'required',
                'list_id' => 'required',

            ],
                ['filename.required' => 'الملف مطلوب',
                    'unique_file_name' => 'الملف متكرر',
                    'cat_id_list.required' => 'التصنيف مطلوب',
                    'filename.mimes' => 'الملفات المسموحه لك هى   doc and .docx and .txt',

                    'articleName.required' => 'اسم المقال مطلوب ',
                    'publish_details.required' => 'بيانات النشر مطلوبه ',
                    'editor.required' => 'اسم المولف مطلوب ',
                    'reference.required' => 'اسم المرجع مطلوب ',
                    'list_id.required' => 'اسم الموضوع مطلوب ']);
            $data = $this->articalRepo->analyze($request->file('filename'));
            if ($data['fileTextContent'] == null) {
                return redirect()->back()->withErrors(['الملف فارغ او مكتوب بالانجليزية']);
            }
            DB::transaction(function () use ($request) {


                $article = ArticleFiles::where('list_id', $request->list_id)->first();
                if ($article) {
                    return redirect('allLists')->withErrors('توجد ملفات لهذا الموضوع ');
                }
                $task = AssignTask::where(['list_id' => $request->list_id, 'step' => Steps::UPLOADING_FILE])->first();
                if ($task) {
                    if ($task->user_id != auth()->id()) {
                        return redirect('allLists')->withErrors('هذا الوضوع تابع لمستخدم اخر ');
                    }
                }
                if (!$task) {
                    TaskRepository::save($request->list_id, Steps::UPLOADING_FILE);
                }
                ArticalRepository::save($request);


            });

            return redirect('allLists')->with('success', 'تم رفع الملف بنجاح');
        } catch (Exception $e) {
            return redirect('allLists')->with('success', 'تم رفع الملف بنجاح');
        }
    }

    public function allFiles()
    {
        //$countries = Country::all();
        $levels = LevelsRepository::all();
        $grades = GradesRepository::all();
        $allFiles = ArticleFiles::with('lists')->get();
        return view('superadmin.allFiles', compact('allFiles', 'levels', 'grades'));
    }

    public function filterFiles($grade_id)
    {
        // $countries = Country::all();
        $levels = LevelsRepository::all();
        $query = ArticleFiles::with('lists');
        $grades = GradesRepository::all();
        if ($grade_id && $grade_id != 'all') {
            $Lists = ContentList::where('grade_id', $grade_id)->get()->pluck('id')->toArray();
            $query->whereIn('list_id', $Lists);
        }
        $allFiles = $query->get();
        return view('superadmin.allFiles', compact('allFiles', 'levels', 'grades'));
    }

    public function analysisUploadFiles($id)
    {
        $file = ArticleFiles::find($id);
        if (auth()->user()->role != UsersTypes::SUPERADMIN && auth()->user()->role != UsersTypes::ADMIN) {
            $task = AssignTask::where(['list_id' => $file->list_id, 'step' => Steps::ANALYZING_FILE])->first();
            if ($task) {
                if ($task->user_id != auth()->id()) {
                    return redirect()->back()->withErrors('هذا الوضوع تابع لمستخدم اخر ');
                }
            } elseif (!$task) {
                TaskRepository::save($file->list_id, Steps::ANALYZING_FILE);
                ContentListsRepository::updateStep($file->list_id, Steps::ANALYZING_FILE);
            }
        }
        if ($file) {
            $data = $this->articalRepo->analyze($id);
            if ($data == false) {
                return redirect()->back()->withErrors(['الملف فارغ او مكتوب بالانجليزية']);
            }
            $file_id = $id;
            $finalArray = $data['finalArray'];
            $Array = $data['Array'];
            $orginalFile = $data['orginalFile'];
            $list = $data['list'];
            $File = $data['file'];
            return view('listsanalayzer.articles.results')->with(compact('finalArray'))->with(compact('Array', 'orginalFile', 'list', 'file_id', 'File'));
        }
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function filter(Request $request)
    {
        $type = $request->type;
        $Array = session()->get('array');

        //$finalArray = session()->get('finalArray');

        if ($type == 'sort') {
            //sort($Array);

            sort($Array);
        } elseif ($type == 'rsort') {

            rsort($Array);
        }
        $finalArray = array_count_values($Array);
        if ($type == 'arsort') {
            arsort($finalArray);
        }
        return view('listsanalayzer.articles.results')->with(compact('finalArray'))->with(compact('Array'));
    }


    public function exportCSV()
    {
        session()->get('array');
        return Excel::download(new ArticalsExport(session()->get('array'), session()->get('finalArray')), 'list.xlsx');
        //return redirect(url(''));
    }
}
