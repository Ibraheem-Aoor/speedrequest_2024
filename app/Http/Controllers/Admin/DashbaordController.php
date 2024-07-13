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
        $data = $this->getDashboardCounts();
        $monthlyVisits = $this->getMonthlyVisits();
        $weeklyVisits = $this->getCurrentWeekVisits();

        $data['monthly_visits'] = $monthlyVisits['data'];
        $data['month_labels'] = $monthlyVisits['labels'];
        $data['weekly_visits'] = $weeklyVisits['data'];
        $data['week_labels'] = $weeklyVisits['labels'];
        $data['browser_visits'] = $this->getBrowserVisits();
        $data['device_visits'] = $this->getDeviceVisits();
        $data['today_orders'] = $this->getTodayOrders();

        return view('admin.dashboard', $data);
    }

    private function getDashboardCounts()
    {
        return [
            'service_count' => Service::count(),
            'platform_count' => Platform::count(),
            'booking_count' => Order::query()->withProfile()->count(),
            'contact_message_count' => Contact::count(),
            'total_visits' => Visit::count(),
        ];
    }

    private function getMonthlyVisits()
    {
        $monthlyVisits = Visit::selectRaw('MONTH(created_at) as month, COUNT(*) as visits')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $monthLabels = [];
        $monthlyData = [];

        for ($i = 1; $i <= 12; $i++) {
            $monthLabels[] = Carbon::create()->month($i)->format('F');
            $monthlyData[$i] = 0;
        }

        foreach ($monthlyVisits as $item) {
            $monthlyData[$item->month] = $item->visits;
        }

        return ['labels' => $monthLabels, 'data' => array_values($monthlyData)];
    }

    private function getCurrentWeekVisits()
    {
        $currentWeekVisits = Visit::selectRaw('DAYOFWEEK(created_at) as day, COUNT(*) as visits')
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        $weekLabels = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        $weeklyData = array_fill(0, 7, 0);

        foreach ($currentWeekVisits as $item) {
            $weeklyData[$item->day - 1] = $item->visits;
        }

        return ['labels' => $weekLabels, 'data' => $weeklyData];
    }

    private function getBrowserVisits()
    {
        return Visit::select('browser', DB::raw('COUNT(*) as visits'))
            ->groupBy('browser')
            ->get();
    }

    private function getDeviceVisits()
    {
        return Visit::select('platform', DB::raw('COUNT(*) as visits'))
            ->groupBy('platform')
            ->get();
    }

    private function getTodayOrders()
    {
        return Order::query()
            ->whereDate('created_at', today()->toDateString())
            ->withProfile()
            ->with('service')
            ->limit(10)
            ->get();
    }



}
