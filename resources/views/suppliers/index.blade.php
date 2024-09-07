@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <form action="{{ route('suppliers.search') }}"
                  method="POST">
                @csrf
                <div class="input-group mb-3">
                    <button class="input-group-text"
                            id="search"
                            type="submit">🔍</button>
                    <input type="search"
                           class="form-control @error('search') is-invalid @enderror"
                           placeholder="Search by supplier name, email address, phone or address..."
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
                <a href="{{ route('suppliers.create') }}"
                   class="btn btn-primary">Create</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-1 fw-bold">
            ID
        </div>
        <div class="col-2 fw-bold">
            Supplier Name
        </div>
        <div class="col-2 fw-bold">
            Email Address
        </div>
        <div class="col-2 fw-bold">
            Phone Number
        </div>
        <div class="col-3 fw-bold">
            Address
        </div>
        <div class="col-2 fw-bold">
            Actions
        </div>
    </div>
    <hr>

    @forelse ($suppliers as $supplier)
    <div class="row">
        <div class="col-1">
            {{ $supplier->id }}
        </div>
        <div class="col-2">
            {{ $supplier->name }}
        </div>
        <div class="col-2">
            {{ $supplier->email }}
        </div>
        <div class="col-2">
            {{ $supplier->phone }}
        </div>
        <div class="col-3">
            {{ $supplier->address }}
        </div>
        <div class="col-1">
            <a href="{{ route('suppliers.edit', $supplier->id) }}"
               class="btn btn-secondary btn-sm">Edit</a>
        </div>
        <div class="col-1">
            <form action="{{ route('suppliers.destroy', $supplier->id) }}"
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
        No suppliers yet.
    </div>
    @endforelse
    {{ $suppliers->withQueryString()->links() }}
</div>
@endsection
