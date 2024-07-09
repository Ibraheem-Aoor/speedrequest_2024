<?php

namespace App\Transformers\Admin;

use App\Models\Barber;
use App\Models\Order;
use App\Models\Platform;
use App\Models\Service;
use League\Fractal\TransformerAbstract;

class OrderTransformer extends TransformerAbstract
{
    /**
     * @param \App\Models\AccountTree $barber
     * @return array
     */
    public function transform(Order $barber): array
    {
        return [
            'id' => $barber->id,
            'platform' => $barber->service->platform->name,
            'service' => $barber->service->name,
            'created_at' => date($barber->created_at),
            'actions' => $this->getActions($barber),
        ];
    }


    #<img loading="lazy" width="10" height="10" src="' . asset('assets/user/libs/feather-icons/icons/edit.svg') . '">
    public function getActions($barber)
    {
        return "";
        return '<div class="text-end p-3">
        <a data-method="POST"  data-bs-toggle="modal"
            data-header-title="' . __('general.update_barber') . ': ' . $barber->name . '"
            data-bs-target="#platform-modal" data-image="' . getImageUrl($barber->logo) . '" data-name="' . $barber->name . '"
            data-status="' . $barber->status . '" data-order="' . $barber->order . '"
            data-action="' . route('admin.platform.update', encrypt($barber->id)) . '" data-method="POST"
            class="btn btn-sm btn-soft-primary"><img loading="lazy" width="10" height="10" src="' . asset('assets/common/edit.svg') . '"></a>

        <a data-bs-toggle="modal" data-bs-target="#delete-modal" data-delete-url="' . route('admin.platform.destroy', encrypt($barber->id)) . '"
        data-message="' . __('general.confirm_delete') . '" data-name="' . $barber->name . '" id="row-' . $barber->id . '"
       class="btn btn-sm btn-danger ms-2"><img loading="lazy" width="10" height="10" src="' . asset('assets/user/libs/feather-icons/icons/trash.svg') . '"></a>
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
