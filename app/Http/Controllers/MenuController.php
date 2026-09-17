<?php

namespace App\Http\Controllers;

use App\Models\CafeSetting;
use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class MenuController extends Controller
{
    public function index(): View
    {
        $categories = Category::query()
            ->where('is_active', true)
            ->whereHas('products', function ($query) {
                $query->where('is_active', true);
            })
            ->with([
                'products' => function ($query) {
                    $query->where('is_active', true);
                },
                'products.sizes' => function ($query) {
                    $query->where('is_active', true);
                },
                'products.extras' => function ($query) {
                    $query->where('is_active', true);
                },
            ])
            ->orderBy('order')
            ->orderBy('name')
            ->get();
        $featuredProducts = Product::query()
            ->where('is_active', true)
            ->where('is_featured', true)
            ->whereHas('category', function ($query) {
                $query->where('is_active', true);
            })
            ->with([
                'category',
                'sizes' => function ($query) {
                    $query->where('is_active', true);
                },
                'extras' => function ($query) {
                    $query->where('is_active', true);
                },
            ])
            ->orderBy('order')
            ->orderBy('name')
            ->limit(3)
            ->get();    

            $cafeSetting = CafeSetting::first();

        return view('home', compact('categories', 'featuredProducts', 'cafeSetting'));
    }
}