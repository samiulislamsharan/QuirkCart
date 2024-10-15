<?php

namespace App\Http\Controllers\User;

use App\Helpers\Cart;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user) {
            $cartItems = CartItem::query()
                ->where('user_id', $user->id)
                ->with('product')
                ->get();

            $userAddresses = UserAddress::query()
                ->where('user_id', $user->id)
                ->where('is_main', 1)
                ->first();

            if ($cartItems->count() > 0) {
                return Inertia::render(
                    'User/CartList',
                    [
                        'cartItems' => $cartItems,
                        'userAddresses' => $userAddresses,
                    ]
                );
            } else {
                return redirect()->back();
            }
        } else {
            $cartItems = Cart::getCookieCartItems();

            if (count($cartItems) > 0) {
                $cartItems = new CartResource(Cart::getProductAndCartItems());

                return Inertia::render(
                    'User/CartList',
                    [
                        'cartItems' => $cartItems,
                    ]
                );
            } else {
                return redirect()->back();
            }
        }
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

            foreach ($cartItems as &$cartItem) {
                if ($cartItem['product_id'] === $product->id) {
                    $cartItem['quantity'] = $quantity;
                    break;
                }
            }

            Cart::setCookieCartItems($cartItems);
        }

        return redirect()->back();
    }

    public function destroy(Request $request, Product $product)
    {
        $user = $request->user();

        if ($user) {
            CartItem::query()
                ->where([
                    'user_id' => $user->id,
                    'product_id' => $product->id
                ])
                ->first()
                ?->delete();

            if (CartItem::count() <= 0) {
                return redirect()->route('user.home')->with('info', 'Cart is empty!');
            } else {
                return redirect()->back()->with('success', 'Product removed from cart successfully!');
            }
        } else {
            $cartItems = Cart::getCookieCartItems();

            foreach ($cartItems as $key => $cartItem) {
                if ($cartItem['product_id'] === $product->id) {
                    unset($cartItems[$key]);
                    break;
                }
            }

            Cart::setCookieCartItems($cartItems);

            if (count($cartItems) <= 0) {
                return redirect()->route('user.home')->with('info', 'Cart is empty!');
            } else {
                return redirect()->back()->with('success', 'Product removed from cart successfully!');
            }
        }
    }
}
