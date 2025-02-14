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
use App\Models\Order;
use App\Models\Service;
use App\Services\BarberService;
use App\Services\OrderService;
use App\Services\ServiceService;
use Illuminate\Support\Facades\Cache;

class OrderController extends BaseAdminController
{

    public function __construct(protected OrderService $service)
    {
        $this->base_view_path = 'admin.orders';
        $this->base_route_path = 'admin.order';

    }
    public function index(Request $request)
    {
        $data['table_data_url'] = route("{$this->base_route_path}.table" , $request->query());
        $data['route'] = $this->base_route_path;
        $data['is_completed'] = request()->query('completed') == 1;
        $data['profile'] = request()->query('profile' );
        return view("{$this->base_view_path}.index", $data);
    }

    public function confirm(Order $order)
    {
        return $this->service->confirm($order);
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
