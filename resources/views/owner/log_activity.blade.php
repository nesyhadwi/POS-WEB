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
<div class="container">
    <h3 style="font-weight: bold; margin: 10px;">Log Activity</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID User</th>
                <th>Tanggal Login</th>
                <th>Tanggal Logout</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
            <tr>
                <td>{{ $log->id_user }}</td>
                <td>{{ $log->tanggal_login }}</td>
                <td>{{ $log->tanggal_logout }}</td>
                <td>{{ $log->role }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Menampilkan pagination -->
    <div class="d-flex justify-content-center">
        <div class="pagination">
            {{ $logs->links() }}
        </div>
    </div>
</div>
@endsection
