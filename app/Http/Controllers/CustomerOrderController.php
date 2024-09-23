<?php

namespace App\Http\Controllers;

use App\Models\CustomerOrder;
use Illuminate\Http\Request;

class CustomerOrderController extends Controller
{
    public function index()
    {
        return view('customer-orders.index', [
            'customerOrders' => CustomerOrder::latest()->paginate(10)
        ]);
    }

    public function create()
    {
        return view('customer-orders.create');
    }

    public function show(CustomerOrder $customerOrder)
    {
        return view('customer-orders.show', [
            'customerOrder' => $customerOrder
        ]);
    }
}
