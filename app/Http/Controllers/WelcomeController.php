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
        $product = Product::active()->get();

        return view('welcome', compact('product'));
    }

    public function create($id)
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

    public function show()
    {
        $product = ProductStock::with('product')->where('user_id', auth()->id())->get();
        
        return view('my_products', compact('product'));
    }

    public function edit($id)
    {
        $product = ProductStock::with('product')->find($id);
        
        return view('edit_product', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = ProductStock::findOrFail($id);
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->save();
        
        return redirect()->route('my_products');
    }
}
