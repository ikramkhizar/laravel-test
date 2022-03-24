<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductStock;
use Illuminate\Http\Request;

class WelcomeController extends Controller
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
        $product = Product::all();

        return view('welcome', compact('product'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        
        return view('add_product', compact('product'));
    }

    public function store(Request $request)
    {
        ProductStock::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ]);
        
        return redirect()->route('welcome');
    }
}
