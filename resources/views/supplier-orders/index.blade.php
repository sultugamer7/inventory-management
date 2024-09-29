@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
        </div>
        <div class="col-6">
            <div class="text-end mb-4">
                <a href="{{ route('supplier-orders.create') }}"
                   class="btn btn-primary">Create</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-2 fw-bold">
            ID
        </div>
        <div class="col-2 fw-bold">
            Supplier Name
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

    @forelse ($supplierOrders as $supplierOrder)
    <div class="row">
        <div class="col-2">
            {{ $supplierOrder->id }}
        </div>
        <div class="col-2">
            {{ $supplierOrder->supplier->name }}
        </div>
        <div class="col-2">
            {{ $supplierOrder->total_price }}
        </div>
        <div class="col-2">
            {{ date('d/m/Y', strtotime($supplierOrder->created_at)) }}
        </div>
        <div class="col-2">
            <a href="{{ route('supplier-orders.show', $supplierOrder->id) }}">
                View Order Details
            </a>
        </div>
    </div>
    <hr>
    @empty
    <div class="alert alert-warning"
         role="alert">
        No supplier orders yet.
    </div>
    @endforelse
    {{ $supplierOrders->withQueryString()->links() }}
</div>
@endsection
