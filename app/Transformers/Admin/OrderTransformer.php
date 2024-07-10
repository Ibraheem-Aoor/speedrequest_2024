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
     * @param \App\Models\AccountTree $order
     * @return array
     */
    public function transform(Order $order): array
    {
        return [
            'id' => $order->id,
            'platform' => $order->service->platform->name,
            'service' => $order->service->name,
            'profile' => $order->profile,
            'created_at' => date($order->created_at),
            'actions' => request()->query('completed') != 1 ?  $this->getActions($order) : "",
        ];
    }


    #<img loading="lazy" width="10" height="10" src="' . asset('assets/user/libs/feather-icons/icons/edit.svg') . '">
    public function getActions($order)
    {

            return '<div class="text-end p-3">
            <a data-method="POST"  data-bs-toggle="modal"
            data-header-title="' . __('general.confirm_order', ['order' => $order->id]) . ' ' . $order->name . '"
            data-bs-target="#order-modal" data-platform-image="' . getImageUrl($order->service->platform->logo) . '" data-service-image="' . getImageUrl($order->service->image) . '"
            data-platform-name="' . getImageUrl($order->service->platform->name) . '" data-service-name="' . $order->service->name . '"
            data-action="' . route('admin.order.confirm', $order->id) . '" data-method="POST"
            class="btn btn-lg btn-soft-primary"><img loading="lazy" width="10" height="10" src="' . asset('assets/user/libs/feather-icons/icons/check.svg') . '"></a>

            ';
    }

    public function getStatusColumn($order)
    {
        $is_checked = $order->status ? 'checked' : null;
        $html = '<div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="status"  ' . $is_checked . ' data-route="' . route('admin.platform.toggle_status') . '" data-id="' . $order->id . '" onclick="toggleStatus($(this));">
    </div>';
        return $html;
    }


}
