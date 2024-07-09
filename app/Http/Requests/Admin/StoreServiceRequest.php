<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends BaseAdminRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        return [
            'title'              =>  'required',
            'platform_id'       =>  'required',
            'task_title'       =>  'required',
            'offer_url'         =>  'required|url',
            'features'          =>  'required|array',
            'features.*'        =>  'required',
        ];
    }


}
