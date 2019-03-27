<?php

namespace App\Http\Controllers\LanguesticReviewer;

use App\Models\Vocab;
use App\Repository\NotificationRepository;
use App\Repository\SoundsRepository;
use App\Repository\UserRateRepository;
use App\Repository\UsersRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helper\ArticleLevels;
use App\Helper\IssuesSteps;
use App\Helper\UsersTypes;
use App\Models\AssignTask;
use App\Models\Issues;
use App\Repository\ArticalRepository;
use App\Repository\IssuesRepository;
use App\Http\Controllers;
use App\Helper\Steps;
use App\Models\Article;
use App\Models\ContentList;
use App\Repository\ContentListsRepository;
use App\Repository\QuestionsRepository;
use App\Repository\TaskRepository;

class LanguesticController extends Controller
{
    public function home()
    {
        $current = AssignTask::where('step', Steps::Languestic)->get()->pluck('list_id')->toArray();
        $list = ContentList::where('step', Steps::Languestic)->whereNotIn('id', $current)->get();
        return view('languestic.index', compact('list'));
    }

    public function index()
    {
        $tasks = TaskRepository::userTasks(Steps::Languestic, '\App\Models\ContentList');
        $list = ContentList::where('step', Steps::Languestic)->whereIn('id', $tasks)->get();
        return view('languestic.myList', compact('list'));
    }

