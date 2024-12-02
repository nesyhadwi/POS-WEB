<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function dashboard() {
        $user = Auth::user();

        return view('owner.dashboard', compact('user'));
    }

    public function data_product() {
        $products = Product::all(); // Ambil semua produk
        return view('owner.data_product', compact('products')); // Ganti dengan nama view yang sesuai
    }

    public function data_users() {
        $users = User::all(); // Ambil semua produk
        return view('owner.data_users', compact('users')); // Ganti dengan nama view yang sesuai
    }

    public function history(){

    $transactions = Transaksi::with('details.product')->orderBy('created_at', 'desc')->get();

    return view('owner.history', compact('transactions'));
    }

    
    public function log_activity(){

        $logs = DB::table('log')
        ->join('users', 'log.id_user', '=', 'users.id')
        ->select('log.id', 'log.id_user', 'log.tanggal_login', 'log.tanggal_logout', 'log.role')
        ->orderBy('log.tanggal_login', 'desc') // Urutan DESC berdasarkan tanggal_login
        ->paginate(10);
        
return view('owner.log_activity', compact('logs'));
    }
}
