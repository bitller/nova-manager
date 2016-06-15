<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\User;
use App\Client;
use  App\Bill;
use Auth;
use App\Campaign;
use DB;

/**
 * Handle work with bills.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class BillsController extends BaseController {

    /**
     * Fields that are validated by this controller.
     *
     * @var array
     */
    protected $validatedFields = ['type', 'campaign_number', 'campaign_year'];





    






}
