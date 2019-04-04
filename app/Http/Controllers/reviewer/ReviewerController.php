<?php
namespace App\Http\Controllers\reviewer;

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

class ReviewerController extends Controller
{
    public function home()
    {
        $current = AssignTask::where('step', Steps::REVIEW_ARTICLE)->get()->pluck('list_id')->toArray();
        $list = ContentList::where('step', Steps::REVIEW_ARTICLE)->whereNotIn('id', $current)->get();
        return view('languestic.index', compact('list'));
    }

    public function index()
    {
        $tasks = TaskRepository::userTasks(Steps::REVIEW_ARTICLE, '\App\Models\ContentList');
        $list = ContentList::where('step', Steps::REVIEW_ARTICLE)->whereIn('id', $tasks)->get();
        return view('languestic.myList', compact('list'));
    }

    public function backFromCreator()
    {
        $tasks = TaskRepository::userTasks(Steps::REVIEW_ARTICLE, '\App\Models\ContentList');
        $list = ContentList::where('step', Steps::reSendToReviewerFormEditor)->whereIn('id', $tasks)->get();
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
            $task = AssignTask::where(['list_id' => $artical->list_id, 'step' => Steps::REVIEW_ARTICLE])->first();
            if ($task) {
                if ($task->user_id != auth()->id()) {
                    return redirect()->back()->withErrors('هذا الموضوع تابع لمستخدم آخر ');
                }
            } elseif (!$task) {
                TaskRepository::save($artical->list_id, Steps::REVIEW_ARTICLE);
            }
        }
        if ($list->step != Steps::REVIEW_ARTICLE && $list->step != Steps::reSendToReviewerFormEditor) {
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
        return redirect()->back()->with('success', 'تمت المراجعة بنجاح ');
    }


