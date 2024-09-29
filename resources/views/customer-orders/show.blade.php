@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 fw-bold">
            <h5>Order Details</h3>
        </div>
        <div class="col-3">
            <strong>ID:</strong>
            {{ $customerOrder->id }}
        </div>
        <div class="col-3">
            <strong>Customer Name:</strong>
            {{ $customerOrder->customer->name }}
        </div>
        <div class="col-3">
            <strong>Total Price:</strong>
            {{ Number::currency($customerOrder->total_price, 'INR') }}
        </div>
        <div class="col-3">
            <strong>Created At:</strong>
            {{ date('d/m/Y', strtotime($customerOrder->created_at)) }}
        </div>
    </div>

    <hr>
    <div class="row">
        <div class="col-12 fw-bold">
            <h5>Order Items</h3>
        </div>
        <div class="col-3 fw-bold">
            Supplier Name
        </div>
        <div class="col-3 fw-bold">
            Product Name
        </div>
        <div class="col-2 fw-bold">
            Quantity
        </div>
        <div class="col-2 fw-bold">
            Unit Price
        </div>
        <div class="col-2 fw-bold">
            Total Price
        </div>
        @foreach ($customerOrder->customerOrderItems as $item)
        <div class="col-3">
            {{ $loop->iteration }}. {{ $item->supplier->name }}
        </div>
        <div class="col-3">
            {{ $item->product->name }}
        </div>
        <div class="col-2">
            {{ $item->quantity }}
        </div>
        <div class="col-2">
            {{ Number::currency($item->unit_price, 'INR') }}
        </div>
        <div class="col-2">
            {{ Number::currency($item->total_price, 'INR') }}
        </div>
        @endforeach
        <div class="col-12">
            <hr>
        </div>
        <div class="col-10">
            <strong>TOTAL PRICE:</strong>
        </div>
        <div class="col-2">
            <strong>
                {{ Number::currency($customerOrder->total_price, 'INR') }}
            </strong>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-12">
            <a href="{{ route('customer-orders.pdf', ['customerOrder' => $customerOrder->id]) }}" class="btn btn-primary">PDF</a>
        </div>
    </div>
</div>
@endsection
