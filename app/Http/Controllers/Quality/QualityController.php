<?php

namespace App\Http\Controllers\Quality;

use App\Models\Sound;
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
use Illuminate\Notifications\Notification;
use StreamLab\StreamLabProvider\Facades\StreamLabFacades;

class QualityController extends Controller
{
    public function home()
    {
        $current = AssignTask::where('step', Steps::Quality)->get()->pluck('list_id')->toArray();
        $list = ContentList::where('step', Steps::Quality)->whereNotIn('id', $current)->get();
        return view('quality.index', compact('list'));
    }

    public function index()
    {
        $tasks = TaskRepository::userTasks(Steps::Quality, '\App\Models\ContentList');
        $list = ContentList::where('step', Steps::Quality)->whereIn('id', $tasks)->get();
        return view('quality.myList', compact('list'));
    }

    public function backFromCreator()
    {
//        $list = TaskRepository::userTasks(Steps::Review_Question, '\App\Models\ContentList');
        $tasks = TaskRepository::userTasks(Steps::Quality, '\App\Models\ContentList');
        $list = ContentList::where('step', Steps::ResendToQuality)->whereIn('id', $tasks)->get();
//        if ($list->count() > 0) {
//            $list_id = $list->pluck('id')->toArray();
//            foreach ($list_id as $list_id) {
//                ///Question///
//                $questionIds = QuestionsRepository::findIds('list_id', $list_id);
//                $closedQuestion=IssuesRepository::getIssuesForQuestion($questionIds,'question',null,auth()->id());
//                $issues_id = $closedQuestion->pluck('field_id')->toArray();
//                $final = array_diff($questionIds, $issues_id);
//                $finalQuestion = QuestionsRepository::findWhereIn('id', $final);
//                $artical_idForQ = $finalQuestion->pluck('artical_id')->toArray();
//
//                //Article//
//                $articalIds=Article::where('list_id',$list_id)->get()->pluck('id')->toArray();
//                $closedarticals=IssuesRepository::getIssuesForQuestion($articalIds,'article',null,auth()->id());
//                $artical_id1 = $closedarticals->pluck('field_id')->toArray();
//                $finalartical = array_diff($articalIds, $artical_id1);
//                ///Sound//
//                $sound=SoundsRepository::findWhereIn('article_id',$articalIds);
//                $soundIds=$sound->get()->pluck('id')->toArray();
//                $closedSounds=IssuesRepository::getAllIssuesForQuestion($soundIds,'sound',IssuesSteps::CloseByCreator);
//                $sound_id=$closedSounds->pluck('field_id')->toArray();
//                $final2=array_diff($soundIds,$sound_id);
//                $finalSound=SoundsRepository::findWhereIn('id',$final2);
//                $artical_idForS=$finalSound->pluck('article_id')->toArray();
//
//                $finalArticals_id=array_intersect($finalartical , $artical_idForQ);
//                $finalArticals_id=array_intersect($artical_idForS , $finalArticals_id);
//                Article::whereIn('id', $finalArticals_id)->update(['status' => ArticleLevels::Review]);
//                //  $articalWithIssues = QuestionsRepository::findWhereIn('id', $issues_id);
//                //$articalIdsWithIssues = $articalWithIssues->pluck('artical_id')->toArray();
////                $articalNotReview=$artical_id1 + $articalIdsWithIssues;
////               // Article::whereIn('id', $articalNotReview)->update(['status' => ArticleLevels::notReview]);
//            }
//        }
        return view('quality.backContent', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function review($artical_id, $page = 'myList')
    {
        $questionType=new Article();
        $sound =Sound::where(['article_id'=>$artical_id,'type'=>$questionType->getNormalArticleValue()])->first();
        $soundStretch =Sound::where(['article_id'=>$artical_id,'type'=>$questionType->getStretchArticleValue()])->first();
        $questions=\App\Models\Question::where(['artical_id'=>$artical_id,'type'=>$questionType->getNormalArticleValue()])->get();
        $questionStretch=\App\Models\Question::where(['artical_id'=>$artical_id,'type'=>$questionType->getStretchArticleValue()])->get();
        $artical = Article::where('id', $artical_id)->first();
        $vocab=Vocab::where(['list_id'=>$artical->list_id,'level'=>$artical->level])->get();
        $list = ContentList::find($artical->list_id);
        if ($list == null) {
            return redirect()->back()->with('error', 'المقال غير موجود');
        }
        if (auth()->user()->role != UsersTypes::SUPERADMIN && auth()->user()->role != UsersTypes::ADMIN) {
            $task = AssignTask::where(['list_id' => $artical->list_id, 'step' => Steps::Quality])->first();
            if ($task) {
                if ($task->user_id != auth()->id()) {
                    return redirect()->back()->withErrors('هذا الموضوع تابع لمستخدم آخر ');
                }
            } elseif (!$task) {
                TaskRepository::save($artical->list_id, Steps::Quality);
            }
        }

        if ($list->step != Steps::Quality && $list->step != Steps::ResendToQuality) {
            return redirect('quality/myList')->withErrors('غير مسموح لك الدخول إلى هنا');
        }
        return view('quality.review', compact('artical','vocab','soundStretch', 'questionStretch','questions', 'page', 'sound'));
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
        $issuesQuestions = IssuesRepository::findWhereInAndStatus($questionsIds, 'question', IssuesSteps::DoneByEditor, auth()->id());
        $issuesArtical = IssuesRepository::getAllIssuesForArticle($artical_id, 'article', IssuesSteps::DoneByEditor, auth()->id());
        $issuesSound = IssuesRepository::getAllIssuesForArticle($artical_id, 'sound', IssuesSteps::DoneByEditor, auth()->id());
        if ($issuesQuestions->count() > 0 || $issuesArtical->count() > 0 || $issuesSound->count() > 0) {
            return redirect()->back()->withError('يجب الانتهاء من كل الملاحظات');
        }
        Article::where('id', $artical_id)->update(['status' => 1]);
        return redirect()->back()->with('success', 'تم المراجعة بنجاح ');
    }


    public function send($list_id)
    {
        $artical = Article::where('list_id', $list_id)->get()->pluck('id')->toArray();
        $sound = SoundsRepository::findWhereIn('article_id', $artical)->pluck('id')->toArray();
        $questions = QuestionsRepository::findIds('list_id', $list_id);
        $status = Article::where(['list_id' => $list_id, 'status' => 0])->first();
        if (!empty($status)) {
            return redirect()->back()->withErrors(' يجب مراجعه كافه المحتوي اولا');
        }

        $issuesQuestion = IssuesRepository::getAllIssuesForQuestion($questions, 'question', IssuesSteps::CloseByCreator);
        $issuesArtical = IssuesRepository::getAllIssuesForQuestion($artical, 'article', IssuesSteps::CloseByCreator);
        $issuesSound = IssuesRepository::getAllIssuesForQuestion($sound, 'sound', IssuesSteps::CloseByCreator);

        if ($issuesArtical->count() > 0) {
            ContentListsRepository::updateStep($list_id, Steps::reSendToEditorFormReviewer);
            //Notification/////
            NotificationRepository::notify($list_id, Steps::UPLOADING_FILE);
            ///end Notification////
            $user_id = TaskRepository::findWhereAndStep('list_id', $list_id, Steps::UPLOADING_FILE);
            $user = UsersRepository::find($user_id);
            $name = Carbon::now() . "بتاريخ" . $user->name . "تمت إعادة الإرسال إلى المحرر ";
            Steps::SaveLogRow($name, 'إعادة إرسال', 'content_lists', $list_id);
            $user_id = TaskRepository::findWhereAndStep('list_id', $list_id, Steps::UPLOADING_FILE);
            $data['active'] = 0;
            UserRateRepository::update($user_id, $list_id, $data);
            if ($issuesQuestion->count() > 0) {
                $user_id = TaskRepository::findWhereAndStep('list_id', $list_id, Steps::Create_Question);
                $data['active'] = 0;
                UserRateRepository::update($user_id, $list_id, $data);
            }
            return redirect()->back()->with('success', 'تم الإرسال الي مدخل المقالات بنجاح ');
        }
        if ($issuesQuestion->count() > 0) {
            ContentListsRepository::updateStep($list_id, Steps::ResendToQuestionCreator);
            //Notification/////
            NotificationRepository::notify($list_id, Steps::Create_Question);
            ///end Notification////
            $user_id = TaskRepository::findWhereAndStep('list_id', $list_id, Steps::Create_Question);
            $user = UsersRepository::find($user_id);
            $name = Carbon::now() . "بتاريخ" . $user->name . "تمت إعادة الإرسال إلى محرر الأسئلة ";
            Steps::SaveLogRow($name, 'إعادة إرسال', 'content_lists', $list_id);
            $user_id = TaskRepository::findWhereAndStep('list_id', $list_id, Steps::Create_Question);
            $data['active'] = 0;
            UserRateRepository::update($user_id, $list_id, $data);
            return redirect()->back()->with('success', 'تم الإرسال الي مدخل الأسئلة بنجاح ');
        }
        if (count($sound) == 0) {
            ContentListsRepository::updateStep($list_id, Steps::Sound);

            $name = Carbon::now() . " تم  الإرسال إلى مدخل الصوت بتاريخ";
            Steps::SaveLogRow($name, ' إرسال', 'content_lists', $list_id);
            return redirect()->back()->with('success', 'تم  الإرسال الي مدخل الصوت بنجاح ');
        }
        if ($issuesSound->count() > 0 && count($sound) > 0) {
            ContentListsRepository::updateStep($list_id, Steps::ResendToSound);
            //Notification/////
            NotificationRepository::notify($list_id, Steps::Sound);
            ///end Notification////
            $user_id = TaskRepository::findWhereAndStep('list_id', $list_id, Steps::Sound);
            $user = UsersRepository::find($user_id);
            $name = Carbon::now() . "بتاريخ" . $user->name . "تمت إعادة الإرسال إلى مدخل الصوت ";
            Steps::SaveLogRow($name, 'إعادة إرسال', 'content_lists', $list_id);
            $user_id = TaskRepository::findWhereAndStep('list_id', $list_id, Steps::Sound);
            $data['active'] = 0;
            UserRateRepository::update($user_id, $list_id, $data);
            return redirect()->back()->with('success', 'تم إعادة الإرسال الي مدخل الصوت بنجاح ');
        } else {
            ContentListsRepository::updateStep($list_id, Steps::Publish);
            //Notification/////
            NotificationRepository::notify($list_id, Steps::Publish);
            ///end Notification////
            $data['user_id'] = auth()->id();
            $data['list_id'] = $list_id;
            $data['active'] = 1;
            UserRateRepository::save($data);
            $user_id = TaskRepository::findWhereAndStep('list_id', $list_id, Steps::Quality);
            $user = UsersRepository::find($user_id);
            $name = Carbon::now() . "نشر الموضوع بتاريخ" . $user->name ;
            Steps::SaveLogRow($name, 'إعادة إرسال', 'content_lists', $list_id);
            return redirect()->back()->with('success', 'تم النشر بنجاح ');
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
