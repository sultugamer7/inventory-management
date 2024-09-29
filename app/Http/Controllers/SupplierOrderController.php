<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupplierOrder;
use Illuminate\Support\Facades\App;

class SupplierOrderController extends Controller
{
    public function index()
    {
        return view('supplier-orders.index', [
            'supplierOrders' => SupplierOrder::latest()->paginate(10)
        ]);
    }

    public function create()
    {
        return view('supplier-orders.create');
    }

    public function show(SupplierOrder $supplierOrder)
    {
        return view('supplier-orders.show', [
            'supplierOrder' => $supplierOrder
        ]);
    }

    public function pdf(SupplierOrder $supplierOrder)
    {
        $view = view('supplier-orders.pdf', [
            'supplierOrder' => $supplierOrder
        ])->render();

        $pdf = App::make('snappy.pdf.wrapper');
        $pdf->loadHTML($view);

        return $pdf->inline();
    }
}
