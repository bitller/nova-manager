<?php

namespace App\Http\Controllers\Dashboard\Bills;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\BillProduct;

/**
 * Bill page controller.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class BillController extends BaseController {

    protected $validatedFields = ['product_page', 'product_quantity', 'product_price', 'product_discount', 'payment_term'];

    /**
     * Render page of given bill.
     *
     * @param  int  $billId
     * @param  Request $request
     * @return View
     */
    public function index($billId, Request $request) {
        return view('pages.dashboard.bills.bill')->with('billId', $billId);
    }

    /**
     * Return bill page data.
     *
     * @param int $billId
     * @return Response
     */
    public function get($billId) {

        $bill = Auth::user()->bills()->where('bills.id', $billId)->first();

        $products = $bill->products()->wherePivot('available_now', true)->get();
        $notAvailableProducts = $bill->products()->wherePivot('available_now', false)->get();
        $status = ($bill->paid) ? 'paid' : 'unpaid';

        $price = $bill->products()->sum('price');
        $priceWithDiscount = $bill->products()->sum('price_with_discount');

        $response = [
            'status' => $status,
            'payment_term' => date('d-m-Y', strtotime($bill->payment_term)),
            'products' => $products,
            'not_available_products' => $notAvailableProducts,
            'to_pay' => $priceWithDiscount,
            'saved_money' => $price - $priceWithDiscount
        ];

        return response()->json($response);
    }

    /**
     * Get only bill products.
     *
     * @param int $billId
     * @return Response
     */
    public function getOnlyProducts($billId) {

        $bills = Auth::user()->bills()->where('bills.id', $billId)->first();

        return response()->json([
            'products' => $bills->products()->wherePivot('available_now', true)->get(),
            'not_available_products' => $bills->products()->wherePivot('available_now', false)->get()
        ]);
    }

    public function getPaymentTerm($billId) {

        return response()->json([
            'payment_term' => date('d-m-Y', strtotime(Auth::user()->bills()->where('bills.id', $billId)->first()->payment_term))
        ]);

    }

    /**
     * Allow user to delete the bill.
     *
     * @param int $billId
     * @param  Request $request
     * @return Response
     */
    public function delete($billId, Request $request) {

        Auth::user()->bills()->where('bills.id', $billId)->delete();

        return response()->json([
            'title' => 'Succes!',
            'message' => 'Factura a fost ștearsă',
        ]);

    }

    /**
     * Allow user to mark bill as paid.
     *
     * @param int $billId
     * @param  Request $request
     * @return Response
     */
    public function markBillAsPaid($billId, Request $request) {

        DB::table('bills')
            ->leftJoin('clients', 'clients.id', '=', 'bills.client_id')
            ->leftJoin('users', 'users.id', '=', 'clients.user_id')
            ->where('bills.id', $billId)
            ->update([
                'bills.paid' => true
            ]);

        return response()->json([
            'title' => 'Succes!',
            'message' => 'Factura a fost marcată ca plătită.'
        ]);
    }

    /**
     * Allow user to mark bill as unpaid.
     *
     * @param int $billId
     * @param  Request $request
     * @return Response
     */
    public function markBillAsUnpaid($billId, Request $request) {

        DB::table('bills')
            ->leftJoin('clients', 'clients.id', '=', 'bills.client_id')
            ->leftJoin('users', 'users.id', '=', 'clients.user_id')
            ->where('bills.id', $billId)
            ->update([
                'bills.paid' => false
            ]);

        return response()->json([
            'title' => 'Succes!',
            'message' => 'Factura a fost marcată ca neplătită.'
        ]);
    }

    /**
     * Allow user to delete product form bill.
     *
     * @param int $billId
     * @param  Request $request
     * @return Response
     */
    public function deleteProduct($billId, Request $request) {

        if (!Auth::user()->bills()->where('bills.id', $billId)->count()) {
            return response()->json([
                'title' => 'Oppps.',
                'message' => 'O eroare a avut loc.'
            ]);
        }

        Auth::user()->bills()->where('bills.id', $billId)->first()->products()->where('products.id', $request->get('product_id'))->delete();

        return response()->json([
            'title' => 'Succes!',
            'message' => 'Produsul a fost șters din factură.'
        ]);
    }

    /**
     * Allow user to edit product page.
     *
     * @param int $billId
     * @param int $billProductId
     * @param  Request $request
     * @return Response
     */
    public function editPage($billId, $billProductId, Request $request) {

        $this->validateEditPageData($request);
        $billProduct = Auth::user()->bills()->where('bills.id', $billId)->first()->products()->wherePivot('id', $billProductId)->first();

        // Bill product does not exists or does not belong to current user
        if (!$billProduct) {
            return response()->json([
                'title' => 'Eroare',
                'message' => 'O eroare a avut loc.'
            ], 422);
        }

        $this->updateBillProducts($billId, $billProductId, [
            'page' => $request->get('product_page')
        ]);

        return response()->json([
            'title' => 'Succes!',
            'message' => 'Pagina produsului a fost actualizată.'
        ]);
    }

    public function editQuantity($billId, $billProductId, Request $request) {

        $this->validateEditQuantityData($request);
        $billProduct = Auth::user()->bills()->where('bills.id', $billId)->first()->products()->wherePivot('id', $billProductId)->first();

        // Bill product does not exists or does not belong to current user
        if (!$billProduct) {
            return response()->json([
                'title' => 'Eroare',
                'message' => 'O eroare a avut loc.'
            ], 422);
        }

        // Calculate new values
        $quantity = $request->get('product_quantity');
        $price = ($billProduct->pivot->price/$billProduct->pivot->quantity) * $quantity;
        $priceWithDiscount = ($billProduct->pivot->price_with_discount/$billProduct->pivot->quantity) * $quantity;

        $this->updateBillProducts($billId, $billProductId, [
            'quantity' => $quantity,
            'price' => $price,
            'price_with_discount' => $priceWithDiscount
        ]);

        return response()->json([
            'title' => 'Succes!',
            'message' => 'Cantitatea produsului a fost actualizată.'
        ]);
    }

    public function editPrice($billId, $billProductId, Request $request) {

        $this->validateEditPriceData($request);
        $billProduct = Auth::user()->bills()->where('bills.id', $billId)->first()->products()->wherePivot('id', $billProductId)->first();

        // Bill product does not exists or does not belong to current user
        if (!$billProduct) {
            return response()->json([
                'title' => 'Eroare',
                'message' => 'O eroare a avut loc.'
            ], 422);
        }

        $price = $billProduct->pivot->quantity * $request->get('product_price');
        $priceWithDiscount = $price - (($billProduct->pivot->discount/100) * $price);

        $this->updateBillProducts($billId, $billProductId, [
            'price' => $price,
            'price_with_discount' => $priceWithDiscount
        ]);

        return response()->json([
            'title' => 'Succes!',
            'message' => 'Prețul produsului a fost actualizat.',
        ]);

    }

    public function editDiscount($billId, $billProductId, Request $request) {

        $this->validateEditDiscountData($request);
        $billProduct = Auth::user()->bills()->where('bills.id', $billId)->first()->products()->wherePivot('id', $billProductId)->first();

        // Bill product does not exists or does not belong to current user
        if (!$billProduct) {
            return response()->json([
                'title' => 'Eroare',
                'message' => 'O eroare a avut loc.'
            ], 422);
        }

        $discount = $request->get('product_discount');
        $price = $billProduct->pivot->price * $billProduct->pivot->quantity;
        $priceWithDiscount = $price - (($discount/100) * $price);

        $this->updateBillProducts($billId, $billProductId, [
            'price_with_discount' => $priceWithDiscount,
            'discount' => $discount
        ]);

        return response()->json([
            'title' => 'Succes!',
            'message' => 'Reducerea aplicată produsului a fost actualizată.'
        ]);
    }

    public function setPaymentTerm($billId, Request $request) {

        $this->validateSetPaymentTermData($request);
        // dd($request->get('payment_term'));
// dd(date('Y/m/d', strtotime($request->get('payment_term'))));
        DB::table('bills')
            ->leftJoin('clients', 'clients.id', '=', 'bills.client_id')
            ->leftJoin('users', 'users.id', '=', 'clients.user_id')
            ->where('users.id', Auth::user()->id)
            ->where('bills.id', $billId)
            ->update([
                'payment_term' => date('Y-m-d', strtotime($request->get('payment_term')))
                // 'payment_term' => $request->get('payment_term')
            ]);

        return response()->json([
            'title' => 'Succes!',
            'message' => 'Termenul de plată al facturii a fost actualizat.',
        ]);
    }

    /**
     * Validate data used to edit product page.
     *
     * @param $request
     */
    protected function validateEditPageData($request) {
        $this->validate($request, [
            'product_page' => ['numeric', 'between:0,999']
        ]);
    }

    /**
     * Validate data used to edit product quantity.
     *
     * @param $request
     */
    protected function validateEditQuantityData($request) {
        $this->validate($request, [
            'product_quantity' => ['numeric', 'between:1,999']
        ]);
    }

    protected function validateEditPriceData($request) {
        $this->validate($request, [
            'product_price' => ['required', 'numeric', 'between:0,9999']
        ]);
    }

    protected function validateEditDiscountData($request) {
        $this->validate($request, [
            'product_discount' => ['numeric', 'between:0,100']
        ]);
    }

    protected function validateSetPaymentTermData($request) {
        $this->validate($request, [
            'payment_term' => ['required', 'date_format:d-m-Y']
        ]);
    }

    protected function updateBillProducts($billId, $billProductId, $newValues) {
        DB::table('bill_products')
            ->leftJoin('bills', 'bill_products.bill_id', '=', 'bills.id')
            ->leftJoin('clients', 'clients.id', '=', 'bills.client_id')
            ->leftJoin('users', 'users.id', '=', 'clients.user_id')
            ->where('bill_products.bill_id', $billId)
            ->where('bill_products.id', $billProductId)
            ->update($newValues);

    }

}
