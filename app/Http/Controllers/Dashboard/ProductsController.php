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
    protected $validatedFields = ['product_code', 'product_name', 'order_by', 'order_type', 'products_displayed'];

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

        $userSettings = Auth::user()->settings()->first();

        $searchQuery = $request->get('search-term');
        $perPage = $userSettings->products_displayed;

        $products = Auth::user()->products()
            ->where(function ($query) use ($searchQuery) {
                $query->where('name', 'like', $searchQuery.'%')
                    ->orWhere('code', 'like', $searchQuery.'%');
            })->orderBy($userSettings->order_products_by, $userSettings->order_products_type)
            ->paginate($perPage);

        $products->appends(['search-term' => $searchQuery]);

        return $products;
    }

    public function getSortDetails() {

        $userSettings = Auth::user()->settings()->first();

        return response()->json([
            'order_by' => $userSettings->order_products_by,
            'order_type' => $userSettings->order_products_type,
            'products_displayed' => $userSettings->products_displayed
        ]);
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
     * Update clients order by.
     *
     * @param  Request $request
     * @return Response
     */
    public function updateOrderBy(Request $request) {

        $this->validateOrderBy($request);

        Auth::user()->settings()->update([
            'order_products_by' => $request->get('order_by')
        ]);

        return response()->json([
            'title' => 'Success!',
            'message' => 'Ordinea produselor a fost actualizată.',
        ]);
    }

    /**
     * Update clients oder type.
     *
     * @param  Request $request
     * @return Response
     */
    public function updateOrderType(Request $request) {

        $this->validateOrderType($request);

        Auth::user()->settings()->update([
            'order_products_type' => $request->get('order_type')
        ]);

        return response()->json([
            'title' => 'Success!',
            'message' => 'Ordinea produselor a fost actualizată.'
        ]);
    }

    /**
     * Update products displayed per page.
     *
     * @param  Request $request
     * @return Respoonse
     */
    public function updateProductsDisplayed(Request $request) {

        $this->validateProductsDisplayed($request);

        Auth::user()->settings()->update([
            'products_displayed' => $request->get('products_displayed')
        ]);

        return response()->json([
            'title' => 'Success!',
            'message' => 'Numărul produselor afișate pe pagină a fost actualizat.'
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

    /**
     * Validate data used to edit clients pagination order.
     *
     * @param $request
     */
    private function validateOrderBy($request) {
        $this->validate($request, [
            'order_by' => 'in:code,created_at'
        ]);
    }

    /**
     * Validate data used to edit clients pagination order type.
     *
     * @param $request
     */
    private function validateOrderType($request) {
        $this->validate($request, [
            'order_type' => 'in:asc,desc'
        ]);
    }

    /**
     * Validate data used to edit number of products displayed per page.
     *
     * @param $request
     */
    private function validateProductsDisplayed($request) {
        $this->validate($request, [
            'products_displayed' => ['required', 'in:12,24,36']
        ]);
    }

}
