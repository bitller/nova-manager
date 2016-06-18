<?php

namespace App\Http\Controllers\Dashboard\Bills;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Auth;
use DB;

/**
 * Bill page controller.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class BillController extends BaseController {

    protected $validatedFields = ['product_page'];

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

        $response = [
            'status' => $status,
            'payment_term' => $bill->payment_term,
            'products' => $products,
            'not_available_products' => $notAvailableProducts
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

        DB::table('bill_products')
            ->leftJoin('bills', 'bill_products.bill_id', '=', 'bills.id')
            ->leftJoin('clients', 'clients.id', '=', 'bills.client_id')
            ->leftJoin('users', 'users.id', '=', 'clients.user_id')
            ->where('users.id', Auth::user()->id)
            ->where('bill_products.bill_id', $billId)
            ->where('bill_products.id', $billProductId)
            ->update([
                'page' => $request->get('product_page')
            ]);

        return response()->json([
            'title' => 'Succes!',
            'message' => 'Pagina produsului a fost actualizată.'
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

}
