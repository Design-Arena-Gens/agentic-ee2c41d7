<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class OrderTrackingController extends Controller
{
    public function index(Request $request, Brand $brand): View
    {
        $orderNumber = $request->string('order_number')->toString();
        $order = null;

        if ($orderNumber) {
            $order = Order::query()
                ->where('brand_id', $brand->id)
                ->where('order_number', $orderNumber)
                ->with('shippingAddress')
                ->first();
        }

        return view('brands.orders.track', compact('brand', 'order', 'orderNumber'));
    }
}
