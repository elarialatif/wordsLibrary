<?php
/**
 * Created by PhpStorm.
 * User: badr.abed
 * Date: 12/11/2018
 * Time: 03:37 م
 */

namespace App\Repository;


use App\Helper\Steps;
use App\Helper\UsersTypes;
use App\Models\Country;
use App\Notifications\ResendList;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;
use StreamLab\StreamLabProvider\Facades\StreamLabFacades;

class NotificationRepository
{
    static function notify($list_id, $step)
    {
        //Notification/////
        $list = ContentListsRepository::find($list_id);

        if ($step != Steps::Publish) {

            $user_id = TaskRepository::findWhereAndStep('list_id', $list_id, $step);

            $user = UsersRepository::find($user_id);

            $word = 'معاد ';
            $event = 'ResendList';
        } else {
            $word = 'منشور ';
            $event = 'publish';
            $user = UsersRepository::findWhere('role', UsersTypes::SUPERADMIN);

        }

        if (isset($user->id)) {

            $users_id = array($user->id);
        } else {
            $users_id = $user->pluck('id')->toArray();
            //  $users_id=array($users,$data);
        }
        $data = ' لديك موضوع  ' . $word . '(' . $list->list . ')' . ' من ' . UsersTypes::ArrayOfPermission[auth()->user()->role];
        array_push($users_id, $data);

        Notification::send($user, new ResendList($list));


        //StreamLabFacades::pushMessage('test', $event, $users_id);
        //    StreamLabFacades::pushMessage('test', $event, $data);
        ///end Notification////
    }
}