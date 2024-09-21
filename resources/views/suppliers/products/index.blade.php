@extends('layouts.app')

@section('content')
<div class="container">

    @include('suppliers.products.partials.supplier-details')

    <div class="row">
        <div class="col-6">
            <form action="{{ route('suppliers.products.search', $supplier->id) }}"
                  method="POST">
                @csrf
                <div class="input-group mb-3">
                    <button class="input-group-text"
                            id="search"
                            type="submit">🔍</button>
                    <input type="search"
                           class="form-control @error('search') is-invalid @enderror"
                           placeholder="Search by product name..."
                           aria-describedby="search"
                           name="search"
                           value="{{ request('search', null) }}">

                    @error('search')
                    <span class="invalid-feedback"
                          role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </form>
        </div>
        <div class="col-6">
            <div class="text-end mb-4">
                <a href="{{ route('suppliers.products.create', $supplier->id) }}"
                   class="btn btn-primary">Create</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-1 fw-bold">
            ID
        </div>
        <div class="col-2 fw-bold">
            Product Name
        </div>
        <div class="col-1 fw-bold">
            Category
        </div>
        <div class="col-2 fw-bold">
            Description
        </div>
        <div class="col-2 fw-bold">
            Buy Price / Sell Price
        </div>
        <div class="col-2 fw-bold">
            Stock
        </div>
        <div class="col-2 fw-bold">
            Actions
        </div>
    </div>
    <hr>

    @forelse ($products as $product)
    <div class="row">
        <div class="col-1">
            {{ $product->id }}
        </div>
        <div class="col-2">
            @if ($product->image)
                <img src="{{ asset($product->image) }}"
                    class="product-image">
            @endif
            {{ $product->name }}
        </div>
        <div class="col-1">
            {{ $product->category->name }}
        </div>
        <div class="col-2">
            {{ $product->description }}
        </div>
        <div class="col-2">
            {{ $product->buy_price }} / {{ $product->sell_price }}
        </div>
        <div class="col-2">
            {{ $product->stock }}
        </div>
        <div class="col-1">
            <a href="{{ route('suppliers.products.edit', [$supplier->id, $product->id]) }}"
               class="btn btn-secondary btn-sm">Edit</a>
        </div>
        <div class="col-1">
            <form action="{{ route('suppliers.products.destroy', [$supplier->id, $product->id]) }}"
                  method="POST">
                @csrf
                @method('DELETE')

                <button type="submit"
                        class="btn btn-danger btn-sm"
                        onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </div>
    </div>
    <hr>
    @empty
    <div class="alert alert-warning"
         role="alert">
        No products yet.
    </div>
    @endforelse
    {{ $products->withQueryString()->links() }}
</div>
@endsection
