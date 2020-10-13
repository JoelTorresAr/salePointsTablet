<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class CreateBinnacle implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $operation;
    private string $table;
    private string $user_id;
    private string $details;

    public function __construct(string $operation,string $table,string $user_id,string $details)
    {
        $this->operation = $operation;
        $this->table = $table;
        $this->user_id = $user_id;
        $this->details = $details;
    }

    public function handle()
    {
        DB::beginTransaction();
        try {
            DB::table('binnacles')->insert(
                [
                    'operation'        => $this->operation,
                    'user_id'          => $this->user_id,
                    'table'       => $this->table,
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
