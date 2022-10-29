<?php

namespace App\Http\Controllers\Website;

use App\Codes\Models\Page;
use App\Codes\Logic\WebController;
use Illuminate\Http\Request;

class HomeController extends WebController
{
    protected $data;
    protected $request;

    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function index()
    {
        $data = $this->data;

        if(!isset($data['page']['homepage'])) {
            return redirect()->route('404');
        }

        return view(env('WEBSITE_TEMPLATE').'.page.home', $data);
    }

}
