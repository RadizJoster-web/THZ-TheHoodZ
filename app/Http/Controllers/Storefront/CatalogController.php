<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Mengelola halaman utama katalog produk pakaian TheHoodZ untuk pengunjung dan pelanggan.
 */
class CatalogController extends Controller
{
    /**
     * Menampilkan katalog produk dengan pencarian, filter kategori, dan pagination.
     */
    public function index(Request $request): View
    {
        $categories = Category::withCount('products')->get();
        $query = Product::with('category')->latest();

        if ($request->filled('search')) {
            $keyword = $request->input('search');
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                  ->orWhere('description', 'like', "%{$keyword}%");
            });
        }

        if ($request->filled('category')) {
            $slug = $request->input('category');
            $query->whereHas('category', function ($q) use ($slug) {
                $q->where('slug', $slug);
            });
        }

        if ($request->filled('sort')) {
            switch ($request->input('sort')) {
                case 'price_low':
                    $query->reorder('price', 'asc');
                    break;
                case 'price_high':
                    $query->reorder('price', 'desc');
                    break;
                case 'name':
                    $query->reorder('name', 'asc');
                    break;
            }
        }

        $products = $query->paginate(10)->withQueryString();

        return view('storefront.catalog.index', compact('categories', 'products'));
    }
}
