<?php

namespace App\Http\Controllers\analyzer;

use App\Helper\Steps;
use App\Models\ContentList;
use App\Repository\ContentListsRepository;
use App\Repository\ListRepository;
use App\Repository\NotificationRepository;
use App\Repository\TaskRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ArticleFiles;
use App\Models\AssignTask;
use Illuminate\Notifications\Notification;

class AnalyzerController extends Controller
{
    public function index()
    {

        $tasks = AssignTask::where('step', Steps::ANALYZING_FILE)->get()->pluck('list_id')->toArray();
        $files = ArticleFiles::whereNotIn('list_id', $tasks)->get();
        return view('listsanalayzer.index', compact('files'));

    }

    public function myLists()
    {

        $files = TaskRepository::findTasksOfUser(Steps::ANALYZING_FILE);
        // $files = ContentList::with('level', 'country', 'grade')->whereIn('id', $tasks)->where('step', Steps::reSendToReviewerFormEditor)->get();
        return view('listsanalayzer.myLists', compact('files'));

    }

    public function SendListToEditor($list_id, $step)
    {
        ContentListsRepository::updateStep($list_id, $step);
        //Notification/////
        NotificationRepository::notify($list_id, Steps::UPLOADING_FILE);
        ///end Notification////
        session()->flash('message', 'تم ارسال الموضوع الى محرر المقالات بنجاح ');
        return redirect()->back();
    }
}
