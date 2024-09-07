@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('categories.update', $category->id) }}"
          method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name"
                   class="form-label">Name</label>
            <input type="text"
                   class="form-control @error('name') is-invalid @enderror"
                   id="name"
                   name="name"
                   value="{{ old('name', $category->name) }}"
                   placeholder="Fruit, vegetables, meat, etc.">

            @error('name')
                <span class="invalid-feedback"
                      role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="text-end">
            <button type="submit"
                    class="btn btn-primary">Update Category</button>
        </div>
    </form>
</div>
@endsection
