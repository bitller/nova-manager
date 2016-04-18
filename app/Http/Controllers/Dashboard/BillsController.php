<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\BaseController;

class BillsController extends BaseController {
    
    public function index() {
        return view('pages.dashboard.bills.index');
    }
    
}