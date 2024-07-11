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
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Shetabit\Visitor\Facade\Visitor;
use Shetabit\Visitor\Models\Visit;

class DashbaordController extends Controller
{

    public function dashboard()
    {
        $data['service_count'] = Service::count();
        $data['platform_count'] = Platform::count();
        $data['booking_count'] = Order::query()->withProfile()->count();
        $data['contact_message_count'] = Contact::count();

        // Fetch total visits
        $data['total_visits'] = Visit::count();

        // Fetch visits grouped by month for the current year
        $monthly_visits = Visit::selectRaw('MONTH(created_at) as month, COUNT(*) as visits')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Prepare data for monthly visits
        $month_labels = [];
        $monthly_data = [];

        // Initialize visits for each month to 0
        for ($i = 1; $i <= 12; $i++) {
            $month_labels[] = Carbon::create()->month($i)->format('F');
            $monthly_data[$i] = 0;
        }

        // Fill in actual visit counts where available
        foreach ($monthly_visits as $item) {
            $monthly_data[$item->month] = $item->visits;
        }

        // Assign data to the view
        $data['monthly_visits'] = array_values($monthly_data); // Reset array keys for sequential data
        $data['month_labels'] = $month_labels;
        $data['browser_visits'] = Visit::select('browser', DB::raw('COUNT(*) as visits'))
        ->groupBy('browser')
        ->get();
        $data['device_visits'] = Visit::select('platform', DB::raw('COUNT(*) as visits'))
        ->groupBy('platform')
        ->get();
        $data['today_orders'] = Order::query()->whereDate('created_at' , today()->toDateString())->withProfile()->with('service')->limit(10)->get();

        return view('admin.dashboard', $data);
    }

}
