<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductListController extends Controller
{
    public function index()
    {
        $products = Product::with('category', 'brand', 'product_images')->where('published', 1);
        $categories = Category::all();
        $brands = Brand::all();

        $filterProducts = $products->filtered()->paginate(12)->withQueryString();

        return Inertia::render(
            'User/ProductList',
            [
                'products' => ProductResource::collection($filterProducts),
                'categories' => $categories,
                'brands' => $brands,
            ]
        );
    }
}