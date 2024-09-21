<div>
    <form wire:submit="save">
        {{-- Supplier --}}
        <div class="mb-3">
            <label for="supplier_id"
                   class="form-label">Supplier</label>
            <select class="form-control @error('selectedSupplierID') is-invalid @enderror"
                    id="supplier_id"
                    wire:model="selectedSupplierID"
                    wire:change="populateProducts">
                <option value="">[Select a Supplier]</option>
                @foreach ($suppliers as $supplier)
                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                @endforeach
            </select>

            @error('selectedSupplierID')
            <span class="invalid-feedback"
                  role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <p class="fw-bold">Order Items: {{count($orderItems)}}</p>

        <div class="border p-3">
            @foreach ($orderItems as $index => $orderItem)
            <div class="row">
                <div class="col-3">
                    {{-- Product --}}
                    <div class="mb-3">
                        <label for="product_id"
                               class="form-label">{{$index+1}}. Product</label>
                        <select class="form-control @error('orderItems.'.$index.'.product_id') is-invalid @enderror"
                                id="product_id"
                                wire:model="orderItems.{{ $index }}.product_id"
                                wire:change="setUnitPriceAndCalculateTotalPrice('{{ $index }}')">
                            <option value="">[Select a Product]</option>
                            @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>

                        @error('orderItems.'.$index.'.product_id')
                        <span class="invalid-feedback"
                              role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-3">
                    {{-- Unit Price --}}
                    <div class="mb-3">
                        <label for="unitPrice"
                               class="form-label">Unit Price</label>
                        <input type="number"
                               class="form-control @error('orderItems.'.$index.'.unit_price') is-invalid @enderror"
                               id="unitPrice"
                               wire:model="orderItems.{{ $index }}.unit_price"
                               placeholder="Select a Product first"
                               disabled>

                        @error('orderItems.'.$index.'.unit_price')
                        <span class="invalid-feedback"
                              role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-2">
                    {{-- Quantity --}}
                    <div class="mb-3">
                        <label for="quantity"
                               class="form-label">Quantity</label>
                        <input type="number"
                               class="form-control @error('orderItems.'.$index.'.quantity') is-invalid @enderror"
                               id="quantity"
                               wire:model="orderItems.{{ $index }}.quantity"
                               wire:change="calculateTotalPrice('{{ $index }}')"
                               placeholder="Quantity">

                        @error('orderItems.'.$index.'.quantity')
                        <span class="invalid-feedback"
                              role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-3">
                    {{-- Total Price --}}
                    <div class="mb-3">
                        <label for="totalPrice"
                               class="form-label">Total Price</label>
                        <input type="number"
                               class="form-control @error('orderItems.'.$index.'.total_price') is-invalid @enderror"
                               id="totalPrice"
                               wire:model="orderItems.{{ $index }}.total_price"
                               placeholder="Select a Product and add quantity first"
                               disabled>

                        @error('orderItems.'.$index.'.total_price')
                        <span class="invalid-feedback"
                              role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-1">
                    @if(count($orderItems) > 1)
                    <div class="mt-2">
                        <button type="button"
                                wire:click="removeOrderItem('{{ $index }}')"
                                class="btn btn-sm btn-danger mt-4">Remove</button>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-end">
            <button type="button"
                    wire:click="addOrderItem"
                    class="btn btn-sm btn-success mt-2">Add Order Item</button>
        </div>

        <div class="mb-3">
            <label for="totalPrice"
                   class="form-label">Total Price</label>
            <input type="number"
                   class="form-control @error('totalPrice') is-invalid @enderror"
                   id="totalPrice"
                   wire:model="totalPrice"
                   placeholder="Select a Product and add quantity first"
                   disabled>

            @error('totalPrice')
            <span class="invalid-feedback"
                  role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="text-end">
            <hr>
            <button type="submit"
                    class="btn btn-primary">Create Purchase Order</button>
        </div>
    </form>
</div>
