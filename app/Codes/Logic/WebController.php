<?php

namespace App\Codes\Logic;

use App\Codes\Models\Page;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebController extends Controller
{
    protected $data;
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;

        $getPage = Page::where('status', 80)->get();

        $listPage = [];
        foreach($getPage as $page) {
            $value = json_decode($page->value, true);
            $value['name'] = $page->name;
            $listPage[$page->key] = $value;
        }


        $this->data = [
            'page' => $listPage
        ];
    }

}
