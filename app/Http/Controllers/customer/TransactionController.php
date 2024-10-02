<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{

    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        $transactionItems = TransactionItem::all();
        return view('pages.customer.transactions.index', compact('transactions', 'transactionItems'));
    }

    public function store(Request $request)
    {
        $carts = $request->carts;
        $quantities = $request->quantities;
        $total = $request->total;
        $date = $request->date;

        if(!$carts || !$total) {
            return back()->withErrors(['fail' => 'Please add item to cart first.']);
        }

        if(!$date || $date < date('Y-m-d')) {
            return back()->withErrors(['fail' => 'Please select a valid date.']);
        }

        $transaction = Transaction::create([
            'total' => $request->total,
            'user_id' => Auth::user()->id,
            'date' => $date
        ]);

        foreach($carts as $index => $cart) {
            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'quantity' => $quantities[$index],
                'product_id' => $cart
            ]);

            Cart::where('user_id', Auth::user()->id)->where('product_id', $cart)->delete();
        }

        return back()->with('success', 'Transaction success.');
    }
}
