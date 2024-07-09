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
use App\Services\BookingService;
use App\Services\ServiceService;
use Illuminate\Support\Facades\Cache;

class BookingController extends BaseAdminController
{

    public function __construct(protected BookingService $service)
    {
        $this->base_view_path = 'admin.bookings';
        $this->base_route_path = 'admin.booking';

    }
    public function index(Request $request)
    {
        $data['table_data_url'] = route("{$this->base_route_path}.table" , $request->toArray());
        $data['route'] = $this->base_route_path;
        return view("{$this->base_view_path}.index", $data);
    }

    public function destroy($id)
    {
        return $this->service->delete(decrypt($id));
    }


    public function getTableData(Request $request)
    {
        if ($request->ajax()) {
            return $this->service->getTableData($request);
        }
        return response()->json(['error' => 'Not a valid request'], 400);
    }
}
