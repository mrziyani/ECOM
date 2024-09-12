<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\Models\Order;

use Illuminate\Http\Request;

class orderController extends Controller
{
    public function confirm($id)
{
    // Retrieve the order based on ID and ensure it is not already bought
    $order = Order::where('id', $id)
                  ->where('bought', false)
                  ->first();

    // Check if the order exists
    if (!$order) {
        return redirect()->route('product.index')->with('error', 'Order not found or already confirmed.');
    }

    // Update the order status to 'bought'
    $order->bought = true;
    $order->save(); // Save the changes to the database

    // Flash a success message to the session
    session()->flash('success', 'Order confirmed successfully.');

    // Redirect to the order summary or cart page
    return redirect()->route('orderitem.panier');
}
    
}

