<?php

namespace App\Http\Controllers\superAdmin;

use App\Helper\UsersTypes;
use App\Models\Article;
use App\Models\UserRate;
use App\Repository\ArticalRepository;
use App\Repository\ContentListsRepository;
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
        $sound = SoundsRepository::findWhere('article_id', $article_id);
        $questions = QuestionsRepository::findWhere('artical_id', $article_id);

        return view('superadmin.viewArticleDetail', compact('article', 'sound', 'questions', 'list'));

    }


}
