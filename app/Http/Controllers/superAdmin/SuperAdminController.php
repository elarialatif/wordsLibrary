<?php

namespace App\Http\Controllers\superAdmin;

use App\Helper\UsersTypes;
use App\Models\Article;
use App\Models\Link;
use App\Models\Sound;
use App\Models\UserRate;
use App\Models\Vocab;
use App\Repository\ArticalRepository;
use App\Repository\ContentListsRepository;
use App\Repository\LinksRepository;
use App\Repository\QuestionsRepository;
use App\Repository\SoundsRepository;
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
        $questionType=new Article();
        $sound =Sound::where(['article_id'=>$article_id,'type'=>$questionType->getNormalArticleValue()])->first();
        $soundStretch =Sound::where(['article_id'=>$article_id,'type'=>$questionType->getStretchArticleValue()])->first();
        $questions=\App\Models\Question::where(['artical_id'=>$article_id,'type'=>$questionType->getNormalArticleValue()])->get();
        $questionStretch=\App\Models\Question::where(['artical_id'=>$article_id,'type'=>$questionType->getStretchArticleValue()])->get();
        $vocab=Vocab::where(['list_id'=>$article->list_id,'level'=>$article->level])->get();
        $links=Link::where('list_id',$list->id)->get();
        return view('superadmin.viewArticleDetail', compact('links','vocab','questionStretch','soundStretch','article', 'sound', 'questions', 'list'));

    }


}
