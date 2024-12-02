<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    // Menampilkan daftar produk
    public function index()
    {
        $products = Product::all(); // Ambil semua produk
        return view('admin.data_product', compact('products')); // Ganti dengan nama view yang sesuai
    }

    public function dashboard()
    {
        $products = Product::all(); // Ambil semua produk
        return view('kasir.dashboard', compact('products')); // Ganti dengan nama view yang sesuai
    }

    // Menampilkan form untuk menambahkan produk baru
    public function create()
    {
        return view('admin.product.create'); // Ganti dengan nama view yang sesuai
    }

    // Menyimpan produk baru ke database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga_produk' => 'required|numeric',
            'jenis' => 'required|string|max:255',
            'kategori' => 'required|in:makanan,minuman', // Periksa kategori dalam ENUM
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Buat instance produk baru
        $product = new Product();
        $product->nama_produk = $request->nama_produk;
        $product->harga_produk = $request->harga_produk;
        $product->stock = $request->stock;
        $product->jenis = $request->jenis;
        $product->kategori = $request->kategori;

        // Menangani upload gambar
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $product->image = $imagePath; // Simpan path gambar
        }

        // Simpan produk ke database
        $product->save();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.data_product')->with('success', 'Product added successfully!');
    }

    // Menampilkan form untuk mengedit produk
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product.edit', compact('product'));
    }

    // Mengupdate produk
    public function update(Request $request, $id)
{
    $request->validate([
        'nama_produk' => 'required|string|max:255',
        'harga_produk' => 'required|numeric',
        'jenis' => 'required|string|max:255',
        'kategori' => 'required|in:makanan,minuman',
        'stock' => 'required|integer',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $product = Product::findOrFail($id);
    $product->nama_produk = $request->nama_produk;
    $product->harga_produk = $request->harga_produk;
    $product->stock = $request->stock;
    $product->jenis = $request->jenis;
    $product->kategori = $request->kategori;

    // Cek dan tangani upload gambar baru
    if ($request->hasFile('image')) {
        // Hapus gambar lama jika ada
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        // Simpan gambar baru ke storage
        $imagePath = $request->file('image')->store('images', 'public');
        $product->image = $imagePath;
    }

    // Simpan produk ke database
    $product->save();

    return redirect()->route('admin.data_product')->with('success', 'Product updated successfully!');
}


    // Menghapus produk
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.data_product')->with('success', 'Product deleted successfully!');
    }

    
public function searchProduct(Request $request)
{
    $search = $request->input('search');
    
    // If search input is empty, return an empty array
    if (empty($search)) {
        return response()->json([]);
    }

    // Query to search products by 'id', 'nama_produk', 'kategori', 'jenis'
    $products = DB::table('products')
        ->where('id', 'like', '%' . $search . '%') // Search by partial ID
        ->orWhere('nama_produk', 'like', '%' . $search . '%') // Search by product name (partial match)
        ->orWhere('kategori', 'like', '%' . $search . '%') // Search by category (partial match)
        ->orWhere('jenis', 'like', '%' . $search . '%') // Search by type (partial match)
        ->get();

    return response()->json($products);
}



    
}