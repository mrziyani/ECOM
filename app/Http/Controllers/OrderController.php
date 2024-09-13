<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\Models\Order;
use App\Models\Product;

use Illuminate\Http\Request;

class orderController extends Controller
{
    public function confirm($id)
    {
        // Retrieve the order based on ID and ensure it is not already bought
        $order = Order::where('id', $id)
                      ->where('bought', false)
                      ->with('items') // Eager load the items relationship
                      ->first();
    
        // Check if the order exists
        if (!$order) {
            return redirect()->route('product.index')->with('error', 'Order not found or already confirmed.');
        }
    
        // Check stock availability for each item first
        foreach ($order->items as $item) {
            $product = Product::where('product_id', $item->product_id)->first();
    
            if (!$product) {
                \Log::error('Product not found for product_id: ' . $item->product_id);
                return redirect()->route('orderitem.panier')->with('error', 'Product not found for item ID: ' . $item->id);
            }
    
            if ($product->stock < $item->quantity) {
                return redirect()->route('orderitem.panier')->with('error', 'Insufficient stock for product: ' . $product->name);
            }
        }
    
        // All quantities are okay, proceed to update stock
        foreach ($order->items as $item) {
            Product::where('product_id', $item->product_id)
                ->update(['stock' => DB::raw('stock - ' . $item->quantity)]);
        }
    
        // Mark the order as bought
        $order->bought = true;
        $order->save();
    
        // Flash a success message to the session
        session()->flash('success', 'Order confirmed successfully.');
    
        // Redirect to the order summary or cart page
        return redirect()->route('orderitem.confirmed')->with('order', $order);
    }
    
}

