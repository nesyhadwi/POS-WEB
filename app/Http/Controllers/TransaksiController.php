<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaksi;
use App\Models\TransaksiDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransaksiController extends Controller
{
    

    public function store(Request $request)
{
    $request->validate([
        'id_produk' => 'required|array',
        'nama_pelanggan' => 'required|string|max:255',
        'total_amount' => 'required|numeric|min:0',
        'uang_bayar' => 'required|numeric|min:0',
        'uang_kembali' => 'required|numeric|min:0',
        'qty' => 'required|array'
    ]);

    $namaPelanggan = $request->input('nama_pelanggan');
    $totalAmount = $request->input('total_amount');
    $uangBayar = $request->input('uang_bayar');
    $uangKembali = $request->input('uang_kembali');
    $nomorUnik = uniqid('TXN');
    
    DB::beginTransaction();

    try {
        // Insert data transaksi
        $transactionId = DB::table('transactions')->insertGetId([
            'nama_pelanggan' => $namaPelanggan,
            'nomor_unik' => $nomorUnik,
            'total_amount' => $totalAmount,
            'uang_bayar' => $uangBayar,
            'uang_kembali' => $uangKembali,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert data ke transactions_details untuk setiap produk
        $produkIds = $request->input('id_produk');
        $qtys = $request->input('qty');

        foreach ($produkIds as $index => $idProduk) {
            $qty = $qtys[$index];

            // Insert data detail transaksi
            DB::table('transactions_details')->insert([
                'id_transactions' => $transactionId,
                'id_product' => $idProduk,
                'qty' => $qty,
                'price' => Product::find($idProduk)->price, // Harga produk
            ]);

            // Kurangi stok produk berdasarkan qty
            $produk = Product::find($idProduk);
            if ($produk) {
                $produk->stock -= $qty;
                if ($produk->stock < 0) {
                    DB::rollBack();
                    return response()->json(['error' => 'Stok produk tidak mencukupi'], 400);
                }
                $produk->save();
            }
        }

        DB::commit();
        return response()->json(['success' => 'Transaksi berhasil disimpan']);
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Error transaksi: ' . $e->getMessage());
        return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
    }
}


    public function index()
{
    // Use Eloquent to fetch transactions with their details
    $transactions = Transaksi::with('details.product')->orderBy('created_at', 'desc')->get();

    return view('admin.history', compact('transactions'));
}


public function searchTransaction(Request $request)
{
    $query = $request->get('search');

    // Filter berdasarkan nomor unik atau nama pelanggan
    $transactions = Transaksi::with('details.product')
        ->where('nomor_unik', 'LIKE', "%{$query}%")
        ->orWhere('nama_pelanggan', 'LIKE', "%{$query}%")
        ->get();

    // Kembalikan partial view
    return view('owner.history', compact('transactions'))->render();
}

    


    private function generateUniqueNumber($length): string
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}
