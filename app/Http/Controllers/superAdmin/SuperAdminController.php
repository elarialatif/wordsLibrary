<?php

namespace App\Http\Controllers\superAdmin;

use App\Repository\ArticalRepository;
use App\Repository\ContentListsRepository;
use App\Repository\QuestionsRepository;
use App\Repository\SoundsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SuperAdminController extends Controller
{
    public function viewArticle($article_id)
    {
        $article = ArticalRepository::getArticleById($article_id);
        $list = ContentListsRepository::find($article->list_id);
        $sound = SoundsRepository::findWhere('article_id', $article_id);
        $questions = QuestionsRepository::findWhere('artical_id', $article_id);

        return view('superadmin.viewArticleDetail', compact('article', 'sound', 'questions','list'));

    }
}
