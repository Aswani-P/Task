<?php

namespace App\Jobs;

use App\Mail\SendEmail;
use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendQueueEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $task;

  
    public function __construct($task)
    {
 
        $this->task = $task;
    }

    public function handle()
    {
        Mail::to($this->task->email)->send(new SendEmail($this->task));
        Mail::to('aswanianup2000@gmail.com')->send(new SendEmail($this->task));
    }
}