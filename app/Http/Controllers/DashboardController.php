<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductStockLog;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $product = Product::count();
        $category = Category::count();
        $user = User::count();
        $stockLog = ProductStockLog::count();
        // dd($product);
        return view('dashboard.index', [
            'product' => $product,
            'category' => $category,
            'user' => $user,
            'stockLog' => $stockLog,
        ]);
    }
}
