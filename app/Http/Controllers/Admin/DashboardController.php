<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Extra;
use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\View\View;
class DashboardController extends Controller
{
     public function index(): View
    {
        return view('admin.dashboard', [
            'categoriesCount' => Category::count(),
            'productsCount' => Product::count(),
            'sizesCount' => ProductSize::count(),
            'extrasCount' => Extra::count(),
        ]);
    }
}