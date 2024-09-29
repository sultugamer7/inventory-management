<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function supplierOrders()
    {
        return view('reports.supplier-orders');
    }

    public function customerOrders()
    {
        return view('reports.customer-orders');
    }
}
