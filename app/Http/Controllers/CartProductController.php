<?php

namespace App\Http\Controllers;
use App\Models\CartProduct;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartProductController extends Controller
{
    public function index(Cart $cart, $id)
    {
        $totalPrice = $cart::withSum('products', 'price')
            ->findorFail($id)
            ->products_sum_price;
        $cartProducts = $cart::findorFail($id)->load('products');
        $cartProducts['totalPrice'] = $totalPrice;

        return response()->json($cartProducts);
    }


    public function store(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|numeric',
            'product_id' => 'required|numeric'
        ]);
        $cartProduct = CartProduct::create($request->all());

        return response()->json($request, 201);
    }
}

