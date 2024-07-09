<?php

namespace App\Http\Controllers\Admin;


use App\Models\Contact;
use App\Services\ContactService;
use Illuminate\Http\Request;
use Throwable;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Admin\StoreBarberRequest;
use App\Http\Requests\Admin\StoreServiceRequest;
use App\Http\Requests\Admin\UpdateBarberRequest;
use App\Http\Requests\Admin\UpdateServiceRequest;
use App\Models\Service;
use App\Services\BarberService;
use App\Services\ServiceService;
use Illuminate\Support\Facades\Cache;

class BarberController extends BaseAdminController
{

    public function __construct(protected BarberService $service)
    {
        $this->base_view_path = 'admin.barbers';
        $this->base_route_path = 'admin.barber';

    }
    public function index()
    {
        $data['table_data_url'] = route("{$this->base_route_path}.table");
        $data['route'] = $this->base_route_path;
        return view("{$this->base_view_path}.index", $data);
    }

    public function store(StoreBarberRequest $request)
    {
        Cache::forget('barbers');
        return $this->service->create($request);
    }
    public function update($id , UpdateBarberRequest $request)
    {
        Cache::forget('barbers');
        return $this->service->update(decrypt($id) , $request);
    }

    public function destroy($id)
    {
        Cache::forget('barbers');
        return $this->service->delete(decrypt($id));
    }

    public function toggleStatus(Request $request)
    {
        $response = $this->service->toggleStatus($request->id);
        return response()->json($response);
    }


    public function getTableData(Request $request)
    {
        if ($request->ajax()) {
            return $this->service->getTableData($request);
        }
        return response()->json(['error' => 'Not a valid request'], 400);
    }
}
