<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search', null);

        return view('categories.index', [
            'categories' => Category::orderBy('name')
                ->when($search, function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                ->paginate(10)
        ]);
    }

    public function search(Request $request)
    {
        $data = $request->validate([
            'search' => ['nullable', 'string', 'max:255']
        ]);

        return redirect()->route('categories.index', ['search' => $data['search']]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', [
            'category' => $category
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Data validation
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:3']
        ]);

        // Store data in database
        Category::create($data);

        // Redirect to index page
        return redirect()->route('categories.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // 1. Data validation
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);

        // 2. Update data in database
        $category->update($data);

        // 3. Redirect to index page
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index');
    }
}
