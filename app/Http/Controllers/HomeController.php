<?php

namespace App\Http\Controllers;

use App\Helper\ArticleLevels;
use App\Helper\Steps;
use App\Helper\UsersTypes;
use App\Models\Article;
use App\Models\ArticleFiles;
use App\Models\Categery;
use App\Models\ContentList;
use App\Models\Grade;
use App\Models\PlacementTest;
use App\Models\Question;
use App\Models\Sound;
use App\Models\UserRate;
use App\Repository\ContentListsRepository;
use App\Repository\TaskRepository;
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
        $analizingFile = \App\Repository\ContentListsRepository::findStep('step', '>', \App\Helper\Steps::ANALYZING_FILE)->count();
        $fileUnderAnalizing = \App\Repository\ContentListsRepository::findStep('step', '=', \App\Helper\Steps::ANALYZING_FILE)->count();
        $fileUnderUploading = \App\Repository\ContentListsRepository::findStep('step', '=', \App\Helper\Steps::UPLOADING_FILE)->count();

        $listsByArtical = \App\Repository\ContentListsRepository::findStep('step', '>', \App\Helper\Steps::INSERTING_ARTICLE)->count();
        $complete = \App\Repository\ContentListsRepository::findWhere('step', \App\Helper\Steps::Publish)->count();

        $allCats = \App\Models\Categery::all()->count();
        $allGrades = \App\Models\Grade::all()->count();
        //$allArtical = Article::all()->count();
        $allLists = \App\Models\ContentList::all()->count();
        $allUsers = \App\User::all()->count();

