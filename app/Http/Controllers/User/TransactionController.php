<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user', 'userSale')
                        ->where('tr_user_id', Auth::user()->id)
                        ->orderByDesc('id')->paginate(10);

        $viewData = [
            'transactions' => $transactions
        ];

        return view('frontend.transaction.index', $viewData)->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function index_sale()
    {
        $transactions_sale = Transaction::with('user', 'userSale')
                        ->where('tr_user_sale', Auth::user()->id)
                        ->orderByDesc('id')->paginate(10);

        $viewData = [
            'transactions_sale' => $transactions_sale
        ];

        return view('frontend.sale_order.index', $viewData)->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function viewOrder(Request $request, $id)
    {

        // dd($request->all());

        if ($request->ajax()) {

            $orders = Order::with('product', 'transaction')->where('or_transaction_id', $id)->get();

            $html = view('backend.components.order', compact('orders'))->render();

            return \response()->json($html);
        }
    }

    public function actionTransaction($id)
    {
        $transaction = Transaction::find($id);
        
        $orders = Order::where('or_transaction_id', $id)->get();

        if ($orders) {
            foreach ($orders as $order) {
                $product = Product::find($order->or_product_id);
                $product->status = Product::STATUS_FINISH; // Cậo nhật trạng thái ĐÃ BÁN
                $product->save();
            }
        }
        $transaction->tr_status = Transaction::STATUS_DONE; // Cập nhật trạng thái đơn hàng ĐÃ XỬ LÝ
        $transaction->save();

        toastr()->success('Xử lý thành công!', 'Thông báo', ['timeOut' => 1000]);
        return redirect()->back();
    }

    
}
