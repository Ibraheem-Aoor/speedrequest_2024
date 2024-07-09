<?php

namespace App\Http\Controllers\Admin;


use App\Enums\WebshopEnum;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Webshop;
use App\Services\Api\BolService;
use App\Services\ContactService;
use Illuminate\Http\Request;
use Throwable;

class ContactController extends Controller
{

    public function __construct(protected ContactService $service)
    {
        //
    }
    public function index()
    {
        $data['table_data_url'] = route('admin.contacts.table');
        return view('admin.contacts.index', $data);
    }
    public function destroy($id)
    {
        try{
            Contact::query()->findOrFail(decrypt($id))->delete();
            return response()->json(generateResponse(status:true , message:__('response.success_delete') , is_deleted:true , row_to_delete:decrypt($id)),);
        }catch(Throwable $e)
        {
            return response()->json(generateResponse(status:true , message:__('response.error')));
        }

    }

    public function getTableData(Request $request)
    {
        if ($request->ajax()) {
            return $this->service->getTableData($request);
        }
        return response()->json(['error' => 'Not a valid request'], 400);
    }
}
