<?php

namespace App\Transformers\Admin;

use App\Models\Barber;
use App\Models\Platform;
use App\Models\Service;
use League\Fractal\TransformerAbstract;

class ServiceTransformer extends TransformerAbstract
{
    /**
     * @param \App\Models\AccountTree $barber
     * @return array
     */
    public function transform(Service $barber): array
    {
        return [
            'id' => $barber->id,
            'image' => '<img src="' . getImageUrl($barber->image) . '" width="100" height="100"/>',
            'name' => $barber?->name,
            'platform' => $barber->platform?->name,
            'status' => $this->getStatusColumn($barber),
            'created_at' => date($barber->created_at),
            'actions' => $this->getActions($barber),
        ];
    }


    #<img loading="lazy" width="10" height="10" src="' . asset('assets/user/libs/feather-icons/icons/edit.svg') . '">
    public function getActions($barber)
    {
        $editUrl = route('admin.service.update', encrypt($barber->id));
        $deleteUrl = route('admin.service.destroy', encrypt($barber->id));

        // Encode features array to JSON
        $featuresJson = ($barber->features);

        // Build the edit button HTML
        $editButton = sprintf('
            <a data-method="POST" data-bs-toggle="modal" data-bs-target="#service-modal"
               data-header-title="%s: %s"
               data-image="%s" data-name="%s"
               data-status="%s"
               data-action="%s" data-method="POST"
               data-title="%s" id="row-%s"
               data-platform_id="%s" data-task_title="%s"
               data-offer_url="%s" data-features=\'%s\'
               class="btn btn-sm btn-soft-primary">
               <img loading="lazy" width="10" height="10" src="%s">
            </a>',
            __('general.update_barber'),
            $barber->name,
            getImageUrl($barber->image),
            $barber->name,
            $barber->status,
            $editUrl,
            $barber->name,
            $barber->id,
            $barber->platform_id,
            $barber->task_title,
            $barber->offer_url,
            htmlspecialchars($featuresJson, ENT_QUOTES),
            asset('assets/common/edit.svg')
        );

        // Build the delete button HTML
        $deleteButton = sprintf('
            <a data-bs-toggle="modal" data-bs-target="#delete-modal"
               data-delete-url="%s"
               data-message="%s" data-name="%s" id="row-%s"
               class="btn btn-sm btn-danger ms-2">
               <img loading="lazy" width="10" height="10" src="%s">
            </a>',
            $deleteUrl,
            __('general.confirm_delete'),
            $barber->name,
            $barber->id,
            asset('assets/user/libs/feather-icons/icons/trash.svg')
        );

        // Combine buttons into the actions HTML
        $actions = '<div class="text-end p-3">' . $editButton . $deleteButton . '</div>';

        return $actions;
    }


    public function getStatusColumn($barber)
    {
        $is_checked = $barber->status ? 'checked' : null;
        $html = '<div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="status"  ' . $is_checked . ' data-route="' . route('admin.service.toggle_status') . '" data-id="' . $barber->id . '" onclick="toggleStatus($(this));">
    </div>';
        return $html;
    }


}
