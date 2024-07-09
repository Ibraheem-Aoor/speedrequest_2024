<?php
namespace App\Services;

use App\Models\Contact;
use App\Models\Service;
use App\Models\WorkHours;
use App\Services\BaseModelService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class WorkHoursService extends BaseModelService
{

    public function __construct()
    {
        parent::__construct(new WorkHours());
        $this->allow_all_records = true;
    }


    public function create(Request $request)
    {
        try{

            $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

            $data = [];

            foreach ($days as $day) {
                $status = $request->has($day . '_status');
                $data[$day . '_hours_from'] = $status ? $request->input($day . '_hours_from') : null;
                $data[$day . '_hours_to'] = $status ? $request->input($day . '_hours_to') : null;
            }
            WorkHours::updateOrCreate(
                ['id' => 1], // Assuming you only have one record to update or create
                $data
            );
            Cache::forget('work_hours');
        }catch(Throwable $e)
        {
            Log::error("Fail with " . __FUNCTION__ . " in Model : " . get_class($this) . " erorr:" . $e->getMessage());
            return generateResponse(status: false, message: __('response.error'));
        }
        return generateResponse(status: true, message: __('response.success_updated'));
    }



    protected function getModelAttributes($request)
    {
        //
    }




}
