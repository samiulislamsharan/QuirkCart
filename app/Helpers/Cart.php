<?php

namespace App\Helper;

use App\Models\CartItem;
use Illuminate\Support\Facades\Cookie;

class Cart
{
    public static function getCount()
    {
        if ($user = auth()->user()) {
            return CartItem::where('user_id', $user->id)->sum('quantity');
        }
    }

    public static function getCartItems()
    {
        if ($user = auth()->user()) {
            return CartItem::where('user_id', $user->id)
                ->get()
                ->map(
                    fn(CartItem $item) => [
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity
                    ]
                );
        }
    }

    public static function getCookieCartItems()
    {
        return json_decode(request()->cookie('cart_items', '[]'), true);
    }

    public static function setCookieCartItems()
    {
        Cookie::queue('cart_items', fn(int $carry, array $item) => $carry + $item['quantity'], 0);
    }
}