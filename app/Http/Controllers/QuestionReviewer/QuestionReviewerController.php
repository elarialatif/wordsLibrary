<?php

namespace App\Http\Controllers\QuestionReviewer;

use App\Helper\ArticleLevels;
use App\Helper\IssuesSteps;
use App\Http\Controllers\Controller;
use App\Helper\UsersTypes;
use App\Models\AssignTask;
use App\Models\Issues;
use App\Repository\ArticalRepository;
use App\Repository\IssuesRepository;
use App\Repository\NotificationRepository;
use App\Repository\UserRateRepository;
use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Helper\Steps;
use App\Models\Article;
use App\Models\ContentList;
use App\Repository\ContentListsRepository;
use App\Repository\QuestionsRepository;
use App\Repository\TaskRepository;
use Illuminate\Notifications\Notification;
use StreamLab\StreamLabProvider\Facades\StreamLabFacades;
use StreamLab\StreamLabProvider\StreamLab;

class QuestionReviewerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $current = AssignTask::where('step', Steps::Review_Question)->get()->pluck('list_id')->toArray();
        $list = ContentList::where('step', Steps::Review_Question)->whereNotIn('id', $current)->get();
        return view('questionCreator.question.index', compact('list'));
    }

    public function index()
    {
        $tasks = TaskRepository::userTasks(Steps::Review_Question, '\App\Models\ContentList');
        $list = ContentList::where('step', Steps::Review_Question)->whereIn('id', $tasks)->get();
        return view('questionCreator.question.myList', compact('list'));
    }

    public function backFromCreator()
    {
        $tasks = TaskRepository::userTasks(Steps::Review_Question, '\App\Models\ContentList');
        $list = ContentList::where('step', Steps::ResendToQuestionReviewer)->whereIn('id', $tasks)->get();
        if ($list->count() > 0) {
            $list_id = $list->pluck('id')->toArray();

            foreach ($list_id as $list_id) {
                $questionIds = QuestionsRepository::findIds('list_id', $list_id);
//                $issuesQuestion = IssuesRepository::findWhereIn($questionIds, 'question');
                $closedQuestion = IssuesRepository::getAllIssuesForQuestion($questionIds, 'question', IssuesSteps::CloseByCreator);
                $issues_id = $closedQuestion->pluck('field_id')->toArray();
                $final = array_diff($questionIds, $issues_id);

                // dd($issues_id);

                $finalQuestion = QuestionsRepository::findWhereIn('id', $final);
                $finalQuestion2 = QuestionsRepository::findWhereIn('id', $issues_id);
                $finalArticles_ids = array_diff($finalQuestion->pluck('artical_id')->toArray(), $finalQuestion2->pluck('artical_id')->toArray());

                //$artical_id = $finalarticls_ids->pluck('artical_id')->toArray();
                Article::whereIn('id', $finalArticles_ids)->update(['status' => ArticleLevels::Review]);
            }
        }
        return view('questionCreator.question.backContent', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function review($artical_id, $page = 'myList')
    {
        $questions = QuestionsRepository::findWhere('artical_id', $artical_id);
        $artical = Article::where('id', $artical_id)->first();
        if ($artical == null) {
            return redirect()->back()->with('error', 'المقال غير موجود');
        }
        if (auth()->user()->role != UsersTypes::SUPERADMIN && auth()->user()->role != UsersTypes::ADMIN) {
            $task = AssignTask::where(['list_id' => $artical->list_id, 'step' => Steps::Review_Question])->first();
            if ($task) {
                if ($task->user_id != auth()->id()) {
                    return redirect()->back()->withErrors('هذا الموضوع تابع لمستخدم اخر ');
                }
            } elseif (!$task) {
                TaskRepository::save($artical->list_id, Steps::Review_Question);
            }
        }
        $list = ContentList::find($artical->list_id);
        if ($list->step != Steps::Review_Question && $list->step != Steps::ResendToQuestionReviewer) {
            return redirect('questionReviewer/myList')->withErrors('غير مسموح لك الدخول الى هنا');
        }
        return view('questionReviewer.review', compact('artical', 'questions', 'page'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function done($artical_id)
    {
        $questionsIds = QuestionsRepository::findIds('artical_id', $artical_id);
        $issues = IssuesRepository::findWhereInAndStatus($questionsIds, 'question', IssuesSteps::DoneByEditor);
        if ($issues->count() > 0) {
            return redirect()->back()->withError('يجب الانتهاء من كل الملاحظات');
        }
        Article::where('id', $artical_id)->update(['status' => 1]);
        return redirect()->back()->with('success', 'تم المراجعه بنجاح ');
    }

    public function send($list_id)
    {
        $lang = TaskRepository::findWhereAndStep('list_id', $list_id, Steps::Languestic);
        $questions = QuestionsRepository::findIds('list_id', $list_id);
        $status = Article::where(['list_id' => $list_id, 'status' => 0])->first();
        if (!empty($status)) {
            return redirect()->back()->withErrors(' يجب امراجعه كافه الاسئله اولا');
        }
        $issues = IssuesRepository::getAllIssuesForQuestion($questions, 'question', IssuesSteps::CloseByCreator);
        if ($issues->count() > 0) {
            ContentListsRepository::updateStep($list_id, Steps::ResendToQuestionCreator);
            //Notification/////
            NotificationRepository::notify($list_id, Steps::Create_Question);
            ///end Notification////
            $user_id = TaskRepository::findWhereAndStep('list_id', $list_id, Steps::Create_Question);
            $data['active'] = 0;
            UserRateRepository::update($user_id, $list_id, $data);
            return redirect()->back()->with('success', 'تم الارسال الي مدخل الاسئله بنجاح ');
        } else {
            if (!empty($lang)) {
                ContentListsRepository::updateStep($list_id, Steps::ResendToLanguestic);
                //Notification/////
                NotificationRepository::notify($list_id, Steps::Languestic);
                ///end Notification////
                return redirect()->back()->with('success', 'تم اعاده الارسال الي المراجع اللغوي بنجاح ');
            }
            $data['user_id'] = auth()->id();
            $data['list_id'] = $list_id;
            $data['active'] = 1;
            UserRateRepository::save($data);
            ContentListsRepository::updateStep($list_id, Steps::Languestic);
            return redirect()->back()->with('success', 'تم الارسال الي المراجع اللغوي بنجاح ');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        QuestionsRepository::delete($id);
        return redirect()->back()->with('success', 'تم المسح بنجاح ');
    }
}
