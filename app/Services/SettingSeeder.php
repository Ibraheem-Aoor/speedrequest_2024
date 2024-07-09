<?php
namespace App\Services;

use App\Models\Contact;
use App\Models\Service;
use App\Models\Setting;
use App\Models\WorkHours;
use App\Services\BaseModelService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class SettingSeeder extends BaseModelService
{

    public function __construct()
    {
        parent::__construct(new Setting());
        $this->allow_all_records = true;
    }


    public function updateOrCreate(Request $request)
    {
        try {
            $settings = $request->except('_token');
            foreach ($settings as $key => $value) {
                Setting::updateOrCreate(['key' => $key], [
                    'key' => $key,
                    'value' => $value,
                ]);
            }
            Cache::forget('settings');
        } catch (Throwable $e) {
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
