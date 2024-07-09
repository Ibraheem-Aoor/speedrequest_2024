<?php

namespace App\Transformers\Admin;

use App\Models\AccountTree;
use App\Models\Contact;
use League\Fractal\TransformerAbstract;

class ContactTransformer extends TransformerAbstract
{
    /**
     * @param \App\Models\AccountTree $contact
     * @return array
     */
    public function transform(Contact $contact): array
    {
        return [
            'id' => $contact->id,
            'name' => $contact->name,
            'email' => $contact->email,
            'subject' => $contact->subject,
            'created_at' => date($contact->created_at),
            'actions' => $this->getActions($contact),
        ];
    }


    #<img loading="lazy" width="10" height="10" src="' . asset('assets/user/libs/feather-icons/icons/edit.svg') . '">
    public function getActions($contact)
    {
        return '<div class="text-end p-3">
        <a data-method="POST"  data-bs-toggle="modal"
            data-header-title="Contact Message: #' . $contact->id . '"
            data-bs-target="#contact-modal" data-message="'.$contact->message.'" class="btn btn-sm btn-soft-primary"><img loading="lazy" width="10" height="10" src="' . asset('assets/user/libs/feather-icons/icons/eye-line.svg') . '"></a>

        <a data-bs-toggle="modal" data-bs-target="#delete-modal" data-delete-url="' . route('admin.contacts.destroy', encrypt($contact->id)) . '"
        data-message="' . __('general.confirm_delete') . '" data-name="' . $contact->name . '" id="row-' . $contact->id . '"
        href="#" class="btn btn-sm btn-danger ms-2"><img loading="lazy" width="10" height="10" src="' . asset('assets/user/libs/feather-icons/icons/trash.svg') . '"><i class="fa fa-eye"></i></a>
        </div>';
    }

    public function getStatusColumn($contact)
    {
        $is_checked = $contact->is_active ? 'checked' : null;
        $html = '<div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="status"  ' . $is_checked . ' data-route="' . route('admin.contacts.toggle_status') . '" data-id="' . $contact->id . '" onclick="toggleStatus($(this));">
    </div>';
        return $html;
    }


}