//        $allLists = ContentList::all()->count();
//        $listsByArtical = ContentListsRepository::findStep('step', '>', Steps::INSERTING_ARTICLE)->count();
//        $complete = ContentListsRepository::findWhere('step', Steps::Publish)->count();
//        $allUsers = User::all()->count();
//        $allCats = Categery::all()->count();
//        $allGrades = Grade::all()->count();
//        $allArtical = Article::all()->count();
//        $allFiles = ArticleFiles::all()->count();
//        $analizingFile = ContentListsRepository::findStep('step', '>', Steps::ANALYZING_FILE)->count();
//        $fileUnderAnalizing = ContentListsRepository::findStep('step', '=', Steps::ANALYZING_FILE)->count();
//        $fileUnderUploading = ContentListsRepository::findStep('step', '=', Steps::UPLOADING_FILE)->count();
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
        $query = UserRate::whereIn('user_id', $users->pluck('id')->toArray())->where('active', 1);
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
        $i = 0;
        foreach ($arr as $key => $value) {
            if ($i == 3) {
                break;
            }
            $user = UsersRepository::find($key);

            $result[] = array('img' => $user->img, 'name' => $user->name, 'rate' => $value, 'role' => UsersTypes::ArrayOfPermission[$user->role], 'id' => $user->id);
            $i++;
        }

        return response()->json($result);
    }

    public function notify()
    {
        return view('layouts.notify');
    }

    public function editorWork()
    {
        $arr = [];
        $easy_article_ids = Article::where('level', ArticleLevels::Easy)->get()->pluck('id')->toArray();
        $normal_article_ids = Article::where('level', ArticleLevels::Normal)->get()->pluck('id')->toArray();
        $hard_article_ids = Article::where('level', ArticleLevels::Hard)->get()->pluck('id')->toArray();
        if (auth()->user()->role == UsersTypes::EDITOR) {
            $arr['num_files'] = ArticleFiles::where('user_id', auth()->id())->count();
            $arr['num_easy'] = Article::where(['user_id' => auth()->id(), 'level' => ArticleLevels::Easy])->count();
            $arr['num_normal'] = Article::where(['user_id' => auth()->id(), 'level' => ArticleLevels::Normal])->count();
            $arr['num_hard'] = Article::where(['user_id' => auth()->id(), 'level' => ArticleLevels::Hard])->count();
        }
        if (auth()->user()->role == UsersTypes::Sound) {
            $arr['num_easy'] = Sound::where(['user_id' => auth()->id()])->whereIn('article_id', $easy_article_ids)->count();
            $arr['num_normal'] = Sound::where(['user_id' => auth()->id()])->whereIn('article_id', $normal_article_ids)->count();
            $arr['num_hard'] = Sound::where(['user_id' => auth()->id()])->whereIn('article_id', $hard_article_ids)->count();
        }
        if (auth()->user()->role == UsersTypes::QuestionCreator) {
            $arr['num_easy'] = Question::where(['user_id' => auth()->id()])->whereIn('artical_id', $easy_article_ids)->count();
            $arr['num_normal'] = Question::where(['user_id' => auth()->id()])->whereIn('artical_id', $normal_article_ids)->count();
            $arr['num_hard'] = Question::where(['user_id' => auth()->id()])->whereIn('artical_id', $hard_article_ids)->count();
        }
        return $arr;
    }

    public function usersDashboard()
    {

        if (auth()->user()->role == UsersTypes::LISTMAKER) {
            $all_lists = ContentList::where('user_id', auth()->id())->count();
            $arr = [
                'all_lists' => $all_lists
            ];
            return $arr;
        } elseif (auth()->user()->role == UsersTypes::PlacementTestEditor) {
            $all_lists = PlacementTest::where('user_id', auth()->id())->count();
            $arr = [
                'all_lists' => $all_lists
            ];
            return $arr;
        } else {

            $all_lists = TaskRepository::findAllWhere('user_id', auth()->id());

            if ($all_lists->count() > 0) {
                $step = $all_lists[0]->step;

                $user_all_steps = self::getUserSteps($step, 0);

                $content_lists_ids = $all_lists->pluck('list_id')->toArray();
                $allList_count = $all_lists->count();

                $underWorking_lists = ContentList::whereIn('step', $user_all_steps)->whereIn('id', $content_lists_ids)->count();
                $finished_lists = $allList_count - $underWorking_lists;
                $step_for_task = self::getUserSteps($step);
                $tasks = TaskRepository::userTasks($step);

                //$last_tasks = ContentList::whereIn('step', $step_for_task)->whereIn('id', $tasks)->latest()->get();
                $last_tasks_ids = Article::with('lists')->whereIn('list_id', $tasks)->orderBy('updated_at', 'desc')->get()->pluck('list_id')->toArray();
                if (auth()->user()->role == UsersTypes::QuestionCreator) {
                    $last_tasks_ids = Question::whereIn('list_id', $tasks)->orderBy('updated_at', 'desc')->get()->pluck('list_id')->toArray();

                } elseif (auth()->user()->role == UsersTypes::Sound) {
                    $allArticlesIdsWorkedBySoundUser=Article::whereIn('list_id', $tasks)->get()->pluck('id')->toArray();
                    $last_article_ids_workedBySoundUser = Sound::whereIn('article_id', $allArticlesIdsWorkedBySoundUser)->orderBy('updated_at', 'desc')->get()->pluck('article_id')->toArray();
                    $last_tasks_ids=Article::whereIn('id', $last_article_ids_workedBySoundUser)->get()->pluck('list_id')->toArray();
                }

                $allListIdsWorkedByUser = array_unique($last_tasks_ids);
                $lastFiveListsIdsWorkedByUser = array_slice($allListIdsWorkedByUser, 0, 5, true);

                $last_tasks = ContentList::whereIn('step', $step_for_task)->whereIn('id', $lastFiveListsIdsWorkedByUser)->get();

                $arr = [
                    'all_lists' => $allList_count,
                    'underWork' => $underWorking_lists,
                    'finished' => $finished_lists,
                    'tasks' => $last_tasks,
                ];
                return $arr;
            } else {
                $arr = ['all_lists' => 0,
                    'underWork' => 0,
                    'finished' => 0];

                return $arr;
            }
        }
    }

    public function getUserSteps($step, $flag = null)
    {
        switch ($step) {
            case Steps::ANALYZING_FILE:
                $arr = [$step];
                return $arr;
                break;
            case Steps::UPLOADING_FILE:

                $arr = [Steps::reSendToEditorFormReviewer, Steps::INSERTING_ARTICLE, $step];
                return $arr;
                break;
            case Steps::REVIEW_ARTICLE:
                $arr = [Steps::reSendToReviewerFormEditor, $step];
                return $arr;
                break;
            case Steps::Create_Question:
                $arr = [Steps::ResendToQuestionCreator, $step];
                return $arr;
                break;
            case Steps::Review_Question:
                $arr = [Steps::ResendToQuestionReviewer, $step];
                return $arr;
                break;
            case Steps::Languestic:
                $arr = [Steps::ResendToLanguestic, $step];
                return $arr;
                break;
            case Steps::Sound:
                $arr = [Steps::ResendToSound, $step];
                return $arr;
                break;
            case Steps::Quality:
                $arr = [Steps::ResendToQuality, $step];
                return $arr;
                break;
        }
    }

}
