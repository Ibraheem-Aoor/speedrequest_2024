<?php

namespace App\Transformers\Admin;

use App\Models\Barber;
use App\Models\Platform;
use App\Models\Service;
use League\Fractal\TransformerAbstract;

class PlatformTransformer extends TransformerAbstract
{
    /**
     * @param \App\Models\AccountTree $barber
     * @return array
     */
    public function transform(Platform $barber): array
    {
        return [
            'id' => $barber->id,
            'image' => '<img src="' . getImageUrl($barber->logo) . '" width="100" height="100"/>',
            'name' => $barber->name,
            'status' => $this->getStatusColumn($barber),
            'created_at' => date($barber->created_at),
            'actions' => $this->getActions($barber),
        ];
    }


    #<img loading="lazy" width="10" height="10" src="' . asset('assets/user/libs/feather-icons/icons/edit.svg') . '">
    public function getActions($barber)
    {
        return '<div class="text-end p-3">
        <a data-method="POST"  data-bs-toggle="modal"
            data-header-title="' . __('general.update_barber') . ': ' . $barber->name . '"
            data-bs-target="#platform-modal" data-image="' . getImageUrl($barber->logo) . '" data-name="' . $barber->name . '"
            data-status="' . $barber->status . '"
            data-action="' . route('admin.platform.update', encrypt($barber->id)) . '" data-method="POST"
            class="btn btn-sm btn-soft-primary"><img loading="lazy" width="10" height="10" src="' . asset('assets/common/edit.svg') . '"></a>

        <a data-bs-toggle="modal" data-bs-target="#delete-modal" data-delete-url="' . route('admin.platform.destroy', encrypt($barber->id)) . '"
        data-message="' . __('general.confirm_delete') . '" data-name="' . $barber->name . '" id="row-' . $barber->id . '"
       class="btn btn-sm btn-danger ms-2"><img loading="lazy" width="10" height="10" src="' . asset('assets/user/libs/feather-icons/icons/trash.svg') . '"><i class="fa fa-eye"></i></a>
        </div>';
    }

    public function getStatusColumn($barber)
    {
        $is_checked = $barber->status ? 'checked' : null;
        $html = '<div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="status"  ' . $is_checked . ' data-route="' . route('admin.platform.toggle_status') . '" data-id="' . $barber->id . '" onclick="toggleStatus($(this));">
    </div>';
        return $html;
    }


}
