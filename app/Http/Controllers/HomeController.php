<?php

namespace App\Http\Controllers;

use App\Http\Requests\Site\ConfirmOrderRequest;
use App\Mail\TestMail;
use App\Models\Barber;
use App\Models\Order;
use App\Models\Page;
use App\Models\Platform;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Webshop;
use App\Models\WorkHours;
use App\Services\OrderService;
use App\Services\PlatformService;
use App\Services\ServiceService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class HomeController extends BaseSiteContoller
{

    public $services, $barbers, $about_page;
    public function __construct(protected PlatformService $platform_service, protected ServiceService $service_service)
    {
        $this->page_title = __('site.home');
        $this->base_view_path = "site.";
        if (!session()->has('user_ip')) {
            session()->put('user_ip', request()->ip());
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {

        $data['platforms'] = cacheAndGet('platforms', now()->addWeek(), $this->platform_service->get(paginate: 0, filters: ['status' => '1'], order: ['order', 'asc']));
        $data['page_title'] = $this->page_title;
        return view($this->base_view_path . 'home', $data);
    }

    public function services($platform_id): View
    {
        $data['page_title'] = __('site.services');
        $data['platform'] = $this->platform_service->find(decrypt($platform_id), relations: ['services']);
        return view($this->base_view_path . 'services', $data);
    }

    public function redirectToOffer($service_id)
    {
        $service_id = decrypt($service_id);
        $current_order = Order::query()->create([
            'ip' => session()->get('user_ip'),
            'service_id' => $service_id,
        ]);
        session()->put('current_order_id', $current_order->id);
        session()->put('has_visited_cpa_page', 'YES');
        session()->put('last_visit_order_' . $current_order->id, time());
        $service = $this->service_service->find(($service_id));
        return redirect($service->offer_url);
    }

    /**
     * This Is The Callback The user being redirected to from cpa dashboard.
     * if the incoming ip is the same user ip. this means the user try to bypass the challenge.
     * else: the user has completed the challenge.
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    /**
     * This is the callback the user is redirected to from the CPA dashboard.
     * If the incoming IP is the same as the user IP, this means the user tried to bypass the challenge.
     * Otherwise, the user has completed the challenge.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function taskCompleted(Request $request)
    {
        if (
            session()->has('has_visited_cpa_page') && session()->get('has_visited_cpa_page') == 'YES' && session()->has('current_order_id')
        ) {
            $data['order'] = Order::query()->find(session()->get('current_order_id'));

            if (!isset($data['order'])) {
                return abort(404);
            }

            // Calculate the time elapsed since the last visit
            $lastVisitTime = session()->get('last_visit_order_' . $data['order']->id);
            $elapsedTime = time() - $lastVisitTime;

            // Minimum time to stay (90 seconds)
            $minimumStaySeconds = 90;

            // Check if the minimum stay time has been reached
            if ($elapsedTime >= $minimumStaySeconds) {
                return view('site.task_completed', $data);
            } else {
                return abort(404);
            }
        }

        abort(404);
    }

    public function confirmOrder(ConfirmOrderRequest $request, $order_id, OrderService $order_service)
    {
        return $order_service->update(decrypt($order_id), $request);
    }

    public function contact(): View
    {
        $data['page_title'] = __('site.contact');
        $data['services'] = cacheAndGet('services', now()->addWeek(), $this->services);
        $data['barbers'] = $this->barbers;
        return view($this->base_view_path . 'contact', $data);
    }

}
