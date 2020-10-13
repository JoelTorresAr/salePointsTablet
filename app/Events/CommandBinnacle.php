<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class CommandBinnacle
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private string $operation;
    private string $cmd_id;
    private string $user_id;
    private string $details;
    
    public function __construct(string $operation,string $cmd_id,string $user_id,string $details)
    {
        $this->operation = $operation;
        $this->cmd_id = $cmd_id;
        $this->user_id = $user_id;
        $this->details = $details;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function handle()
    {
        DB::table('command_binnacles')->insert(
            [
                'operation'        => $this->operation,
                'command_id'       => $this->cmd_id,
                'user_id'          => $this->user_id,
                'details'          => $this->details
            ]
        );
    }
}
