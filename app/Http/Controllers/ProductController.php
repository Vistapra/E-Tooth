<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        $products = Product::with('category')->orderBy('id', 'DESC')->get();
        return view('admin.products.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'about' => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
            'photo' => 'required|image|mimetypes:image/*|max:2048'
        ]);

        DB::beginTransaction();

        try {
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('product_photos', 'public');
                $validated['photo'] = $photoPath;
                $validated['slug'] = Str::slug($request->name);

                $newProduct = Product::create($validated);

                DB::commit();

                return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
            } else {
                return back()->withErrors(['photo' => 'Photo is required']);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['System error: ' . $e->getMessage()],
            ]);
            throw $error;
        }
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'about' => 'sometimes|string',
            'category_id' => 'sometimes|integer|exists:categories,id'
        ]);

        DB::beginTransaction();

        try {
            if ($request->hasFile('photo')) {
                // Delete old photo
                if ($product->photo) {
                    Storage::disk('public')->delete($product->photo);
                }

                // Store new photo
                $photoPath = $request->file('photo')->store('product_photos', 'public');
                $validated['photo'] = $photoPath;
            }

            $validated['slug'] = Str::slug($request->name);

            $product->update($validated);

            DB::commit();

            return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['System error: ' . $e->getMessage()],
            ]);
            throw $error;
        }
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        DB::beginTransaction();

        try {
            if ($product->photo) {
                Storage::disk('public')->delete($product->photo);
            }

            $product->delete();

            DB::commit();

            return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['System error: ' . $e->getMessage()],
            ]);
            throw $error;
        }
    }
}
