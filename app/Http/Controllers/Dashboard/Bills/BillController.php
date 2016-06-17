<?php

namespace App\Http\Controllers\Dashboard\Bills;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Auth;

/**
 * Bill page controller.
 *
 * @author Alexandru Bugarin <alexandru.bugarin@gmail.com>
 */
class BillController extends BaseController {

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

        $bills = Auth::user()->bills()->where('bills.id', $billId)->first();

        $products = $bills->products()->wherePivot('available_now', true)->get();
        $notAvailableProducts = $bills->products()->wherePivot('available_now', false)->get();

        $response = [
            'payment_term' => $bills->payment_term,
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
     * Allow user to mark bill as paid.
     *
     * @param int $billId
     * @param  Request $request
     * @return Response
     */
    public function markBillAsPaid($billId, Request $request) {

        Auth::user()->bills()->where('bills.id', $billId)->update([
            'paid' => true
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

        Auth::user()->bills()->where('bills.id', $billId)->update([
            'paid' => false
        ]);

        return response()->json([
            'title' => 'Succes!',
            'message' => 'Factura a fost marcată ca neplătită.'
        ]);
    }

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

}
