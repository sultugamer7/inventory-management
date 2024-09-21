@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('suppliers.products.update', [$supplier->id, $product->id]) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Name --}}
        <div class="mb-3">
            <label for="name"
                   class="form-label">Name</label>
            <input type="text"
                   class="form-control @error('name') is-invalid @enderror"
                   id="name"
                   name="name"
                   value="{{ old('name', $product->name) }}"
                   placeholder="Product name">

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
                <option value="{{ $category->id }}" @if (old('category_id', $product->category_id) == $category->id) selected @endif>{{ $category->name }}</option>
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
                   value="{{ old('stock', $product->stock) }}"
                   placeholder="Product stock">

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
                   class="form-label">Buy price</label>
            <input type="number"
                   class="form-control @error('buy_price') is-invalid @enderror"
                   id="buy_price"
                   name="buy_price"
                   placeholder="Product buy price"
                   value="{{ old('buy_price', $product->buy_price) }}">

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
                   value="{{ old('sell_price', $product->sell_price) }}">

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
                   placeholder="Product description">{{ old('description', $product->description) }}</textarea>

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
                    class="form-label">New Image</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror"
                id="image"
                name="image">

            @error('image')
            <span class="invalid-feedback"
                  role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            @if ($product->image)
                <p class="mt-3">Current Image:</p>
                <img src="{{ asset($product->image) }}" alt="Product image" height="200">
            @endif
        </div>

        <div class="text-end">
            <button type="submit"
                    class="btn btn-primary">Update Product</button>
        </div>
    </form>
</div>
@endsection
