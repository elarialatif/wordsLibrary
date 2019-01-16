<?php

namespace App\Http\Controllers;

use App\Helper\Steps;
use App\Helper\UsersTypes;
use App\Models\Article;
use App\Models\ArticleFiles;
use App\Models\Categery;
use App\Models\ContentList;
use App\Models\Grade;
use App\Models\UserRate;
use App\Repository\ContentListsRepository;
use App\Repository\UserRateRepository;
use App\Repository\UsersRepository;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allLists = ContentList::all()->count();
        $listsByArtical = ContentListsRepository::findStep('step', '>', Steps::INSERTING_ARTICLE)->count();
        $complete = ContentListsRepository::findWhere('step', Steps::Publish)->count();
        $allUsers = User::all()->count();
        $allCats = Categery::all()->count();
        $allGrades = Grade::all()->count();
        $allArtical = Article::all()->count();
        $allFiles = ArticleFiles::all()->count();
        $analizingFile = ContentListsRepository::findStep('step', '>', Steps::ANALYZING_FILE)->count();
        $fileUnderAnalizing = ContentListsRepository::findStep('step', '=', Steps::ANALYZING_FILE)->count();
        $fileUnderUploading = ContentListsRepository::findStep('step', '=', Steps::UPLOADING_FILE)->count();
//      dd($fileUnderAnalizing);
//        $users=User::all()->pluck('id')->toArray();
//        foreach ($users as $user){
//            $data['user_id']=$user;
//            $rate=UserRateRepository::save($data);
//        }
        if (auth()->user()->role == UsersTypes::SUPERADMIN) {
            return view('superadmin.home', compact('allLists', 'listsByArtical', 'complete', 'allUsers', 'allCats', 'allGrades', 'allArtical', 'analizingFile', 'fileUnderAnalizing', 'allFiles', 'fileUnderUploading'));
        } else {
            return view('home');
        }

    }

    public function Rates($userRole, $time)
    {

        $users = UsersRepository::findWhere('role', $userRole);
        $query = UserRate::whereIn('user_id', $users->pluck('id')->toArray())->where('active',1);
        if ($time == 'yesterday') {
            $time = Carbon::yesterday()->toDateString();
            $query->where('created_at', 'like', $time . '%');
        } elseif ($time == 'week') {
            $today = Carbon::tomorrow();
            $lastWeek = Carbon::today()->subWeek();
            $query->where('created_at', '>', $lastWeek)->where('created_at', '<=', $today);
        }
        $topUsers = $query->get();
        $multiplied = $topUsers->groupBy('user_id')->map(function ($item, $key) {
            return count($item);
        });
        $arr = $multiplied->toArray();
        arsort($arr);
        $result = [];
        foreach ($arr as $key => $value) {
            $user = UsersRepository::find($key);

            $result[] = array('img' => $user->img, 'name' => $user->name, 'rate' => $value, 'role' => UsersTypes::ArrayOfPermission[$user->role], 'id' => $user->id);

        }

        return response()->json($result);
    }
}
