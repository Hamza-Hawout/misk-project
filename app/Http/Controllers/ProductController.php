<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Filter by seller name
        if ($request->filled('seller_name')) {
            $query->whereHas('seller', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->seller_name . '%');
            });
        }

        // Filter by product name
        if ($request->filled('product_name')) {
            $query->where('name', 'like', '%' . $request->product_name . '%');
        }

        $products = $query->get();

        return view('products', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:200', // Update max length
            'description' => 'required|string|min:50', // Min length
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public'); // Store in 'public/images'
        }

        // Create product
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'seller_id' => auth()->id(),
            'image' => $imagePath, // Save the path of the uploaded image
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show($id)
    {
        $product = Product::with(['offers.user'])->findOrFail($id);
        return view('products.show', compact('product'));
    }


}