    public function send($list_id)
    {
        $langUser = TaskRepository::findWhereAndStep('list_id', $list_id, Steps::Languestic);
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
                $user_id = TaskRepository::findWhereAndStep('list_id', $list_id, Steps::UPLOADING_FILE);
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
            ContentListsRepository::updateStep($list_id, Steps::reSendToEditorFormReviewer);
            $user_id = TaskRepository::findWhereAndStep('list_id', $list_id, Steps::UPLOADING_FILE);
            $data['active'] = 0;
            UserRateRepository::update($user_id, $list_id, $data);
            //Notification/////
            NotificationRepository::notify($list_id, Steps::UPLOADING_FILE);
            ///end Notification////
            $user_id = TaskRepository::findWhereAndStep('list_id', $list_id, Steps::UPLOADING_FILE);
            $user = UsersRepository::find($user_id);
            $name = Carbon::now() . "بتاريخ" . $user->name . "تمت إعادة الإرسال إلى محرر الأسئلة ";
            Steps::SaveLogRow($name, 'إعادة إرسال', 'content_lists', $list_id);
            return redirect()->back()->with('success', 'تم الإرسال الي مدخل الأسئلة بنجاح ');
        }
//        if ($issuesSound->count() > 0) {
//            ContentListsRepository::updateStep($list_id, Steps::ResendToSound);
//            return redirect()->back()->with('success', 'تم إعادة الإرسال الي مدخل الصوت بنجاح ');
//        }
        if ($langUser != null) {

            //Notification/////
            NotificationRepository::notify($list_id, Steps::Languestic);
            ///end Notification////
            ContentListsRepository::updateStep($list_id, Steps::ResendToLanguestic);
            $user_id = TaskRepository::findWhereAndStep('list_id', $list_id, Steps::Languestic);
            $user = UsersRepository::find($user_id);
            $name = Carbon::now() . "بتاريخ" . $user->name . "تمت إعادة الإرسال إلى المراجع اللغوى ";
            Steps::SaveLogRow($name, 'إعادة إرسال', 'content_lists', $list_id);
            return redirect()->back()->with('success', 'تمت إعادة الإرسال الي المراجع اللغوى بنجاح ');
        } else {
            $data['user_id'] = auth()->id();
            $data['list_id'] = $list_id;
            $data['active'] = 1;
            UserRateRepository::save($data);
            ContentListsRepository::updateStep($list_id, Steps::Languestic);

            $name = Carbon::now() . "  تم  الإرسال إلى المراجع اللغوى بتاريخ ";
            Steps::SaveLogRow($name, ' إرسال', 'content_lists', $list_id);
            return redirect()->back()->with('success', 'تم الإرسال الي المراجع اللغوى بنجاح ');
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

//
//namespace App\Http\Controllers\reviewer;
//
//use App\Helper\IssuesSteps;
//use App\Helper\Steps;
//use App\Helper\UsersTypes;
//use App\Models\Article;
//use App\Models\AssignTask;
//use App\Models\ContentList;
//use App\Models\Vocab;
//use App\Notifications\ResendList;
//use App\Repository\ArticalRepository;
//use App\Repository\ContentListsRepository;
//use App\Repository\IssuesRepository;
//use App\Repository\ListRepository;
//use App\Repository\NotificationRepository;
//use App\Repository\QuestionsRepository;
//use App\Repository\TaskRepository;
//use App\Repository\UserRateRepository;
//use App\Repository\UsersRepository;
//use Carbon\Carbon;
//use Illuminate\Http\Request;
//use App\Http\Controllers\Controller;
//
//use Illuminate\Support\Facades\Notification;
//use StreamLab\StreamLabProvider\Facades\StreamLabFacades;
//
//class ReviewerController extends Controller
//{
//    public function index()
//    {
//        $tasks = TaskRepository::findTasksOfallUser(Steps::REVIEW_ARTICLE);
//        $lists = ContentList::with('level', 'grade')->whereNotIn('id', $tasks)->get();
//        return view('reviewer.index', compact('lists'));
//    }
//
//    public function viewArticle($list_id, $level, $page = null, $flag = 0)
//    {
//        $list = ContentList::find($list_id);
//        if ($list == null) {
//            return redirect()->back()->with('error', 'الموضوع  غير موجود');
//        }
//        $task = AssignTask::where(['list_id' => $list_id, 'step' => Steps::REVIEW_ARTICLE])->first();
//        if ($task) {
//            if ($task->user_id != auth()->id()) {
//                return redirect()->back()->withErrors('هذا الوضوع تابع لمستخدم آخر ');
//            }
//        }
//        if (!$task) {
//            TaskRepository::save($list_id, Steps::REVIEW_ARTICLE);
//        }
//        $article = Article::where(['list_id' => $list_id, 'level' => $level])->first();
//
//
//        if ($list->step != Steps::REVIEW_ARTICLE && $list->step != Steps::reSendToReviewerFormEditor) {
//            return redirect('reviewer/mylists')->withErrors('غير مسموح لك الدخول إلى هنا');
//        }
//        $articleObject = new Article();
//        return view('reviewer.viewArticle', compact('article', 'page', 'flag', 'articleObject'));
//    }
//
//    public function myLists($page = null)
//    {
//        $tasks = AssignTask::where(['step' => Steps::REVIEW_ARTICLE, 'user_id' => auth()->id()])->get()->pluck('list_id')->toArray();
//        $lists = ContentList::whereIn('id', $tasks)->where('step', Steps::REVIEW_ARTICLE)->get();
//        if ($page == "resendingLists") {
//            return redirect('reviewer/resending/lists');
//        }
//
//        // $lists = ContentList::with('level', 'country', 'grade')->whereIn('id', $tasks)->get();
//        return view('reviewer.mylists', compact('lists'));
//    }
//
//    public function resendingLists()
//    {
//
//        $tasks = AssignTask::where(['step' => Steps::REVIEW_ARTICLE, 'user_id' => auth()->id()])->get()->pluck('list_id')->toArray();
//
//        $lists = ContentList::whereIn('id', $tasks)->where('step', Steps::reSendToReviewerFormEditor)->get();
//        return view('reviewer.resendLists', compact('lists'));
//    }
//
//    public function SendToCreateQuestion($list_id)
//    {
//        $langUser = TaskRepository::findWhereAndStep('list_id', $list_id, Steps::Languestic);
//        if ($langUser != null) {
//            //Notification/////
//            NotificationRepository::notify($list_id, Steps::Languestic);
//            ///end Notification////
//            ContentListsRepository::updateStep($list_id, Steps::ResendToLanguestic);
//            $user_id = TaskRepository::findWhereAndStep('list_id', $list_id, Steps::Languestic);
//            $user = UsersRepository::find($user_id);
//            $name = Carbon::now() . "بتاريخ" . $user->name . "تمت إعادة الإرسال إلى المراجع اللغوى ";
//            Steps::SaveLogRow($name, 'إعادة إرسال', 'content_lists', $list_id);
//            return redirect()->back()->with('success', 'تمت إعادة الإرسال الي المراجع اللغوى بنجاح ');
//        } else {
//            $data['user_id'] = auth()->id();
//            $data['list_id'] = $list_id;
//            $data['active'] = 1;
//            UserRateRepository::save($data);
//            ContentListsRepository::updateStep($list_id, Steps::Languestic);
//
//            $name = Carbon::now() . "  تم  الإرسال إلى المراجع اللغوى بتاريخ ";
//            Steps::SaveLogRow($name, ' إرسال', 'content_lists', $list_id);
//            return redirect()->back()->with('success', 'تم الإرسال الي المراجع اللغوى بنجاح ');
//        }
////        $questions = QuestionsRepository::findIds('list_id', $list_id);
////        if (!empty($questions)) {
////            $issues = IssuesRepository::getAllIssuesForQuestion($questions, 'question', IssuesSteps::CloseByCreator);
////            if ($issues->count() > 0) {
////                ContentListsRepository::updateStep($list_id, Steps::ResendToQuestionCreator);
////                //Notification/////
////                NotificationRepository::notify($list_id, Steps::Create_Question);
////                ///end Notification//
////                $user_id = TaskRepository::findWhereAndStep('list_id', $list_id, Steps::Create_Question);
////                $user = UsersRepository::find($user_id);
////                $name = Carbon::now() . "بتاريخ" . $user->name . "تمت إعادة الإرسال إلى مدخل الأسئلة ";
////                Steps::SaveLogRow($name, 'إعادة إرسال', 'content_lists', $list_id);
////                return redirect()->back()->with('success', 'تم الإرسال إلى مدخل الأسئلة ');
////            } else {
////                ContentListsRepository::updateStep($list_id, Steps::ResendToLanguestic);
////                NotificationRepository::notify($list_id, Steps::Languestic);
////
////                $user_id = TaskRepository::findWhereAndStep('list_id', $list_id, Steps::Languestic);
////                $user = UsersRepository::find($user_id);
////                $name = Carbon::now() . "بتاريخ" . $user->name . "تمت إعادة الإرسال إلى المراجع اللغوى ";
////                Steps::SaveLogRow($name, 'إعادة إرسال', 'content_lists', $list_id);
////                return redirect()->back()->with('success', 'تم الإرسال إلى المراجع اللغوى');
////            }
////        }
////        $data['user_id'] = auth()->id();
////        $data['list_id'] = $list_id;
////        $data['active'] = 1;
////        UserRateRepository::save($data);
////        ContentListsRepository::updateStep($list_id, Steps::Create_Question);
////        $user_id = TaskRepository::findWhereAndStep('list_id', $list_id, Steps::Create_Question);
////        $user = UsersRepository::find($user_id);
////        $name = Carbon::now() . "  تم  الإرسال إلى مدخل الأسئلة بتاريخ ";
////        if($user!=null){
////            $name = Carbon::now() . "بتاريخ" . $user->name . "تم  الإرسال إلى مدخل الأسئلة ";
////        }
////
////        Steps::SaveLogRow($name, ' إرسال', 'content_lists', $list_id);
////        return redirect()->back()->with('success', ' تم الإرسال إلى مدخل الأسئلة ');
//    }
//
//    public function reSendToEditor($list_id)
//    {
//        $user_id = TaskRepository::findWhereAndStep('list_id', $list_id, Steps::UPLOADING_FILE);
//        $data['active'] = 0;
//        UserRateRepository::update($user_id, $list_id, $data);
//        ContentListsRepository::updateStep($list_id, Steps::reSendToEditorFormReviewer);
//        NotificationRepository::notify($list_id, Steps::UPLOADING_FILE);
//        $user_id = TaskRepository::findWhereAndStep('list_id', $list_id, Steps::UPLOADING_FILE);
//        $user = UsersRepository::find($user_id);
//        $name = Carbon::now() . "بتاريخ" . $user->name . "تمت إعادة الإرسال إلى المحرر ";
//        Steps::SaveLogRow($name, 'إعادة إرسال', 'content_lists', $list_id);
//        return redirect()->back()->with('success', 'تمت إعادة الإرسال إلى المحرر ');
//    }
//
//    public function viewVocabsForArticle($list_id, $level)
//    {
//        $article = Article::where(['list_id' => $list_id, 'level' => $level])->first();
//        $allVocabularyForTheListAndLevel = Vocab::where(['list_id' => $list_id, 'level' => $level])->get();
//        return view('reviewer.viewVocabsForArticle')->with(compact('article'))->with(compact('allVocabularyForTheListAndLevel'));
//    }
//}
