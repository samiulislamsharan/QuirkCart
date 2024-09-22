<?php

namespace App\Http\Controllers\User;

use App\Helper\Cart;
use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function view()
    {
        //
    }

    public function store(Request $request, Product $product)
    {
        $quantity = $request->post('quantity', 1);
        $user = $request->user();

        if ($user) {
            $cartItem = CartItem::where(
                [
                    'user_id' => $user->id,
                    'product_id' => $product->id
                ]
            )->first();

            if ($cartItem) {
                $cartItem->increment('quantity');
            } else {
                CartItem::create(
                    [
                        'user_id' => $user->id,
                        'product_id' => $product->id,
                        'quantity' => $quantity
                    ]
                );
            }
        } else {
            $cartItems = Cart::getCookieCartItems();
            $productExists = false;

            foreach ($cartItems as $cartItem) {
                if ($cartItem['product_id'] === $product->id) {
                    $cartItem['quantity'] += $quantity;
                    $productExists = true;
                    break;
                }
            }

            if (!$productExists) {
                $cartItems[] = [
                    'user_id' => null,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->price,
                ];
            }

            Cart::setCookieCartItems($cartItems);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request, Product $product)
    {
        $quantity = $request->integer('quantity');
        $user = $request->user();

        if ($user) {
            CartItem::where(
                [
                    'user_id' => $user->id,
                    'product_id' => $product->id
                ]
            )->update(['quantity' => $quantity]);
        } else {
            $cartItems = Cart::getCookieCartItems();

            foreach ($cartItems as $cartItem) {
                if ($cartItem['product_id'] === $product->id) {
                    $cartItem['quantity'] += $quantity;
                    break;
                }
            }

            Cart::setCookieCartItems($cartItems);
        }

        return redirect()->back();
    }
    {
        //
    }
}
