<?php

namespace App\Notifications;

use App\Helper\Steps;
use App\Helper\UsersTypes;
use App\Models\ContentList;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResendList extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $list;
    protected $word;

    public function __construct(ContentList $list)
    {
        $this->list = $list;
        $this->word = "معاد";
        if ($list->step == Steps::Publish) {
            $this->word = "منشور";
        }
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'data' => 'لديك موضوع ' . $this->word . '('.$this->list->list .')'.' من '. UsersTypes::ArrayOfPermission[auth()->user()->role]
        ];
    }

}
