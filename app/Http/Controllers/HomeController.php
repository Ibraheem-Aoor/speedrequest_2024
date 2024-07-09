<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use App\Models\Barber;
use App\Models\Page;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Webshop;
use App\Models\WorkHours;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class HomeController extends BaseSiteContoller
{

    public $services, $barbers, $about_page;
    public function __construct()
    {
        $this->page_title = __('site.home');
        $this->base_view_path = "site.";
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {
        $data['page_title'] = $this->page_title;
        return view($this->base_view_path . 'home', $data);
    }



    public function about(): View
    {
        $data['page'] = $this->about_page;
        $data['services'] = $this->services;
        $data['barbers'] = $this->barbers;
        return view($this->base_view_path . 'page', $data);
    }
    public function services(): View
    {
        $data['page_title'] = __('site.services');
        $data['services'] = cacheAndGet('services', now()->addWeek(), $this->services);
        $data['barbers'] = $this->barbers;

        return view($this->base_view_path . 'services', $data);
    }

    public function contact(): View
    {
        $data['page_title'] = __('site.contact');
        $data['services'] = cacheAndGet('services', now()->addWeek(), $this->services);
        $data['barbers'] = $this->barbers;
        return view($this->base_view_path . 'contact', $data);
    }

}
