<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductStock;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $active_users                 = User::active()->verified()->customer()->count();
        $users_with_product           = User::has('productsAttached')->verified()->customer()->count();
        $active_products              = Product::active()->count();
        $active_products_without_user = Product::doesnthave('productStocks')->active()->count();

        $sum_of_attached_products = ProductStock::whereHas('product', function($query) {
            return $query->where('status',1);
        })->sum('price');

        $summarized_of_attached_products = ProductStock::whereHas('product', function($query) {
            return $query->where('status',1);
        })->selectRaw('quantity * price as summarized')->get()->pluck('summarized')->sum();

        $summarized_per_user = ProductStock::whereHas('product', function($query) {
            return $query->select('id')->where('status',1);
        })->with('user')->selectRaw('id, user_id, product_id, SUM(price) as total')->groupBy('user_id')->get();

        $exchange_api_key  = config('app.exchange_key');
        $exchange_response = Http::get("http://api.exchangeratesapi.io/v1/latest?access_key=$exchange_api_key")['rates'] ?? [];

        return view('home', compact(
            'active_users', 
            'users_with_product', 
            'active_products', 
            'active_products_without_user', 
            'sum_of_attached_products',
            'summarized_of_attached_products',
            'summarized_per_user',
            'exchange_response'
        ));
    }
}
