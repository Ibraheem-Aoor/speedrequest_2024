<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreWorkHoursRequest extends BaseAdminRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

        foreach ($days as $day) {
            $rules["{$day}_status"] = 'nullable';
            $rules["{$day}_hours_from"] = 'nullable|required_if:' . $day . '_status,true|date_format:H:i';
            $rules["{$day}_hours_to"] = 'nullable|required_if:' . $day . '_status,true|date_format:H:i|after:' . $day . '_hours_from';
        }
        return $rules;
    }
}
