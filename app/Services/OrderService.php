<?php
namespace App\Services;

use App\Jobs\NewBookingJob;
use App\Models\Admin;
use App\Models\Barber;
use App\Models\Booking;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Service;
use App\Models\ServiceBooking;
use App\Models\Setting;
use App\Models\WorkHours;
use App\Services\BaseModelService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class OrderService extends BaseModelService
{

    public function __construct()
    {
        parent::__construct(new Order());
        $this->allow_all_records = true;
    }



    public function update($id, $request)
    {
        $model = $this->find($id);
        try {
            $data = $this->getModelAttributes($request);
            $model->update($data);
        } catch (Throwable $e) {
            Log::error("Fail with Updated in Model : " . get_class($this) . " erorr:" . $e->getMessage());
            return generateResponse(status: false, message: __('response.faild_created'));
        }
        session()->forget(['has_visited_cpa_page', 'current_order_id', 'user_ip', 'last_visit_order_' . $model->id]);
        return generateResponse(status: true, message: __('response.success_created'), redirect: route('home'));

    }


    public function confirm(Order $order)
    {
        try {
            $order->update([
                'has_completed_cpa' => true,
            ]);
        } catch (Throwable $e) {
            Log::error("Fail with Updated in Model : " . get_class($this) . " erorr:" . $e->getMessage());
            return generateResponse(status: false, message: __('response.faild_created'));
        }
        return generateResponse(status: true, message: __('response.update_success'), modal_to_hide: $order->modal, table_reload: true, table: '#myTable');
    }


    public function delete($id)
    {
        try {
            $model = $this->find($id);
            $model->delete();
        } catch (Throwable $e) {
            Log::error("Fail with Deleted in Model : " . get_class($this) . " erorr:" . $e->getMessage());
            return generateResponse(false, 500, message: __('response.faild_delete'));
        }
        return generateResponse(true, 200, message: __('response.success_delete'), modal_to_hide: '#delete-modal', table_reload: true, table: '#myTable', row_to_delete: $id, is_deleted: true);
    }




    public function toggleStatus($id)
    {
        try {
            $model = $this->find($id);
            $model->update([
                'status' => !$model->status,
            ]);
            $response = generateResponse(status: true, message: __('response.success_updated'));
        } catch (Throwable $e) {
            Log::error("Fail with " . __FUNCTION__ . " in Model : " . get_class($this) . " erorr:" . $e->getMessage());
            $response = generateResponse(status: false, message: __('response.error'));
        }
        return $response;
    }



    protected function getModelAttributes($request)
    {
        $data = $request->toArray();
        return $data;
    }


    public function clearRequest()
    {
        // Clean query parameters
        $cleanedQuery = collect(request()->query())->mapWithKeys(function ($value, $key) {
            $cleanKey = str_replace('amp;', '', $key);
            return [$cleanKey => $value];
        })->toArray();

        // Replace the query parameters in the request
        return request()->query->replace($cleanedQuery);
    }

    /**
     * reutrn the table data for view
     */
    public function getTableData(Request $request)
    {
        $query = $this->model::query()
            ->with('service.platform')
            ->when(request()->has('completed'), function ($query) {
                $query->where('has_completed_cpa', request()->query('completed'));
            })
            ->when(request()->has('profile'), function ($query) {
                $profile = request()->query('profile');
                if ($profile == 0) {
                    $query->withoutProfile();
                } else {
                    $query->withProfile();
                }
                $query->where('has_completed_cpa' , false);
            });
        return DataTables::of($query)
            ->setTransformer($this->model->transformer)
            ->make(true);
    }



}
