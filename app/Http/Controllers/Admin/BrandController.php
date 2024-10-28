<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BrandController extends Controller
{
    public function index()
    {
        // brand with product count
        $brands = Brand::withCount('products')->paginate(10);

        // dd($brands);

        return Inertia::render(
            'Admin/Brands/Index',
            [
                'brands' => $brands,
            ]
        );
    }

    public function store(Request $request)
    {
        $brand = new Brand();

        $brand->name = $request->name;

        $brand->save();

        return redirect()->route('admin.brands.index')->with('success', 'Brand created successfully');
    }

    public function update(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);

        $brand->name = $request->name;
        $brand->slug = $request->slug;

        $brand->update();

        return redirect()->route('admin.brands.index')->with('success', 'Brand updated successfully');
    }

    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);

        $brand->delete();

        return redirect()->route('admin.brands.index')->with('success', 'Brand deleted successfully');
    }
}