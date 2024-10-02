<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $products = Product::when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%");
        })->paginate(10);
        return view('pages.customer.products.index', compact('products'));
    }

    public function show(int $id)
    {
        $product = Product::findOrFail($id);
        return view('pages.customer.products.show', compact('product'));
    }

    public function addToCart(int $id, Request $request){
        $product = Product::findOrFail($id);

        if($product->quantity < $request->quantity) {
            return back()->withErrors(['fail' => 'Cannot add to cart, item is empty']);
        }

        $product->quantity = $product->quantity - $request->quantity;
        $product->save();

        $checkIsExistCart = Cart::where('user_id', Auth::user()->id)->where('product_id', $product->id)->first();
        if($checkIsExistCart) {
            $checkIsExistCart->quantity = $checkIsExistCart->quantity + $request->quantity;
            $checkIsExistCart->save();
            return back()->with('success', 'Success add item to cart');
        }

        Cart::create([
            'user_id'=> Auth::user()->id,
            'product_id' => $product->id,
            'quantity' => $request->quantity
        ]);

        return back()->with('success', 'Success add item to cart');
    }
}