    public function backFromCreator()
    {
        $tasks = TaskRepository::userTasks(Steps::Languestic, '\App\Models\ContentList');

        $list = ContentList::where('step', Steps::ResendToLanguestic)->whereIn('id', $tasks)->get();
//        if ($list->count() > 0) {
//            $list_id = $list->pluck('id')->toArray();
//            foreach ($list_id as $list_id) {
//                $questionIds = QuestionsRepository::findIds('list_id', $list_id);
//                $articalIds=Article::where('list_id',$list_id)->get()->pluck('id')->toArray();
//                //May be Error =>must Not check for IssuesStep////
//                $closedarticals=IssuesRepository::getIssuesForQuestion($articalIds,'article',IssuesSteps::CloseByCreator,auth()->id());
//                $closedQuestion=IssuesRepository::getIssuesForQuestion($questionIds,'question',IssuesSteps::CloseByCreator,auth()->id());
//                $issues_id = $closedQuestion->pluck('field_id')->toArray();
//                $articalWithIssues = QuestionsRepository::findWhereIn('id', $issues_id);
//                $articalIdsWithIssues = $articalWithIssues->pluck('artical_id')->toArray();
//                $artical_id1 = $closedarticals->pluck('field_id')->toArray();
//                $final = array_diff($questionIds, $issues_id);
//                $finalartical = array_diff($articalIds, $artical_id1);
//                $finalQuestion = QuestionsRepository::findWhereIn('id', $final);
//                $artical_id = $finalQuestion->pluck('artical_id')->toArray();
//                $articals_id=array_intersect($finalartical , $artical_id);
//                Article::whereIn('id', $articals_id)->update(['status' => ArticleLevels::Review]);
////                $articalNotReview=$artical_id1 + $articalIdsWithIssues;
////               // Article::whereIn('id', $articalNotReview)->update(['status' => ArticleLevels::notReview]);
//            }
//        }

        return view('languestic.backContent', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function review($artical_id, $page = 'myList')
    {
        $questionType = new Article();
        $questions = \App\Models\Question::where(['artical_id' => $artical_id, 'type' => $questionType->getNormalArticleValue()])->get();
        $questionStretch = \App\Models\Question::where(['artical_id' => $artical_id, 'type' => $questionType->getStretchArticleValue()])->get();
        $artical = Article::where('id', $artical_id)->first();
        $vocab = Vocab::where(['list_id' => $artical->list_id, 'level' => $artical->level])->get();
        $list = ContentList::find($artical->list_id);
        if ($list == null) {
            return redirect()->back()->with('error', 'المقال غير موجود');
        }
        if (auth()->user()->role != UsersTypes::SUPERADMIN && auth()->user()->role != UsersTypes::ADMIN) {
            $task = AssignTask::where(['list_id' => $artical->list_id, 'step' => Steps::Languestic])->first();
            if ($task) {
                if ($task->user_id != auth()->id()) {
                    return redirect()->back()->withErrors('هذا الموضوع تابع لمستخدم آخر ');
                }
            } elseif (!$task) {
                TaskRepository::save($artical->list_id, Steps::Languestic);
            }
        }

        if ($list->step != Steps::Languestic && $list->step != Steps::ResendToLanguestic) {
            return redirect('languestic/mylists')->withErrors('غير مسموح لك الدخول إلى هنا');
        }
        return view('languestic.review', compact('vocab', 'artical', 'questionStretch', 'questions', 'page'));
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
        $issuesQuestions = IssuesRepository::getIssuesForQuestion($questionsIds, 'question', IssuesSteps::DoneByEditor, auth()->id());
        $issuesArtical = IssuesRepository::getAllIssuesForArticle($artical_id, 'article', IssuesSteps::DoneByEditor, auth()->id());
        if ($issuesQuestions->count() > 0 || $issuesArtical->count() > 0) {
            return redirect()->back()->withError('يجب الانتهاء من كل الملاحظات');
        }
        Article::where('id', $artical_id)->update(['status' => 1]);
        return redirect()->back()->with('success', 'تمتالمراجعة بنجاح ');
    }


    public function send($list_id)
    {
        $qualityUser = TaskRepository::findWhereAndStep('list_id', $list_id, Steps::Quality);
        $artical = Article::where('list_id', $list_id)->get()->pluck('id')->toArray();
        $sound = SoundsRepository::findWhereIn('article_id', $artical)->pluck('id')->toArray();
        $questions = QuestionsRepository::findIds('list_id', $list_id);
        $list = ContentListsRepository::find($list_id);
        $status = Article::where(['list_id' => $list_id, 'status' => 0])->first();
        if (!empty($status)) {
            return redirect()->back()->withErrors(' يجب مراجعه كافه المحتوي اولا');
        }

        $issuesQuestion = IssuesRepository::getAllIssuesForQuestion($questions, 'question', IssuesSteps::CloseByCreator);
        $issuesArtical = IssuesRepository::getAllIssuesForQuestion($artical, 'article', IssuesSteps::CloseByCreator);
        // $issuesSound = IssuesRepository::getAllIssuesForQuestion($sound, 'sound', IssuesSteps::CloseByCreator);
        if ($issuesArtical->count() > 0) {
            ContentListsRepository::updateStep($list_id, Steps::reSendToEditorFormReviewer);
            $user_id = TaskRepository::findWhereAndStep('list_id', $list_id, Steps::UPLOADING_FILE);
            $data['active'] = 0;
            UserRateRepository::update($user_id, $list_id, $data);
            if ($issuesQuestion->count() > 0) {
                $user_id = TaskRepository::findWhereAndStep('list_id', $list_id, Steps::Create_Question);
                $data['active'] = 0;
                UserRateRepository::update($user_id, $list_id, $data);
            }
            //Notification/////
            NotificationRepository::notify($list_id, Steps::UPLOADING_FILE);
            $user_id = TaskRepository::findWhereAndStep('list_id', $list_id, Steps::UPLOADING_FILE);
            $user = UsersRepository::find($user_id);
            $name = Carbon::now() . "بتاريخ" . $user->name . "تمت إعادة الإرسال إلى المحرر ";
            Steps::SaveLogRow($name, 'إعادة إرسال', 'content_lists', $list_id);
            ///end Notification////
            return redirect()->back()->with('success', 'تم الإرسال الي مدخل المقالات بنجاح ');
        }
        if ($issuesQuestion->count() > 0) {
            ContentListsRepository::updateStep($list_id, Steps::ResendToQuestionCreator);
            $user_id = TaskRepository::findWhereAndStep('list_id', $list_id, Steps::Create_Question);
            $data['active'] = 0;
            UserRateRepository::update($user_id, $list_id, $data);
            //Notification/////
            NotificationRepository::notify($list_id, Steps::Create_Question);
            ///end Notification////
            $user_id = TaskRepository::findWhereAndStep('list_id', $list_id, Steps::Create_Question);
            $user = UsersRepository::find($user_id);
            $name = Carbon::now() . "بتاريخ" . $user->name . "تمت إعادة الإرسال إلى محرر الأسئلة ";
            Steps::SaveLogRow($name, 'إعادة إرسال', 'content_lists', $list_id);
            return redirect()->back()->with('success', 'تم الإرسال الي مدخل الأسئلة بنجاح ');
        }
//        if ($issuesSound->count() > 0) {
//            ContentListsRepository::updateStep($list_id, Steps::ResendToSound);
//            return redirect()->back()->with('success', 'تم إعادة الإرسال الي مدخل الصوت بنجاح ');
//        }
        if ($qualityUser != null) {

            //Notification/////
            NotificationRepository::notify($list_id, Steps::Quality);
            ///end Notification////
            ContentListsRepository::updateStep($list_id, Steps::ResendToQuality);
            $user_id = TaskRepository::findWhereAndStep('list_id', $list_id, Steps::Quality);
            $user = UsersRepository::find($user_id);
            $name = Carbon::now() . "بتاريخ" . $user->name . "تمت إعادة الإرسال إلى الجودة ";
            Steps::SaveLogRow($name, 'إعادة إرسال', 'content_lists', $list_id);
            return redirect()->back()->with('success', 'تمت إعادة الإرسال الي الجودة بنجاح ');
        } else {
            $data['user_id'] = auth()->id();
            $data['list_id'] = $list_id;
            $data['active'] = 1;
            UserRateRepository::save($data);
            ContentListsRepository::updateStep($list_id, Steps::Quality);

            $name = Carbon::now() . "  تم  الإرسال إلى الجودة بتاريخ ";
            Steps::SaveLogRow($name, ' إرسال', 'content_lists', $list_id);
            return redirect()->back()->with('success', 'تم الإرسال الي الجودة بنجاح ');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
//    public function destroy($id)
//    {
//        QuestionsRepository::delete($id);
//        return redirect()->back()->with('success', 'تم المسح بنجاح ');
//    }
}
