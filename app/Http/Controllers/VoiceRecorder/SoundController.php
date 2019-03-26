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
use App\Repository\UsersRepository;
use Carbon\Carbon;
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
                return redirect()->back()->withErrors('هذا الوضوع تابع لمستخدم آخر ');
            }
        }
        if (!$task) {
            TaskRepository::save($list_id, Steps::Sound);
        }


        if ($list->step != Steps::Sound && $list->step != Steps::ResendToSound) {
            return redirect('VoiceRecorder/mySounds')->withErrors('غير مسموح لك الدخول إلى هنا');
        }
        return view('voicerecorder.upload', compact('article', 'page'));
    }

    public function save($article_id)
    {
        \request()->validate([
            'sound' => 'required|mimes:mpga,wav| max:10000',
        ], [
            'sound.required' => 'من فضلك اختر ملف صوت ',
            'sound.mimes' => 'من فضلك اختر ملف صوت من نوع   wav او mp3  ',
            'sound.max' => ' الملف  يجب ان لايزيد عن 10 ميجا   ',
        ]);

        $file = \request()->file('sound');
        SoundsRepository::save($file, $article_id,\request('type'));
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
            $user_id = TaskRepository::findWhereAndStep('list_id', $list_id, Steps::Quality);
            $user = UsersRepository::find($user_id);
            $name = Carbon::now() . "بتاريخ" . $user->name . "تمت إعادة الإرسال إلى الجودة ";
            Steps::SaveLogRow($name, 'إعادة إرسال', 'content_lists', $list_id);
        }
        $data['user_id'] = auth()->id();
        $data['list_id'] = $list_id;
        $data['active'] = 1;
        UserRateRepository::save($data);

        $name = Carbon::now() . "  تم  الإرسال إلى الجودة بتاريخ ";
        Steps::SaveLogRow($name, ' إرسال', 'content_lists', $list_id);
        return redirect()->back()->with('success', 'تم الإرسال بنجاح إلى الجودة ');
    }
}




