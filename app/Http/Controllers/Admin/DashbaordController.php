<?php

namespace App\Http\Controllers\Admin;

use App\Enums\WebshopEnum;
use App\Http\Controllers\Controller;
use App\Models\Barber;
use App\Models\Booking;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Platform;
use App\Models\Service;
use App\Models\Webshop;
use App\Services\Api\BolService;
use Illuminate\Http\Request;

class DashbaordController extends Controller
{
    public function dashboard()
    {
        $data['service_count'] = Service::query()->count();
        $data['platform_count'] = Platform::query()->count();
        $data['booking_count'] = Order::query()->count();
        $data['contact_message_count'] = Contact::query()->count();
        return view('admin.dashboard' , $data);
    }
}
