<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\BaseSiteContoller;
use App\Http\Requests\Site\ContactRequest;
use App\Http\Requests\Site\StoreBookingRequest;
use App\Mail\TestMail;
use App\Models\Booking;
use App\Models\Contact;
use App\Models\ServiceBooking;
use App\Models\WorkHours;
use App\Services\BookingService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Throwable;

class BookingController extends BaseSiteContoller
{

    public function __construct(protected BookingService $booking_service)
    {

    }

    /**
     * Fetch The Available Times While Making Sure We are not fetching "reserved" times.
     */
    public function fetchAvailableTimes(Request $request)
    {
        return $this->booking_service->fetchAvailableTimes($request);
    }


    public function store(StoreBookingRequest $request)
    {
        return $this->booking_service->create($request);
    }

}
