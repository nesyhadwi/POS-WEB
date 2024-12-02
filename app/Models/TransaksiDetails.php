<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetails extends Model
{
    // Tentukan nama tabel yang sesuai
    protected $table = 'transactions_details';

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transactions');
    }

    protected $fillable = [
        'id_transactions', 'id_product', 'qty', 'price'
    ];

    // Relasi dengan produk
    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }
}

