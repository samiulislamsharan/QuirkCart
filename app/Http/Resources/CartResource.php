<?php

namespace App\Http\Resources;

use App\Helpers\Cart;
use App\Helpers\CurrencyHelper;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        [$products, $cartItems] = $this->resource;

        $total = $products->reduce(fn(?float $carry, Product $product) => $carry + $product->price * $cartItems[$product->id]['quantity']);

        // $total = $products->sum(function (Product $product) use ($cartItems) {
        //     return $product->price * $cartItems[$product->id]['quantity'];
        // });

        return [
            'count' => Cart::getCount(),
            'total' => CurrencyHelper::formatBDT($total),
            'items' => $cartItems,
            'products' => ProductResource::collection($products),
        ];
    }
}