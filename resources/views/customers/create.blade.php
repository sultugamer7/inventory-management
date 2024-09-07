@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('customers.store') }}"
          method="POST">
        @csrf
        {{-- Name --}}
        <div class="mb-3">
            <label for="name"
                   class="form-label">Name</label>
            <input type="text"
                   class="form-control @error('name') is-invalid @enderror"
                   id="name"
                   name="name"
                   placeholder="Customer name"
                   value="{{ old('name') }}">

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
                   placeholder="Customer email address"
                   value="{{ old('email') }}">

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
                   placeholder="Customer phone / mobile number"
                   value="{{ old('phone') }}">

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
                      placeholder="Customer address">{{ old('address') }}</textarea>

            @error('address')
            <span class="invalid-feedback"
                  role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="text-end">
            <button type="submit"
                    class="btn btn-primary">Create Customer</button>
        </div>
    </form>
</div>
@endsection
