<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerOrder;
use Illuminate\Support\Facades\App;

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

    public function pdf(CustomerOrder $customerOrder)
    {
        // view render
        $view = view('customer-orders.pdf', [
            'customerOrder' => $customerOrder
        ])->render();

        // pdf wrapper load
        $pdf = App::make('snappy.pdf.wrapper');

        // rendered view to be loaded as HTML
        $pdf->loadHTML($view);

        // pdf return inline
        return $pdf->inline();
    }
}
