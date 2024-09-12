<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\orderitem;

use Illuminate\Http\Request;

class orderitemController extends Controller
{
    public function panier()
{
    // Get the user ID from the session
    $userId = Session::get('user_id');

    // Fetch all orders for the user where bought is false
    $orders = Order::where('user_id', $userId)
                   ->where('bought', false)
                   ->with(['orderItems.product']) // Eager load order items and their products
                   ->get();

    // If you need to handle the case where there are no orders
    if ($orders->isEmpty()) {
        return response()->json(['message' => 'No orders found'], 404);
    }

    // Return the orders to a view
    return view('orderitem.panier', compact('orders'));
}

public function delete($id)
{
    // Find the order item by ID
    $orderItem = OrderItem::find($id);

    // Check if the order item exists
    if (!$orderItem) {
        return redirect()->back()->with('error', 'Order item not found.');
    }

    // Get the associated order to adjust the total amount
    $order = Order::find($orderItem->order_id);
    
    // Check if the order exists
    if ($order) {
        // Reduce the total amount by the item price multiplied by its quantity
        $order->total_amount -= $orderItem->price * $orderItem->quantity;
        $order->save(); // Save the updated order
    }

    // Delete the order item
    $orderItem->delete();

    // Flash a success message to the session
    session()->flash('success', 'Order item deleted successfully.');

    // Redirect back to the cart or order summary page
    return redirect()->route('orderitem.panier');
}
}

