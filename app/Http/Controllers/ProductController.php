<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Listado de Productos ';
        // $products = Product::where('is_active', true)->with('category')->latest()->paginate(5);
        // return view('products.index', compact('products', 'title'));

        $query = Product::where('is_active', true)->latest();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }

        $products = $query->paginate(5);

        return view('products.index', compact('products', 'title'));
    }

    public function create()
    {
        $title = 'Nuevo producto ';
        $categories = Category::all();
        return view('products.create', compact('categories', 'title'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0|max:999999.99',
        ]);

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Producto creado exitosamente');
    }

    public function show(Product $product)
    {
        $title = 'Detalles de ' . $product->name . ' ';
        return view('products.show', compact('product', 'title'));
    }

    public function edit(Product $product)
    {
        $title = 'Editar ' . $product->name . ' ';
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories', 'title'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'string', 'exists:categories,id'],
            'price' => ['required', 'string', 'min:0', 'max:999999.99'],
        ]);

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Producto actualizado exitosamente');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->is_active = false;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Producto eliminado exitosamente');
    }
}
