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
        $sound = SoundsRepository::findWhere('article_id', $article_id);
        $questions = QuestionsRepository::findWhere('artical_id', $article_id);

        return view('superadmin.viewArticleDetail', compact('article', 'sound', 'questions', 'list'));

    }

    public function Rates($userRole, $time)
    {
        $users = UsersRepository::findWhere('role', $userRole);
        $query = UserRate::whereIn('user_id', $users->pluck('id')->toArray());
        if ($time == 'yesterday') {
            $time = Carbon::yesterday()->toDateString();
            $query->where('created_at', 'like', $time . '%');
        } elseif ($time == 'week') {
            $today = Carbon::tomorrow();
            $lastWeek = Carbon::today()->subWeek();
            $query->where('created_at', '>', $lastWeek)->where('created_at', '<=', $today);
        }
        $topUsers = $query->get();
//        // if ($userRole == UsersTypes::EDITOR) {
//        $editor = UserRate::select('user_id')
//            ->whereIn('user_id', $users->pluck('user_id')->toArray())
//            ->groupBy('user_id')
//            ->orderByRaw('COUNT(*) DESC')
//            ->limit(3)
//            ->get()->pluck('user_id')->toArray();
//        //  }
        $multiplied = $topUsers->groupBy('user_id')->map(function ($item, $key) {
            return count($item);
        });
        $arr = $multiplied->toArray();
        arsort($arr);
        $result = [];
        foreach ($arr as $key => $value) {
            $user = UsersRepository::find($key);

            $result[] = array('img'=>$user->img,'name'=>$user->name,'rate'=>$value,'role'=>UsersTypes::ArrayOfPermission[$user->role]);

        }

        return response()->json($result);
    }
}
