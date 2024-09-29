@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
        </div>
        <div class="col-6">
            <div class="text-end mb-4">
                <a href="{{ route('customer-orders.create') }}"
                   class="btn btn-primary">Create</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-2 fw-bold">
            ID
        </div>
        <div class="col-2 fw-bold">
            Customer Name
        </div>
        <div class="col-2 fw-bold">
            Total Price
        </div>
        <div class="col-2 fw-bold">
            Created At
        </div>
        <div class="col-2 fw-bold">
            Actions
        </div>
    </div>
    <hr>

    @forelse ($customerOrders as $customerOrder)
    <div class="row">
        <div class="col-2">
            {{ $customerOrder->id }}
        </div>
        <div class="col-2">
            {{ $customerOrder->customer->name }}
        </div>
        <div class="col-2">
            {{ $customerOrder->total_price }}
        </div>
        <div class="col-2">
            {{ date('d/m/Y', strtotime($customerOrder->created_at)) }}
        </div>
        <div class="col-2">
            <a href="{{ route('customer-orders.show', $customerOrder->id) }}">
                View Order Details
            </a>
        </div>
    </div>
    <hr>
    @empty
    <div class="alert alert-warning"
         role="alert">
        No customer orders yet.
    </div>
    @endforelse
    {{ $customerOrders->withQueryString()->links() }}
</div>
@endsection
