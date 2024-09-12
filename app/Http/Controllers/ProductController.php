<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\Models\Product;
use App\Models\Order;
use App\Models\orderitem;

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
        'category' => 'required',
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
    $product->category = $validatedData['category'];
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


public function filterProducts(Request $request)
    {
        $category = $request->input('category');
        
        
        // Construct the SQL query based on conditions
        $query = "
            SELECT *
            FROM Products
            WHERE 1 = 1
        ";
    
        // Add filters based on inputs
        if ($category !== "Category") {
            $query .= " AND category LIKE '%" . addslashes($category) . "%'";
        }
    
       
    
        // Execute the SQL query using DB facade
        $products = DB::select($query);
    
        // Pass activities to the getfilter2 method or view for display
        return $this->getfilter($products);
    }
    public function findProducts(Request $request)
{
    $var = $request->input('var');

    // Start constructing the SQL query
    $query = "
        SELECT *
        FROM Products
        WHERE 1 = 1
    ";

    // Initialize an array for binding parameters
    
    $query .= " AND Category LIKE '%" . addslashes($var) . "%'";
    $query .= " OR name LIKE '%" . addslashes($var) . "%'";

    // Execute the query with the parameters
    $products = DB::select($query);
    

    return $this->getfilter($products);
}

    public function getfilter($products)
{
    // Pass activities to the view for display
    return view('products.getfilter', compact('products'));
}

public function buy(Request $request, $id)
{
    // Get the user ID from the session
    $userId = Session::get('user_id');

    if (!$userId) {
        return redirect()->route('login')->with('error', 'You must be logged in to make a purchase.');
    }

    // Fetch the product details
    $product = Product::where('product_id', $id)->firstOrFail();

    // Get the quantity from the request, default to 1 if not provided
    $quantity = $request->input('quantity', 1);

    // Check if there is enough stock
    if ($quantity > $product->stock) {
        // Flash error message to session
        session()->flash('error', 'Not enough stock available for this product.');
        return redirect()->route('orderitem.panier');
    }

    // Calculate the total amount for this purchase
    $totalAmount = $product->price * $quantity;

    // Check if an order already exists for the user and is not yet completed (bought = false)
    $order = Order::where('user_id', $userId)
                    ->where('bought', false)
                    ->first();

    // If no order exists, create a new order
    if (!$order) {
        $order = new Order();
        $order->user_id = $userId;
        $order->total_amount = $totalAmount; // Set the total amount to the new order
        $order->bought = false; // Mark as not bought yet
        $order->save();
    } else {
        // Update the total amount if an order already exists
        $order->total_amount += $totalAmount;
        $order->save();
    }

    // Check if the product is already in the order (OrderItem)
    $orderItem = OrderItem::where('order_id', $order->id)
                          ->where('product_id', $product->product_id) // Ensure product_id matches
                          ->first();

    if ($orderItem) {
        // If the item exists, update the quantity and save
        $orderItem->quantity += $quantity;
    } else {
        // If no item exists, create a new OrderItem
        $orderItem = new OrderItem();
        $orderItem->order_id = $order->id;
        $orderItem->product_id = $product->product_id; // Ensure this is correct
        $orderItem->quantity = $quantity; // Set to the selected quantity
        $orderItem->price = $product->price; // Set price per item
    }

    // Save the order item (whether it's updated or newly created)
    $orderItem->save();

    // Flash a success message to the session
    session()->flash('success', 'Product added to your cart successfully.');

    // Return to the cart or order summary page
    return redirect()->route('orderitem.panier');
}

    
}
    


