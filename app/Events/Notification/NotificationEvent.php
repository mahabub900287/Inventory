<?php

namespace App\Events\Notification;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use App\Notifications\ProductDeliveryNotification;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NotificationEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $data;

    public $user;

    public function __construct($data, $user)
    {
        $this->data = $data;
        $this->user = $user;
        $this->broadcastAndStoreNotification();
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('notifications-channel-' . $this->user->id);
    }

    public function broadcastAs()
    {
        return 'notifications-event';
    }

    public function broadcastWith()
    {
        return [
            'title' => $this->data['title'],
            'user' => $this->data['user'],
            'type' => $this->data['type'],
            'msg' => $this->data['msg'],
            'url' => $this->data['url'],
        ];
    }
    public function broadcastAndStoreNotification()
    {

        $notification = new ProductDeliveryNotification($this->data);
        Notification::send($this->user, $notification);
    }
}
