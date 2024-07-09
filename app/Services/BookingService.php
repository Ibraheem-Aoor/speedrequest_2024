<?php
namespace App\Services;

use App\Jobs\NewBookingJob;
use App\Models\Admin;
use App\Models\Barber;
use App\Models\Booking;
use App\Models\Contact;
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

class BookingService extends BaseModelService
{

    public function __construct()
    {
        parent::__construct(new Booking());
        $this->allow_all_records = true;
    }


    /**
     * Fetch The Available Times While Making Sure We are not fetching "reserved" times.
     */
    public function fetchAvailableTimes(Request $request)
    {
        $date = $request->input('date');
        $dayOfWeek = strtolower(Carbon::parse($date)->format('l')); // e.g., 'Monday'
        $workHours = WorkHours::first();

        if (!$workHours) {
            return response()->json(['available_times' => []]);
        }

        $hoursFrom = $workHours->{$dayOfWeek . '_hours_from'};
        $hoursTo = $workHours->{$dayOfWeek . '_hours_to'};

        if (!$hoursFrom || !$hoursTo) {
            return response()->json(['available_times' => []]);
        }

        $reservedTimes = $this->model::where('date', $date)
            ->pluck('time')
            ->toArray();

        $availableTimes = $this->generateAvailableTimes($hoursFrom, $hoursTo, $reservedTimes);

        return response()->json(['available_times' => $availableTimes]);
    }
    private function generateAvailableTimes($start, $end, $reservedTimes)
    {
        $startTime = Carbon::createFromFormat('H:i', $start);
        $endTime = Carbon::createFromFormat('H:i', $end);
        $interval = Service::query()->whereIn('id' , request('service_ids'))->min('time_between_bookings') ?? 30; // 30 minutes default
        $times = [];
        while ($startTime->lte($endTime)) {
            $time = $startTime->format('h:i A'); // 12-hour format with AM/PM
            if (!in_array($time, $reservedTimes)) {
                $times[] = $time;
            }
            $startTime->addMinutes($interval);
        }
        return $times;
    }

    public function create(Request $request)
    {
        try {
            // Save booking
            $booking = $this->model::create([
                'barber_id' => $request->barber_id,
                'client_name' => $request->client_name,
                'client_phone' => $request->client_phone,
                'time' => $request->time,
                'date' => $request->date
            ]);

            foreach ($request->service_ids as $service_id) {
                ServiceBooking::create([
                    'service_id' => $service_id,
                    'booking_id' => $booking->id,
                ]);
            }
            NewBookingJob::dispatch($booking, Admin::get());
        } catch (Throwable $e) {
            Log::error("Fail with Creation in Model : " . get_class($this) . " erorr:" . $e->getMessage());
            return generateResponse(status: false, message: __('response.faild_created'));
        }
        return generateResponse(status: true, modal_to_hide: $this->model->modal, message: __('response.success_created'), reload: true);

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
        if ($request->hasFile('image')) {
            $data['image'] = saveImage('services', $request->file('image'));
        }
        $data['status'] = @$data['status'] == 'on';
        return $data;
    }

    /**
     * reutrn the table data for view
     */
    public function getTableData(Request $request)
    {
        $query = $this->model::query()
            ->with(['barber', 'services'])
            ->when($request->has('booking_id'), function ($query) use ($request) {
                getAuthUser('admin')->unReadNotifications()->find($request->query('amp;notification_id'))?->markAsRead();
                $query->where('id', $request->query('booking_id'));
            });
        return DataTables::of($query)
            ->setTransformer($this->model->transformer)
            ->make(true);
    }



}
