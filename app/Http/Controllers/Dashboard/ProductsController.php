<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Auth;

/**
 * Handle work with products.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class ProductsController extends BaseController {

    /**
     * Render produts page.
     */
    public function index() {
        return view('pages.dashboard.products.index');
    }

    /**
     * Paginate products of the user.
     *
     * @param  Request $request
     */
    public function paginate(Request $request) {

        $searchQuery = $request->get('search-term');
        $perPage = Auth::user()->settings()->first()->number_of_products;

        $products = Auth::user()->products()
            ->where(function ($query) use ($searchQuery) {
                $query->where('name', 'like', $searchQuery.'%')
                    ->orWhere('code', 'like', $searchQuery.'%');
            })->orderBy('name', 'asc')
            ->paginate($perPage);

        $products->appends(['search-term' => $searchQuery]);

        return $products;
    }

}
