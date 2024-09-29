<div>
    <div class="row">
        <div class="col-6">
            <h5>Reports - Customer Orders</h5>
            <p>Total Amount: {{ Number::currency($totalAmount, 'INR') }}
        </div>
        <div class="col-6">
            {{-- Customer --}}
            <div class="form-check form-check-inline">
                <label for="customer_id"
                       class="form-check-label">Customer</label>
                <select class="form-control"
                        id="customer_id"
                        wire:model="selectedCustomerID"
                        wire:change="customerUpdated">
                    <option value="">[All]</option>
                    @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
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
            {{ Number::currency($customerOrder->total_price, 'INR') }}
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
