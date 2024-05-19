<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        try {
            $title = 'Listado de Productos ';
            $query = Product::where('is_active', true)->latest();

            if ($request->has('search')) {
                $query->where('name', 'like', '%' . $request->input('search') . '%');
            }

            $products = $query->paginate(5);

            return view('products.index', compact('products', 'title'));
        } catch (\Exception $e) {
            Log::error('Error al obtener productos: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al obtener los productos.');
        }
    }

    public function create()
    {
        try {
            $title = 'Nuevo producto ';
            $categories = Category::all();
            return view('products.create', compact('categories', 'title'));
        } catch (\Exception $e) {
            Log::error('Error al cargar el formulario de creación de productos: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al cargar el formulario.');
        }
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'price' => 'required|numeric|min:0|max:999999.99',
            ]);

            Product::create($validated);

            return redirect()->route('products.index')->with('success', 'Producto creado exitosamente');
        } catch (\Exception $e) {
            Log::error('Error al crear producto: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al crear el producto.');
        }
    }

    public function show(Product $product)
    {
        try {
            $title = 'Detalles de ' . $product->name . ' ';
            return view('products.show', compact('product', 'title'));
        } catch (\Exception $e) {
            Log::error('Error al mostrar el producto: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al mostrar el producto.');
        }
    }

    public function edit(Product $product)
    {
        try {
            $title = 'Editar ' . $product->name . ' ';
            $categories = Category::all();
            return view('products.edit', compact('product', 'categories', 'title'));
        } catch (\Exception $e) {
            Log::error('Error al cargar el formulario de edición de productos: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al cargar el formulario.');
        }
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        try {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string', 'max:255'],
                'category_id' => ['required', 'exists:categories,id'],
                'price' => ['required', 'numeric', 'min:0', 'max:999999.99'],
            ]);

            $product->update($validated);

            return redirect()->route('products.index')->with('success', 'Producto actualizado exitosamente');
        } catch (\Exception $e) {
            Log::error('Error al actualizar producto: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar el producto.');
        }
    }

    public function destroy(Product $product): RedirectResponse
    {
        try {
            $product->is_active = false;
            $product->save();

            return redirect()->route('products.index')->with('success', 'Producto eliminado exitosamente');
        } catch (\Exception $e) {
            Log::error('Error al eliminar producto: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al eliminar el producto.');
        }
    }
}
