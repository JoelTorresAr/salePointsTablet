<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class CreateCommandBinnacle implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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

    public function handle()
    {
        DB::beginTransaction();
        try {
            DB::table('command_binnacles')->insert(
                [
                    'operation'        => $this->operation,
                    'command_id'       => $this->cmd_id,
                    'user_id'          => $this->user_id,
                    'details'          => $this->details
                ]
            );
            DB::commit();
        } catch (\Throwable $e) {
            $this->failed($e);
        }
    }

    public function failed($exception)
    {
        echo $exception->getMessage();
    }
}
