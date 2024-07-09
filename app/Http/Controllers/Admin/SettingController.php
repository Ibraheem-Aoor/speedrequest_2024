<?php

namespace App\Http\Controllers\Admin;


use App\Models\Contact;
use App\Services\ContactService;
use Illuminate\Http\Request;
use Throwable;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Admin\StoreServiceRequest;
use App\Http\Requests\Admin\StoreWorkHoursRequest;
use App\Http\Requests\Admin\UpdateServiceRequest;
use App\Models\Service;
use App\Models\Setting;
use App\Services\ServiceService;
use App\Services\SettingSeeder;
use App\Services\WorkHoursService;

class SettingController extends BaseAdminController
{

    public function __construct(protected SettingSeeder $service)
    {
        $this->base_view_path = 'admin.settings';
        $this->base_route_path = 'admin.setting';

    }
    public function edit()
    {
        $data['route'] = $this->base_route_path;
        $data['settings'] = Setting::query()->pluck('value' , 'key')->toArray();
        return view("{$this->base_view_path}.site.edit", $data);
    }

    public function update(Request $request)
    {
        return $this->service->updateOrCreate($request);
    }
}
