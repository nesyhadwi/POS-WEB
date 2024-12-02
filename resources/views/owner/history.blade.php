@extends('owner.layouts.app')

<style>
    /* Pagination style */
    .pagination svg {
        display: none; /* Menyembunyikan ikon SVG */
    }

    .pagination li {
        margin: 0 2px; /* Atur margin antar elemen pagination */
    }

    .pagination li a,
    .pagination li span {
        font-size: 14px; /* Atur ukuran font */
        padding: 8px 12px; /* Padding pada elemen */
        border-radius: 4px; /* Membulatkan sudut */
        text-decoration: none; /* Hilangkan garis bawah */
        color: #007bff; /* Warna teks */
    }

    .pagination li.active span {
        background-color: #007bff; /* Warna background untuk elemen aktif */
        color: #fff; /* Warna teks elemen aktif */
    }

    .pagination li a:hover {
        background-color: #0056b3; /* Warna background saat hover */
        color: #fff; /* Warna teks saat hover */
    }

    /* Table styling */
    .table {
        margin-top: 20px;
        background: #f8f9fa; /* Light gray */
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .table th {
        background-color: #343a40;
        color: white;
        font-size: 14px;
        text-align: center;
        padding: 12px;
    }

    .table td {
        font-size: 13px;
        padding: 10px;
        text-align: center;
    }

    .table-actions button,
    .table-actions a {
        margin: 2px;
    }

    .table-actions .btn-warning {
        background-color: #ffc107;
        color: black;
        border: none;
    }

    .table-actions .btn-danger {
        background-color: #dc3545;
        color: white;
        border: none;
    }

    /* Search bar styling */
    .input-group {
        width: 50%;
        margin: 20px auto;
    }

    .input-group .form-control {
        border-radius: 0;
        box-shadow: none;
        font-size: 14px;
    }

    .input-group-append .btn {
        background-color: #007bff;
        color: white;
        font-size: 14px;
        border: none;
    }

    .input-group-append .btn:hover {
        background-color: #0056b3;
    }

    /* Header styling */
    .container h3 {
        text-align: center;
        margin-top: 20px;
        font-weight: bold;
        font-size: 22px;
        color: #343a40;
    }

    /* Add product button */
    .btn-primary {
        background-color: #007bff;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>

@section('content')
<form class="form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
    <div class="input-group">
        <input type="text" id="searchInput" class="form-control bg-light border-0 small" placeholder="Search by Nomor Unik..."
               aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-primary" type="button">
                <i class="fas fa-search fa-sm"></i>
            </button>
        </div>
    </div>
</form>

<div class="container">
    <h3>Riwayat Transaksi</h3>

    <table class="table table-bordered table-hover" id="transactionTable">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Nomor Unik</th>
                <th>Total Amount</th>
                <th>Uang Bayar</th>
                <th>Uang Kembali</th>
                <th>Qty</th> <!-- Kolom untuk Qty -->
                <th>Nama Produk</th> <!-- Kolom untuk Nama Produk -->
                <th>Tanggal Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transactions as $index => $transaction)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $transaction->nama_pelanggan }}</td>
                    <td>{{ $transaction->nomor_unik }}</td>
                    <td>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($transaction->uang_bayar, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($transaction->uang_kembali, 0, ',', '.') }}</td>
                    <td>
                        @foreach ($transaction->details as $detail)
                            {{ $detail->qty }}<br> <!-- Hanya menampilkan Qty -->
                        @endforeach
                    </td>
                    <td>
                        @foreach ($transaction->details as $detail)
                            {{ $detail->product->nama_produk }}<br> <!-- Menampilkan Nama Produk -->
                        @endforeach
                    </td>
                    <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('d-m-Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">Tidak ada riwayat transaksi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>


@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Ketika pengguna mengetikkan di input pencarian
        $('#searchInput').on('keyup', function () {
            var query = $(this).val(); // Ambil nilai dari input pencarian

            // Kirim request AJAX ke server untuk mendapatkan hasil pencarian
            $.ajax({
                url: "{{ route('owner.search.transaction') }}", // Route untuk pencarian
                type: "GET",
                data: { search: query }, // Kirimkan query pencarian ke server
                success: function (data) {
                    // Update tabel dengan hasil pencarian
                    $('#transactionTable tbody').html(data);
                },
                error: function (xhr) {
                    console.error("Error: ", xhr.responseText);
                }
            });
        });
    });
</script>
@endsection
@endsection
