<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\BaseController;

class ProductsController extends BaseController {

    public function index() {
        return view('pages.dashboard.products.index');
    }

}
