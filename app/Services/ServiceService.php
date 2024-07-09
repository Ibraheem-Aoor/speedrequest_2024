<?php
namespace App\Services;

use App\Models\Contact;
use App\Models\Service;
use App\Services\BaseModelService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class ServiceService extends BaseModelService
{

    public function __construct()
    {
        parent::__construct(new Service());
        $this->allow_all_records = true;
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
        if($request->hasFile('image'))
        {
            $data['image'] = saveImage('services' , $request->file('image'));
        }
        $data['status'] = @$data['status'] == 'on';
        return $data;
    }

    /**
     * reutrn the table data for view
     */
    public function getTableData(Request $request)
    {
        $query = $this->model::query();
        return DataTables::of($query)
            ->setTransformer($this->model->transformer)
            ->make(true);
    }



}
