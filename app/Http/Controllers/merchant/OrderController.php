<?php

namespace App\Http\Controllers\merchant;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\transactions;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders =  Transaction::with('transactionItems')->whereHas('transactionItems', function($query) {
            $query->whereHas('product', function($q) {
                $q->where('user_id', Auth::user()->id);
            });
        })->get();
        
        return view('pages.merchant.orders.index', compact('orders'));
    }

    public function verify($id)
    {
                 // nama model   
        $order = Transaction::where('id', $id)->first();
        $order->status = !$order->status;
        $order->save();
        return back()->with('success', 'Order status updated successfully');
    }
}
