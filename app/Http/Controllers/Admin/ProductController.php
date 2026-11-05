<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\FileUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

/**
 * Mengelola operasi CRUD inventaris produk pakaian TheHoodZ.
 */
class ProductController extends Controller
{
    protected FileUploadService $fileService;

    public function __construct(FileUploadService $fileService)
    {
        $this->fileService = $fileService;
    }

    /**
     * Menampilkan daftar produk beserta kategori dan relasinya.
     */
    public function index(): View
    {
        $products = Product::with('category')->latest()->get();
        $categories = Category::all();
        return view('admin.products.index', compact('products', 'categories'));
    }

    /**
     * Menampilkan form penambahan produk pakaian baru.
     */
    public function create(): View
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Menyimpan produk baru dan mengunggah gambar ke storage public.
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $gallery = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $gallery[] = $this->fileService->upload($file, 'products');
            }
        }

        Product::create([
            'category_id' => $request->input('category_id'),
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name') . '-' . Str::random(4)),
            'size' => $request->input('size'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'image' => $gallery[0] ?? null,
            'images' => $gallery,
            'description' => $request->input('description'),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan form pengubahan data produk.
     */
    public function edit(Product $product): View
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Memperbarui data produk dan mengganti foto jika diunggah berkas baru.
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $data = $request->only(['category_id', 'name', 'size', 'price', 'stock', 'description']);

        if ($request->hasFile('images')) {
            if (is_array($product->images)) {
                foreach ($product->images as $oldImg) {
                    $this->fileService->delete($oldImg);
                }
            }
            $gallery = [];
            foreach ($request->file('images') as $file) {
                $gallery[] = $this->fileService->upload($file, 'products');
            }
            $data['images'] = $gallery;
            $data['image'] = $gallery[0];
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Menghapus produk beserta gambar terkait dari server.
     */
    public function destroy(Product $product): RedirectResponse
    {
        if (is_array($product->images)) {
            foreach ($product->images as $img) {
                $this->fileService->delete($img);
            }
        } else {
            $this->fileService->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
