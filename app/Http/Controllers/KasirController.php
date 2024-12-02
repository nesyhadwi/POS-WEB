<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class KasirController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('kasir.dashboard', compact('products'));
    }

    public function dashboard() // Tambahkan method ini
    {
        return $this->index(); // Panggil method index
    }

    
}
