<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

/**
 * Mengelola operasi CRUD master kategori pakaian TheHoodZ.
 */
class CategoryController extends Controller
{
    /**
     * Menampilkan daftar seluruh kategori beserta jumlah produk.
     */
    public function index(): View
    {
        $categories = Category::withCount('products')->latest()->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Menampilkan form penambahan kategori baru.
     */
    public function create(): View
    {
        return view('admin.categories.create');
    }

    /**
     * Menyimpan data kategori baru ke database.
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        Category::create([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name')),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan form pengubahan kategori.
     */
    public function edit(Category $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Memperbarui data kategori di database.
     */
    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $category->update([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name')),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Menghapus data kategori dari database.
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
