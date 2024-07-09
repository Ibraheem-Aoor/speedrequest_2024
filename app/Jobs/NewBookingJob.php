<?php

namespace App\Jobs;

use App\Models\Booking;
use App\Notifications\Admin\NewBookingNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Throwable;

class NewBookingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function tries()
    {
        return 3;
    }

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(protected Booking $booking, protected $admins = [])
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            Notification::send($this->admins, new NewBookingNotification($this->booking));
        }catch(Throwable $e)
        {
            Log::error("Fail with Job in Model : " . get_class($this) . " erorr:" . $e);
        }
    }
}
