@extends('layouts.app')

@section('content')
<div class="container">

    @include('suppliers.products.partials.supplier-details')

    <form action="{{ route('suppliers.products.store', $supplier->id) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        {{-- Name --}}
        <div class="mb-3">
            <label for="name"
                   class="form-label">Name</label>
            <input type="text"
                   class="form-control @error('name') is-invalid @enderror"
                   id="name"
                   name="name"
                   placeholder="Supplier name"
                   value="{{ old('name') }}">

            @error('name')
            <span class="invalid-feedback"
                  role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        {{-- Category --}}
        <div class="mb-3">
            <label for="category_id"
                   class="form-label">Category</label>
            <select class="form-control @error('category_id') is-invalid @enderror"
                    id="category_id"
                    name="category_id">
                    <option value="">[Select a Category]</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            @error('category_id')
            <span class="invalid-feedback"
                  role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        {{-- Stock --}}
        <div class="mb-3">
            <label for="stock"
                   class="form-label">Stock</label>
            <input type="number"
                   class="form-control @error('stock') is-invalid @enderror"
                   id="stock"
                   name="stock"
                   placeholder="Product stock"
                   value="{{ old('stock') }}">

            @error('stock')
            <span class="invalid-feedback"
                  role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        {{-- Buy Price --}}
        <div class="mb-3">
            <label for="buy_price"
                   class="form-label">Buy Price</label>
            <input type="number"
                   class="form-control @error('buy_price') is-invalid @enderror"
                   id="buy_price"
                   name="buy_price"
                   placeholder="Product buy price"
                   value="{{ old('buy_price') }}">

            @error('buy_price')
            <span class="invalid-feedback"
                  role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        {{-- Sell Price --}}
        <div class="mb-3">
            <label for="sell_price"
                   class="form-label">Sell Price</label>
            <input type="number"
                   class="form-control @error('sell_price') is-invalid @enderror"
                   id="sell_price"
                   name="sell_price"
                   placeholder="Product sell price"
                   value="{{ old('sell_price') }}">

            @error('sell_price')
            <span class="invalid-feedback"
                  role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        {{-- Description --}}
        <div class="mb-3">
            <label for="description"
                   class="form-label">Description</label>
            <textarea rows="3"
                      class="form-control @error('description') is-invalid @enderror"
                      id="description"
                      name="description"
                      placeholder="Product description">{{ old('description') }}</textarea>

            @error('description')
            <span class="invalid-feedback"
                  role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        {{-- Image --}}
        <div class="mb-3">
            <label for="image"
                   class="form-label">Image</label>
            <input type="file"
                   class="form-control @error('image') is-invalid @enderror"
                   id="image"
                   name="image">

            @error('image')
            <span class="invalid-feedback"
                  role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="text-end">
            <button type="submit"
                    class="btn btn-primary">Create Product</button>
        </div>
    </form>
</div>
@endsection
