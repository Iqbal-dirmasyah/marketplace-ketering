<?php

namespace App\Http\Controllers\merchant;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Auth::user()->products;
        return view('pages.merchant.products.index', compact('products'));
    }

    public function create()
    {
        return view('pages.merchant.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required',
            'image' => 'required|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('product-images', 'public');
        }

        $validated['user_id'] = Auth::id();


        Product::create($validated);

        return redirect()->route('pages.merchant.products')->with('success', 'Product created successfully.');
    }
   public function edit(int $id)
    {
        // tekan ctrl + click utk Go-To view kama arah/alur nyo bal, bia paham kama pindah2 nyo
        $product = Product::findOrFail($id);
        return view('pages.merchant.products.edit', compact('product'));
    }

    public function update(Request $request, int $id)
    {
        // kalau bisa namo model tu huruf kapital awalnyo bal 
        $product = Product::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('product-images', 'public');
        }

        $product->update($validated);

        return redirect()->route('pages.merchant.products')->with('success', 'Product updated successfully.');
    }

    public function destroy(int $id)
    {
        $product = Product::findOrFail($id);
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('pages.merchant.products')->with('success', 'Product deleted successfully.');
    }
}
