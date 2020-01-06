<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Order;
use App\Product;
use Auth;
use Illuminate\Routing\Redirector;

class OrderController extends Controller
{
    /**
     * Show all the orders (ADMIN)
     * Status meanings:
     * 0: Processing order, waiting for the barista to accept and start the order.
     * 1: The barista accepted and started the order.
     * 2: The order is finished and ready for pickup.
     * 3: The order has been picked up successfully.
     * 9: Order has been cancelled by the barista.
     */
    public function index()
    {
        // Get all the orders where the status isn't 2 (ready for pickup), 3 (picked up) or 9 (cancelled)
        $orders = Order::where('status', '!=', 2)
            ->where('status', '!=', 3)
            ->where('status', '!=', 9)
            ->get();

        return view('admin.orders', compact('orders'));
    }

    /**
     * Process the order made by the user
     * @param Request $request
     * @return RedirectResponse|Redirector|void
     */
    public function order(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|integer|min:1',
            'size' => 'required|integer|min:1|max:2',
            'syrup' => 'required|string',
            'milk' => 'required|string',
        ]);

        // Check if the product exists, else return with a 404
        Product::findOrFail($request->product_id);

        $order = new Order();

        $order->user_id = Auth::id();
        $order->product_id = $request->product_id;
        $order->size = $request->size;
        $order->syrup = $request->syrup;
        $order->milk = $request->milk;

        $order->save();

        return redirect(route('home'));
    }

    /**
     * Cancel the order
     * TODO: Only possible if the order isn't marked as processed by the barista
     * @param $id
     * @return RedirectResponse
     */
    public function cancel($id)
    {
        $order = Order::findorFail($id);

        $order->status = 9;

        $order->save();

        return back();
    }

    /**
     * Change the order status (ADMIN)
     * @param $id
     * @return RedirectResponse
     */
    public function changeStatus($id)
    {
        $order = Order::findorFail($id);

        if ($order->status == 0) {
            $order->status = 1;
        } else {
            $order->status = 2;
        }

        $order->save();

        return back();
    }
}
