@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('suppliers.update', $supplier->id) }}"
          method="POST">
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
                   value="{{ old('name', $supplier->name) }}"
                   placeholder="Supplier name">

            @error('name')
            <span class="invalid-feedback"
                  role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        {{-- Email --}}
        <div class="mb-3">
            <label for="email"
                   class="form-label">Email Address</label>
            <input type="email"
                   class="form-control @error('email') is-invalid @enderror"
                   id="email"
                   name="email"
                   value="{{ old('email', $supplier->email) }}"
                   placeholder="Supplier email address">

            @error('email')
            <span class="invalid-feedback"
                  role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        {{-- Phone --}}
        <div class="mb-3">
            <label for="phone"
                   class="form-label">Phone / Mobile Number</label>
            <input type="text"
                   class="form-control @error('phone') is-invalid @enderror"
                   id="phone"
                   name="phone"
                   value="{{ old('phone', $supplier->phone) }}"
                   placeholder="Supplier phone / mobile number">

            @error('phone')
            <span class="invalid-feedback"
                  role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        {{-- Address --}}
        <div class="mb-3">
            <label for="address"
                   class="form-label">Address</label>
            <textarea rows="3"
                      class="form-control @error('address') is-invalid @enderror"
                      id="address"
                      name="address"
                      placeholder="Supplier address">{{ old('address', $supplier->address) }}</textarea>

            @error('address')
            <span class="invalid-feedback"
                  role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="text-end">
            <button type="submit"
                    class="btn btn-primary">Update Supplier</button>
        </div>
    </form>
</div>
@endsection
