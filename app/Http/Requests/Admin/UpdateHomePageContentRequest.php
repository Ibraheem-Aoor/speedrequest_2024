<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHomePageContentRequest extends BaseAdminRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'sliders' => 'required|array',
            'sliders.*.image' => 'nullable|image|max:1024',
            'sliders.*.text' => 'required|string',
        ];
    }
}
