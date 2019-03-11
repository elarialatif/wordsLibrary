<?php

namespace App\Http\Controllers\superAdmin;

use App\Helper\Steps;
use App\Helper\UsersTypes;
use App\Models\Article;
use App\Models\Link;
use App\Models\Sound;
use App\Models\UserRate;
use App\Models\Vocab;
use App\Repository\ArticalRepository;
use App\Repository\ContentListsRepository;
use App\Repository\LinksRepository;
use App\Repository\NotificationRepository;
use App\Repository\QuestionsRepository;
use App\Repository\SoundsRepository;
use App\Repository\TaskRepository;
use App\Repository\UsersRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SuperAdminController extends Controller
{
    public function viewArticle($article_id)
    {
        $article = ArticalRepository::getArticleById($article_id);
        $list = ContentListsRepository::find($article->list_id);
        if ($list == null) {
            return redirect()->back()->with('error', 'الموضوع  غير موجود');
        }
        $questionType = new Article();
        $sound = Sound::where(['article_id' => $article_id, 'type' => $questionType->getNormalArticleValue()])->first();
        $soundStretch = Sound::where(['article_id' => $article_id, 'type' => $questionType->getStretchArticleValue()])->first();
        $questions = \App\Models\Question::where(['artical_id' => $article_id, 'type' => $questionType->getNormalArticleValue()])->get();
        $questionStretch = \App\Models\Question::where(['artical_id' => $article_id, 'type' => $questionType->getStretchArticleValue()])->get();
        $vocab = Vocab::where(['list_id' => $article->list_id, 'level' => $article->level])->get();
        $links = Link::where('list_id', $list->id)->get();
        return view('superadmin.viewArticleDetail', compact('links', 'vocab', 'questionStretch', 'soundStretch', 'article', 'sound', 'questions', 'list'));

    }

    public function adminChangeStepOfList($step, $list_id)
    {
        $user_id = TaskRepository::findWhereAndStep('list_id', $list_id, $step);
        $user = UsersRepository::find($user_id);
        if ($user) {

            NotificationRepository::notify($list_id, $step);

        }
        switch ($step) {
            case Steps::ANALYZING_FILE:

                ContentListsRepository::updateStep($list_id, Steps::ANALYZING_FILE);

                break;
            case Steps::INSERTING_ARTICLE:
                if ($user) {
                    ContentListsRepository::updateStep($list_id, Steps::reSendToEditorFormReviewer);
                } else {
                    ContentListsRepository::updateStep($list_id, Steps::INSERTING_ARTICLE);
                }

                break;
            case Steps::REVIEW_ARTICLE:
                if ($user) {
                    ContentListsRepository::updateStep($list_id, Steps::reSendToReviewerFormEditor);
                } else {
                    ContentListsRepository::updateStep($list_id, Steps::REVIEW_ARTICLE);
                }

                break;

            case Steps::Create_Question:
                if ($user) {
                    ContentListsRepository::updateStep($list_id, Steps::ResendToQuestionCreator);
                } else {
                    ContentListsRepository::updateStep($list_id, Steps::Create_Question);
                }

                break;
            case Steps::Review_Question:
                if ($user) {
                    ContentListsRepository::updateStep($list_id, Steps::ResendToQuestionReviewer);
                } else {
                    ContentListsRepository::updateStep($list_id, Steps::Review_Question);
                }

                break;
            case Steps::Languestic:
                if ($user) {
                    ContentListsRepository::updateStep($list_id, Steps::ResendToLanguestic);
                } else {
                    ContentListsRepository::updateStep($list_id, Steps::Languestic);
                }

                break;
            case Steps::Sound:
                if ($user) {
                    ContentListsRepository::updateStep($list_id, Steps::ResendToSound);
                } else {
                    ContentListsRepository::updateStep($list_id, Steps::Sound);
                }

                break;
            case Steps::Quality:
                if ($user) {
                    ContentListsRepository::updateStep($list_id, Steps::ResendToQuality);
                } else {
                    ContentListsRepository::updateStep($list_id, Steps::Quality);
                }

                break;
            case Steps::Publish:

                ContentListsRepository::updateStep($list_id, Steps::Publish);


                break;
        }
        return redirect()->back()->with('success', 'تم التعديل بنجاح');
    }
}
