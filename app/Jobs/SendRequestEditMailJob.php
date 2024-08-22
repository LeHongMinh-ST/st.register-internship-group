<?php

namespace App\Jobs;

use App\Mail\RequestEditMail;
use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendRequestEditMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private readonly string  $email,
        private readonly Student $student,
        private readonly string  $key,
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            if (env('MAIL_DEBUG', false)) {
                Mail::to("hongminhle290@gmail.com")
                    ->send(new RequestEditMail($this->student, $this->key));
            } else {
                Mail::to($this->email)
                    ->send(new RequestEditMail($this->student, $this->key));
            }
        }catch (\Exception $exception){
            Log::error("job send mail", [
                'message' => $exception->getMessage(),
            ]);
        }
    }
}
