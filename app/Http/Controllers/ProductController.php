<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\Models\Product;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $products = Product::all();

        // Pass the products data to the view
        return view('products.index', ['products' => $products]);
       
    }

    public function create()
    {
        return view('products.create');
    }

    
    public function aftercreate(Request $request)
{
    // Validate request data
    $validatedData = $request->validate([
        'name' => 'required|string|max:100',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'image' => 'nullable|image|mimes:png,jpg'
    ]);

    // Initialize $imageName
    $imageName = null;

    // Check if an image file was uploaded
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        \Log::info('Image Uploaded: ' . $image->getClientOriginalName()); // Log the file name
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        
        // Store the image directly in the public/images folder
        $image->move(public_path('images'), $imageName);
    } else {
        \Log::info('No image uploaded');
    }

    // Create a new product instance
    $product = new Product();
    $product->name = $validatedData['name'];
    $product->description = $validatedData['description'];
    $product->price = $validatedData['price'];
    $product->stock = $validatedData['stock'];
    //$filePath = 'storage/' . $filePath;
    $product->image_path = asset('storage/images/' . $imageName); 
    $product->image_path = $imageName;

    // Save the product to the database
    $product->save();

    // Redirect or return a view with a success message
    return redirect()->route('product.index')->with('success', 'Produit ajouté avec succès!');
}

    
    public function add($id)
{
    $product = Product::where('product_id', $id)->firstOrFail();
    return view('products.add', compact('product'));
}

    
}

