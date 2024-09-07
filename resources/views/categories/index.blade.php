@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <form action="{{ route('categories.search') }}"
                  method="POST">
                @csrf
                <div class="input-group mb-3">
                    <button class="input-group-text"
                            id="search"
                            type="submit">🔍</button>
                    <input type="search"
                           class="form-control @error('search') is-invalid @enderror"
                           placeholder="Search by category name..."
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
                <a href="{{ route('categories.create') }}"
                   class="btn btn-primary">Create</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-1 fw-bold">
            ID
        </div>
        <div class="col-9 fw-bold">
            Category Name
        </div>
        <div class="col-2 fw-bold">
            Actions
        </div>
    </div>
    <hr>

    @forelse ($categories as $category)
    <div class="row">
        <div class="col-1">
            {{ $category->id }}
        </div>
        <div class="col-9">
            {{ $category->name }}
        </div>
        <div class="col-1">
            <a href="{{ route('categories.edit', $category->id) }}"
               class="btn btn-secondary btn-sm">Edit</a>
        </div>
        <div class="col-1">
            <form action="{{ route('categories.destroy', $category->id) }}"
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
        No categories yet.
    </div>
    @endforelse
    {{ $categories->withQueryString()->links() }}
</div>
@endsection
