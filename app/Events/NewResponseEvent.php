<?php

namespace App\Events;

use App\Http\Resources\Holiday\HolidayGeneralResource;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewResponseEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    private $holiday_id;
    public $response;
    public $chat_status;
    public $assignes;

    public function __construct($holiday_id, $response,$assignes,$chat_status='OPEN')
    {
        $this->holiday_id = $holiday_id;
        $this->chat_status = $chat_status;
        $this->assignes = $assignes;
        $this->response = HolidayGeneralResource::make($response);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('private-new-response-channel.' . $this->holiday_id),
        ];
    }

    public function broadcastAs()
    {
        return 'new-response';
    }
}
