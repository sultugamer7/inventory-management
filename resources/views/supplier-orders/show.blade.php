@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 fw-bold">
            <h5>Order Details</h3>
        </div>
        <div class="col-3">
            <strong>ID:</strong>
            {{ $supplierOrder->id }}
        </div>
        <div class="col-3">
            <strong>Supplier Name:</strong>
            {{ $supplierOrder->supplier->name }}
        </div>
        <div class="col-3">
            <strong>Total Price:</strong>
            {{ Number::currency($supplierOrder->total_price, 'INR') }}
        </div>
        <div class="col-3">
            <strong>Created At:</strong>
            {{ date('d/m/Y', strtotime($supplierOrder->created_at)) }}
        </div>
    </div>

    <hr>
    <div class="row">
        <div class="col-12 fw-bold">
            <h5>Order Items</h3>
        </div>
        <div class="col-3 fw-bold">
            Product Name
        </div>
        <div class="col-3 fw-bold">
            Quantity
        </div>
        <div class="col-3 fw-bold">
            Unit Price
        </div>
        <div class="col-3 fw-bold">
            Total Price
        </div>
        @foreach ($supplierOrder->supplierOrderItems as $item)
        <div class="col-3">
            {{ $loop->iteration }}. {{ $item->product->name }}
        </div>
        <div class="col-3">
            {{ $item->quantity }}
        </div>
        <div class="col-3">
            {{ Number::currency($item->unit_price, 'INR') }}
        </div>
        <div class="col-3">
            {{ Number::currency($item->total_price, 'INR') }}
        </div>
        @endforeach
        <div class="col-12">
            <hr>
        </div>
        <div class="col-9">
            <strong>TOTAL PRICE:</strong>
        </div>
        <div class="col-3">
            <strong>
                {{ Number::currency($supplierOrder->total_price, 'INR') }}
            </strong>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <hr>
            <a href="{{ route('supplier-orders.pdf', ['supplierOrder' => $supplierOrder->id]) }}"
               class="btn btn-primary">PDF</a>
        </div>
    </div>
</div>
@endsection
