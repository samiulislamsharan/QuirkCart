<?php

namespace App\Http\Controllers\User;

use App\Helpers\CurrencyHelper;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $products = Product::with(
            'category',
            'brand',
            'product_images'
        )
            ->orderBy('id', 'DESC')
            ->limit(8)
            ->get();

        // Format the price for each product
        $products->transform(
            function ($product) {
                $product->price = CurrencyHelper::formatBDT($product->price);

                return $product;
            }
        );

        return Inertia::render('User/Index', [
            'products' => $products,
            'canLogin' => app('router')->has('login'),
            'canRegister' => app('router')->has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }
}