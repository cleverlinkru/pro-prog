<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop\Order;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index()
    {
        return Inertia::render('Shop/Order/Index', [
            'orders' => Order::with('user', 'product')->orderBy('id')->get(),
        ]);
    }
}
