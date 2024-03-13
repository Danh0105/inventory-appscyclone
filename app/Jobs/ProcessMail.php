<?php

namespace App\Jobs;

use App\Mail\Apply;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ProcessMail implements ShouldQueue/* , ShouldBeUnique */
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    /*     public $uniqueFor = 5; */
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
        $this->onQueue('emails');
        $this->onConnection('database');
    }

    /**
     * Execute the job.
     */

    public function handle()
    {
        Mail::send($this->data);
    }
}
