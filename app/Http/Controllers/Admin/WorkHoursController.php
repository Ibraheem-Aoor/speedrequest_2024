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
use App\Services\ServiceService;
use App\Services\WorkHoursService;

class WorkHoursController extends BaseAdminController
{

    public function __construct(protected WorkHoursService $service)
    {
        $this->base_view_path = 'admin.work_hours';
        $this->base_route_path = 'admin.work_hour';

    }
    public function edit()
    {
        $data['route'] = $this->base_route_path;
        $data['work_hours'] = $this->service->get(paginate:0)->first();
        return view("{$this->base_view_path}.edit", $data);
    }

    public function store(StoreWorkHoursRequest $request)
    {
        return $this->service->create($request);
    }
}
