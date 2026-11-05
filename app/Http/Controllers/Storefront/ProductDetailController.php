<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\View\View;

/**
 * Menampilkan halaman detail produk pakaian beserta galeri foto dan formulir checkout.
 */
class ProductDetailController extends Controller
{
    /**
     * Menampilkan detail produk berdasarkan slug yang diakses.
     */
    public function show(string $slug): View
    {
        $product = Product::with('category')->where('slug', $slug)->firstOrFail();

        $gallery = [];
        if ($product->image) {
            $gallery[] = $product->image;
        }
        if (is_array($product->images)) {
            foreach ($product->images as $img) {
                if (!in_array($img, $gallery, true)) {
                    $gallery[] = $img;
                }
            }
        }

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('storefront.product.show', compact('product', 'gallery', 'relatedProducts'));
    }
}
