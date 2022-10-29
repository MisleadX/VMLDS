<?php

namespace App\Http\Controllers\Admin;

use App\Codes\Logic\_CrudController;
use Illuminate\Http\Request;

class ContactController extends _CrudController
{
    public function __construct(Request $request)
    {
        $passingData = [
            'id' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0
            ],
            'name' => [
            ],
            'email' => [
                'type' => 'email',
            ],
            'phone' => [
            ],
            'subject' => [
            ],
            'message' => [
                'type' => 'textarea',
                'list' => 0
            ],
            'status' => [
                'type' => 'select',
            ],
            'created_at' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0,
            ],
            'action' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0,
            ]
        ];

        parent::__construct(
            $request, 'general.contact', 'contact', 'contact', 'contact',
            $passingData
        );

        $this->data['listSet'] = [
            'status' => get_list_status_contact(),
        ];

        $this->listView['dataTable'] = env('ADMIN_TEMPLATE').'.page.contact.list_button';
        $this->listView['show'] = env('ADMIN_TEMPLATE').'.page.contact.forms';
    }

    public function read($id)
    {
        $this->callPermission();

        $viewType = 'edit';

        $getData = $this->crud->show($id);
        if (!$getData) {
            return redirect()->route($this->rootRoute.'.' . $this->route . '.index');
        }

        $data['status'] = 80;

        $getData = $this->crud->update($data, $id);

        $id = $getData->id;

        if($this->request->ajax()){
            return response()->json(['result' => 1, 'message' => __('general.marked_as_read')]);
        }
        else {
            session()->flash('message', __('general.marked_as_read'));
            session()->flash('message_alert', 2);
            return redirect()->route($this->rootRoute.'.' . $this->route . '.show', $id);
        }
    }
}
