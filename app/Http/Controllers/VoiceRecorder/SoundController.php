<?php

namespace App\Http\Controllers\VoiceRecorder;

use App\Helper\Steps;
use App\Models\Article;
use App\Models\AssignTask;
use App\Models\ContentList;
use App\Repository\ContentListsRepository;
use App\Repository\NotificationRepository;
use App\Repository\SoundsRepository;
use App\Repository\TaskRepository;
use App\Repository\UserRateRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SoundController extends Controller
{
    public function index()
    {
        $tasks = TaskRepository::findTasksOfallUser(Steps::Sound);
        $lists = ContentList::with('level', 'grade')->whereNotIn('id', $tasks)->where('step', Steps::Sound)->get();
        return view('voicerecorder.index', compact('lists'));
    }

    public function upload($list_id, $level, $page = null)
    {
        $article = Article::where(['list_id' => $list_id, 'level' => $level])->first();
        $list = ContentList::find($article->list_id);
        if ($list == null) {
            return redirect()->back()->with('error', 'الموضوع  غير موجود');
        }
        $task = AssignTask::where(['list_id' => $list_id, 'step' => Steps::Sound])->first();
        if ($task) {
            if ($task->user_id != auth()->id()) {
                return redirect()->back()->withErrors('هذا الوضوع تابع لمستخدم اخر ');
            }
        }
        if (!$task) {
            TaskRepository::save($list_id, Steps::Sound);
        }


        if ($list->step != Steps::Sound && $list->step != Steps::ResendToSound) {
            return redirect('VoiceRecorder/mySounds')->withErrors('غير مسموح لك الدخول الى هنا');
        }
        return view('voicerecorder.upload', compact('article', 'page'));
    }

    public function save($article_id)
    {
        \request()->validate([
            'sound' => 'required|mimes:mpga,wav| max:5000',
        ], [
            'sound.required' => 'من فضلك اختر ملف صوت ',
            'sound.mimes' => 'من فضلك اختر ملف صوت من نوع   wav او mp3  ',
            'sound.max' => ' الملف  يجب ان لايزيد عن 5 ميجا   ',
        ]);
        $file = \request()->file('sound');
        SoundsRepository::save($file, $article_id);
        return redirect()->back()->with('success', 'تم الرفع بنجاح');
    }

    public function mySounds()
    {

        $tasks = TaskRepository::userTasks(Steps::Sound);
        $lists = ContentList::with('level', 'grade')->whereIn('id', $tasks)->where('step', Steps::Sound)->get();
        return view('voicerecorder.mysounds', compact('lists'));
    }

    public function refused()
    {

        $tasks = TaskRepository::userTasks(Steps::Sound);

        $lists = ContentList::with('level', 'grade')->whereIn('id', $tasks)->where('step', Steps::ResendToSound)->get();

        return view('voicerecorder.refused', compact('lists'));
    }

    public function sendToQuality($list_id, $step)
    {

        ContentListsRepository::updateStep($list_id, $step);
        if ($step == Steps::ResendToQuality) {
            //Notification/////
            NotificationRepository::notify($list_id, Steps::Quality);
            ///end Notification////
        }
        $data['user_id'] = auth()->id();
        $data['list_id'] = $list_id;
        $data['active'] = 1;
        UserRateRepository::save($data);
        return redirect()->back()->with('success', 'تم الارسال بنجاح الى الجودة ');
    }
}




