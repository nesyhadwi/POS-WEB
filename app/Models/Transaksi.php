<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    public function details()
    {
        return $this->hasMany(TransaksiDetails::class, 'id_transactions'); // Define the relationship
    }

    protected $table = 'transactions'; // Nama tabel sesuai dengan database

    protected $fillable = [
        'nama_pelanggan',
        'nomor_unik',
        'uang_bayar',
        'uang_kembali',
        'total_amount',
        'created_at',
    ];

    public $timestamps = true;
}
