<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Supplier $supplier)
    {
        $search = $request->input('search', null);

        return view('suppliers.products.index', [
            'supplier' => $supplier,
            'products' => Product::orderBy('name')
                ->where('supplier_id', $supplier->id)
                ->when($search, function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                ->paginate(10)
        ]);
    }

    public function search(Request $request, Supplier $supplier)
    {
        $data = $request->validate([
            'search' => ['nullable', 'string', 'max:255']
        ]);

        return redirect()->route('suppliers.products.index', ['supplier' => $supplier->id, 'search' => $data['search']]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Supplier $supplier)
    {
        return view('suppliers.products.create', [
            'supplier' => $supplier,
            'categories' => Category::orderBy('name')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Supplier $supplier)
    {
        // Data validation
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'category_id' => ['required', 'integer'],
            'stock' => ['required', 'integer', 'min:0'],
            'buy_price' => ['required', 'numeric', 'min:0'],
            'sell_price' => ['required', 'numeric', 'min:0'],
            'description' => ['required', 'string', 'max:5000'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png']
        ]);

        if (isset($data['image'])) {
            $path = $data['image']->store('products');
            $data['image'] = $path;
        }

        $data['supplier_id'] = $supplier->id;

        // Store data in database
        Product::create($data);

        // Redirect to index page
        return redirect()->route('suppliers.products.index', $supplier->id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier, Product $product)
    {
        return view('suppliers.products.edit', [
            'supplier' => $supplier,
            'product' => $product,
            'categories' => Category::orderBy('name')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier, Product $product)
    {
        // 1. Data validation
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'category_id' => ['required', 'integer'],
            'stock' => ['required', 'integer', 'min:0'],
            'buy_price' => ['required', 'numeric', 'min:0'],
            'sell_price' => ['required', 'numeric', 'min:0'],
            'description' => ['required', 'string', 'max:5000'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png']
        ]);

        if (isset($data['image'])) {
            if ($product->image) {
                Storage::delete($product->image);
            }
            $path = $data['image']->store('products');
            $data['image'] = $path;
        }

        // 2. Update data in database
        $product->update($data);

        // 3. Redirect to index page
        return redirect()->route('suppliers.products.index', $supplier->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier, Product $product)
    {
        $product->delete();

        return redirect()->route('suppliers.products.index', $supplier->id);
    }
}
