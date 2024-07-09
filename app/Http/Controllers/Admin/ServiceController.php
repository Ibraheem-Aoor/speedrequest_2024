<?php

namespace App\Http\Controllers\Admin;


use App\Models\Contact;
use App\Services\ContactService;
use Illuminate\Http\Request;
use Throwable;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Admin\StoreServiceRequest;
use App\Http\Requests\Admin\UpdateServiceRequest;
use App\Models\Service;
use App\Services\PlatformService;
use App\Services\ServiceService;
use Illuminate\Support\Facades\Cache;

class ServiceController extends BaseAdminController
{
    protected $platforms;
    public function __construct(protected ServiceService $service , PlatformService $platform_service)
    {
        $this->base_view_path = 'admin.services';
        $this->base_route_path = 'admin.service';
        $this->platforms = $platform_service->get(paginate:0 , filters:['status' => '1']);
    }
    public function index()
    {
        $data['table_data_url'] = route("{$this->base_route_path}.table");
        $data['route'] = $this->base_route_path;
        $data['platforms'] = $this->platforms;
        return view("{$this->base_view_path}.index", $data);
    }

    public function store(StoreServiceRequest $request)
    {
        return $this->service->create($request);
    }
    public function update($id , StoreServiceRequest $request)
    {
        return $this->service->update(decrypt($id) , $request);
    }

    public function destroy($id)
    {
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
