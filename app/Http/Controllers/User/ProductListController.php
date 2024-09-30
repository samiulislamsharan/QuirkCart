<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductListController extends Controller
{
    public function index()
    {
        $products = Product::with('category', 'brand', 'product_images');
        $filterProducts = $products->filtered()->paginate(12)->withQueryString();

        return Inertia::render(
            'User/ProductList',
            [
                'products' => ProductResource::collection($filterProducts),
            ]
        );
    }
}