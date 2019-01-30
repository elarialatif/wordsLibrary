<?php

namespace App\Http\Controllers\reviewer;

use App\Helper\IssuesSteps;
use App\Helper\Steps;
use App\Helper\UsersTypes;
use App\Models\Article;
use App\Models\AssignTask;
use App\Models\ContentList;
use App\Notifications\ResendList;
use App\Repository\ArticalRepository;
use App\Repository\ContentListsRepository;
use App\Repository\IssuesRepository;
use App\Repository\ListRepository;
use App\Repository\NotificationRepository;
use App\Repository\QuestionsRepository;
use App\Repository\TaskRepository;
use App\Repository\UserRateRepository;
use App\Repository\UsersRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Notification;
use StreamLab\StreamLabProvider\Facades\StreamLabFacades;

class ReviewerController extends Controller
{
    public function index()
    {
        $tasks = TaskRepository::findTasksOfallUser(Steps::REVIEW_ARTICLE);
        $lists = ContentList::with('level', 'grade')->whereNotIn('id', $tasks)->get();
        return view('reviewer.index', compact('lists'));
    }

    public function viewArticle($list_id, $level, $page = null)
    {
        if ($list_id == null) {
            return redirect()->back()->with('error', 'الموضوع  غير موجود');
        }
        $task = AssignTask::where(['list_id' => $list_id, 'step' => Steps::REVIEW_ARTICLE])->first();
        if ($task) {
            if ($task->user_id != auth()->id()) {
                return redirect()->back()->withErrors('هذا الوضوع تابع لمستخدم اخر ');
            }
        }
        if (!$task) {
            TaskRepository::save($list_id, Steps::REVIEW_ARTICLE);
        }
        $article = Article::where(['list_id' => $list_id, 'level' => $level])->first();

        $list = ContentList::find($list_id);
        if ($list == null) {
            return redirect()->back()->with('error', 'الموضوع  غير موجود');
        }
        if ($list->step != Steps::REVIEW_ARTICLE && $list->step != Steps::reSendToReviewerFormEditor) {
            return redirect('reviewer/mylists')->withErrors('غير مسموح لك الدخول الى هنا');
        }
        return view('reviewer.viewArticle', compact('article', 'page'));
    }

    public function myLists($page = null)
    {
        $tasks = AssignTask::where(['step' => Steps::REVIEW_ARTICLE, 'user_id' => auth()->id()])->get()->pluck('list_id')->toArray();
        $lists = ContentList::whereIn('id', $tasks)->where('step', Steps::REVIEW_ARTICLE)->get();
        if ($page == "resendingLists") {
            return redirect('reviewer/resending/lists');
        }

        // $lists = ContentList::with('level', 'country', 'grade')->whereIn('id', $tasks)->get();
        return view('reviewer.mylists', compact('lists'));
    }

    public function resendingLists()
    {

        $tasks = AssignTask::where(['step' => Steps::REVIEW_ARTICLE, 'user_id' => auth()->id()])->get()->pluck('list_id')->toArray();

        $lists = ContentList::whereIn('id', $tasks)->where('step', Steps::reSendToReviewerFormEditor)->get();
        return view('reviewer.resendLists', compact('lists'));
    }

    public function SendToCreateQuestion($list_id)
    {
        $questions = QuestionsRepository::findIds('list_id', $list_id);
        if (!empty($questions)) {
            $issues = IssuesRepository::getAllIssuesForQuestion($questions, 'question', IssuesSteps::CloseByCreator);
            if ($issues->count() > 0) {
                ContentListsRepository::updateStep($list_id, Steps::ResendToQuestionCreator);
                //Notification/////
                NotificationRepository::notify($list_id, Steps::Create_Question);
                ///end Notification//

                return redirect()->back()->with('success', 'تم ارسال الى مدخل الاسئلة ');
            } else {
                ContentListsRepository::updateStep($list_id, Steps::ResendToLanguestic);
                NotificationRepository::notify($list_id, Steps::Languestic);
                return redirect()->back()->with('success', 'تم ارسال الى المراجع اللغوى');
            }
        }
        $data['user_id'] = auth()->id();
        $data['list_id'] = $list_id;
        $data['active'] = 1;
        UserRateRepository::save($data);
        ContentListsRepository::updateStep($list_id, Steps::Create_Question);
        return redirect()->back()->with('success', ' تم ارسال الى مدخل الاسئلة ');
    }

    public function reSendToEditor($list_id)
    {
        $user_id = TaskRepository::findWhereAndStep('list_id', $list_id, Steps::UPLOADING_FILE);
        $data['active'] = 0;
        UserRateRepository::update($user_id, $list_id, $data);
        ContentListsRepository::updateStep($list_id, Steps::reSendToEditorFormReviewer);
        NotificationRepository::notify($list_id, Steps::UPLOADING_FILE);
        return redirect()->back()->with('success', 'تم اعادة الارسال الى المحرر ');
    }
}
