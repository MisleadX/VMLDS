<?php

namespace App\Http\Controllers\Admin;

use App\Codes\Logic\_CrudController;
use Illuminate\Http\Request;

class PageController extends _CrudController
{
    protected $passingDataHome;
    protected $passingDataContact;

    public function __construct(Request $request)
    {
        $passingData = [
            'id' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0
            ],
            'name' => [
                'validate' => [
                    'edit' => 'required'
                ],
            ],
            'key' => [
                'edit' => 0,
            ],
            'title' => [
                'validate' => [
                    'edit' => 'required'
                ],
                'list' => 0
            ],
            'content' => [
                'validate' => [
                    'edit' => 'required'
                ],
                'type' => 'textarea',
                'list' => 0
            ],
            'image' => [
                'type' => 'image',
                'list' => 0
            ],
            'status' => [
                'validate' => [
                    'edit' => 'required'
                ],
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

        $this->passingDataHome = generatePassingData([
            'id' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0
            ],
            'name' => [
                'validate' => [
                    'edit' => 'required'
                ],
            ],
            'key' => [
                'edit' => 0,
            ],
            'title' => [
                'validate' => [
                    'edit' => 'required'
                ],
            ],
            'content' => [
                'validate' => [
                    'edit' => 'required'
                ],
                'type' => 'texteditor',
            ],
            'image' => [
                'path' => '/img',
                'type' => 'image'
            ],
            'contact_button' => [
                'validate' => [
                    'edit' => 'required'
                ],
            ],
            'image_2' => [
                'path' => '/img',
                'type' => 'image',
                'lang' => 'general.about_image'
            ],
            'title_2' => [
                'validate' => [
                    'edit' => 'required'
                ],
                'lang' => 'general.about'
            ],
            'content_2' => [
                'validate' => [
                    'edit' => 'required'
                ],
                'type' => 'texteditor',
                'lang' => 'general.about_content'
            ],
            'image' => [
                'path' => '/img',
                'type' => 'image'
            ],
            'title_3' => [
                'validate' => [
                    'edit' => 'required'
                ],
                'lang' => 'general.our_vision'
            ],
            'content_3' => [
                'validate' => [
                    'edit' => 'required'
                ],
                'type' => 'texteditor',
                'lang' => 'general.our_vision_content'
            ],
            'title_4' => [
                'validate' => [
                    'edit' => 'required'
                ],
                'lang' => 'general.our_mission'
            ],
            'content_4' => [
                'validate' => [
                    'edit' => 'required'
                ],
                'type' => 'texteditor',
                'lang' => 'general.our_mission_content'
            ],
            'status' => [
                'validate' => [
                    'edit' => 'required'
                ],
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
        ]);

        $this->passingDataContact = generatePassingData([
            'id' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0
            ],
            'name' => [
                'validate' => [
                    'edit' => 'required'
                ],
            ],
            'key' => [
                'edit' => 0,
            ],
            'title' => [
                'validate' => [
                    'edit' => 'required'
                ],
            ],
            'image' => [
                'path' => '/img',
                'type' => 'image'
            ],
            'status' => [
                'validate' => [
                    'edit' => 'required'
                ],
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
        ]);

        parent::__construct(
            $request, 'general.page', 'page', 'Page', 'page',
            $passingData
        );

        $this->data['listSet'] = [
            'status' => get_list_active_inactive(),
        ];
    }

    public function edit($id)
    {
        $this->callPermission();

        $getData = $this->crud->show($id);
        if (!$getData) {
            return redirect()->route($this->rootRoute.'.' . $this->route . '.index');
        }

        $data = $this->data;

        $getValue = json_decode($getData->value, true);

        $passingData = $this->passingData;
        if($getData->key == 'homepage') {
            $passingData = $this->passingDataHome;
            $getData->title = $getValue['title'] ?? null;
            $getData->content = $getValue['content'] ?? null;
            $getData->image = $getValue['image'] ?? null;
            $getData->contact_button = $getValue['contact_button'] ?? null;
            $getData->image_2 = $getValue['image_2'] ?? null;
            $getData->title_2 = $getValue['title_2'] ?? null;
            $getData->content_2 = $getValue['content_2'] ?? null;
            $getData->title_3 = $getValue['title_3'] ?? null;
            $getData->content_3 = $getValue['content_3'] ?? null;
            $getData->title_4 = $getValue['title_4'] ?? null;
            $getData->content_4 = $getValue['content_4'] ?? null;
        }
        else if($getData->key == 'contact') {
            $passingData = $this->passingDataContact;
            $getData->title = $getValue['title'] ?? null;
            $getData->image = $getValue['image'] ?? null;
        }
        else {
            session()->flash('message', __('general.data_not_found'));
            session()->flash('message_alert', 1);
            return redirect()->route($this->rootRoute.'.' . $this->route . '.index');
        }

        $data['viewType'] = 'edit';
        $data['formsTitle'] = __('general.title_edit', ['field' => $data['thisLabel']]);
        $data['passing'] = collectPassingData($passingData, $data['viewType']);
        $data['data'] = $getData;

        return view($this->listView[$data['viewType']], $data);
    }

    public function show($id)
    {
        $this->callPermission();

        $getData = $this->crud->show($id);
        if (!$getData) {
            return redirect()->route($this->rootRoute.'.' . $this->route . '.index');
        }

        $data = $this->data;

        $getValue = json_decode($getData->value, true);

        $passingData = $this->passingData;
        if($getData->key == 'homepage') {
            $passingData = $this->passingDataHome;
            $getData->title = $getValue['title'] ?? null;
            $getData->content = $getValue['content'] ?? null;
            $getData->image = $getValue['image'] ?? null;
            $getData->contact_button = $getValue['contact_button'] ?? null;
            $getData->image_2 = $getValue['image_2'] ?? null;
            $getData->title_2 = $getValue['title_2'] ?? null;
            $getData->content_2 = $getValue['content_2'] ?? null;
            $getData->title_3 = $getValue['title_3'] ?? null;
            $getData->content_3 = $getValue['content_3'] ?? null;
            $getData->title_4 = $getValue['title_4'] ?? null;
            $getData->content_4 = $getValue['content_4'] ?? null;
        }
        else if($getData->key == 'contact') {
            $passingData = $this->passingDataContact;
            $getData->title = $getValue['title'] ?? null;
            $getData->image = $getValue['image'] ?? null;
        }
        else {
            session()->flash('message', __('general.data_not_found'));
            session()->flash('message_alert', 1);
            return redirect()->route($this->rootRoute.'.' . $this->route . '.index');
        }

        $data['viewType'] = 'show';
        $data['formsTitle'] = __('general.title_show', ['field' => $data['thisLabel']]);
        $data['passing'] = collectPassingData($passingData, $data['viewType']);
        $data['data'] = $getData;

        return view($this->listView[$data['viewType']], $data);
    }

    public function update($id)
    {
        $this->callPermission();

        $viewType = 'edit';

        $getData = $this->crud->show($id);
        if (!$getData) {
            return redirect()->route($this->rootRoute.'.' . $this->route . '.index');
        }

        $getValue = json_decode($getData->value, true);

        $passingData = $this->passingData;
        if($getData->key == 'homepage') {
            $passingData = $this->passingDataHome;
            $getData->title = $getValue['title'] ?? null;
            $getData->content = $getValue['content'] ?? null;
            $getData->image = $getValue['image'] ?? null;
            $getData->contact_button = $getValue['contact_button'] ?? null;
            $getData->image_2 = $getValue['image_2'] ?? null;
            $getData->title_2 = $getValue['title_2'] ?? null;
            $getData->content_2 = $getValue['content_2'] ?? null;
            $getData->title_3 = $getValue['title_3'] ?? null;
            $getData->content_3 = $getValue['content_3'] ?? null;
            $getData->title_4 = $getValue['title_4'] ?? null;
            $getData->content_4 = $getValue['content_4'] ?? null;
        }
        else if($getData->key == 'contact') {
            $passingData = $this->passingDataContact;
            $getData->title = $getValue['title'] ?? null;
            $getData->image = $getValue['image'] ?? null;
        }
        else {
            session()->flash('message', __('general.data_not_found'));
            session()->flash('message_alert', 1);
            return redirect()->route($this->rootRoute.'.' . $this->route . '.index');
        }

        $getListCollectData = collectPassingData($passingData, $viewType);
        $validate = $this->setValidateData($getListCollectData, $viewType, $id);
        if (count($validate) > 0)
        {
            $data = $this->validate($this->request, $validate);
        }
        else {
            $data = [];
            foreach ($getListCollectData as $key => $val) {
                $data[$key] = $this->request->get($key);
            }
        }

        $data = $this->getCollectedData($getListCollectData, $viewType, $data, $getData);

        $value = [];

        if($getData->key == 'homepage') {
            $value['title'] = $data['title'];
            $value['content'] = $data['content'];
            $value['image'] = $data['image'] ?? $getData->image;
            $value['contact_button'] = $data['contact_button'];
            $value['image_2'] = $data['image_2'] ?? $getData->image_2;
            $value['title_2'] = $data['title_2'];
            $value['content_2'] = $data['content_2'];
            $value['title_3'] = $data['title_3'];
            $value['content_3'] = $data['content_3'];
            $value['title_4'] = $data['title_4'];
            $value['content_4'] = $data['content_4'];
            unset($data['title']);
            unset($data['content']);
            unset($data['image']);
            unset($data['contact_button']);
            unset($data['image_2']);
            unset($data['title_2']);
            unset($data['content_2']);
            unset($data['title_3']);
            unset($data['content_3']);
            unset($data['title_4']);
            unset($data['content_4']);
        }
        else if($getData->key == 'contact') {
            $value['title'] = $data['title'];
            $value['image'] = $data['image'] ?? $getData->image;
            unset($data['title']);
            unset($data['image']);
        }

        $data['value'] = json_encode($value);

        $getData = $this->crud->update($data, $id);

        $id = $getData->id;

        if($this->request->ajax()){
            return response()->json(['result' => 1, 'message' => __('general.success_edit_', ['field' => $this->data['thisLabel']])]);
        }
        else {
            session()->flash('message', __('general.success_edit_', ['field' => $this->data['thisLabel']]));
            session()->flash('message_alert', 2);
            return redirect()->route($this->rootRoute.'.' . $this->route . '.show', $id);
        }
    }

}
