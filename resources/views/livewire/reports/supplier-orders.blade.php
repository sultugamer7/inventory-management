<div>
    <div class="row">
        <div class="col-6">
            <h5>Reports - Supplier Orders</h5>
            <p>Total Amount: {{ Number::currency($totalAmount, 'INR') }}
        </div>
        <div class="col-6">
            {{-- Supplier --}}
            <div class="form-check form-check-inline">
                <label for="supplier_id"
                       class="form-check-label">Supplier</label>
                <select class="form-control"
                        id="supplier_id"
                        wire:model="selectedSupplierID"
                        wire:change="supplierUpdated">
                    <option value="">[All]</option>
                    @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label"
                       for="fromDate">From Date</label>
                <input type="date"
                       class="form-control"
                       id="fromDate"
                       wire:model="fromDate"
                       wire:change="validateDates">
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label"
                       for="toDate">To Date</label>
                <input type="date"
                       class="form-control"
                       id="toDate"
                       wire:model="toDate"
                       wire:change="validateDates">
            </div>
        </div>
        <div class="col-12">
            <hr>
            <br>
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
            {{ Number::currency($supplierOrder->total_price, 'INR') }}
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
