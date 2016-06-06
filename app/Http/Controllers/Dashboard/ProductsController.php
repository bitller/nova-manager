<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Auth;
use App\Product;

/**
 * Handle work with products.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class ProductsController extends BaseController {

    /**
     * Fields that will be validated.
     *
     * @var array
     */
    protected $validatedFields = ['product_code', 'product_name'];

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
            })->orderBy('created_at', 'desc')
            ->paginate($perPage);

        $products->appends(['search-term' => $searchQuery]);

        return $products;
    }

    /**
     * Allow user to add a new product.
     *
     * @param Request $request
     */
    public function add(Request $request) {

        $this->validateAddProductData($request);

        $product = new Product([
            'name' => $request->get('product_name'),
            'code' => $request->get('product_code')
        ]);

        Auth::user()->products()->save($product);

        return response()->json([
            'title' => 'Succes!',
            'message' => 'Produsul a fost adăugat.'
        ]);
    }

    /**
     * Validate data used to add a new product.
     *
     * @param  $request
     */
    private function validateAddProductData($request) {
        $this->validate($request, [
            'product_name' => ['required', 'string', 'between:3,100'],
            'product_code' => ['required', 'digits:5', 'unique_product_code_for_current_user']
        ]);
    }

}
