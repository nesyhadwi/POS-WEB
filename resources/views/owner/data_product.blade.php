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

<!-- Search bar -->
<form class="form-inline">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Search for products..." id="search-input">
        <div class="input-group-append">
            <button class="btn btn-primary" type="button" id="search-button">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
</form>

<div class="container">
    <h3>Product List</h3>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Jenis</th>
                <th>Stock</th>
                <th>Price</th>
                <th>Image</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody id="productTable">
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->nama_produk }}</td>
                <td>{{ $product->kategori }}</td>
                <td>{{ $product->jenis }}</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->harga_produk }}</td>
                <td>
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" width="60" height="60">
                    @else
                        No Image
                    @endif
                </td>
                <td>{{ $product->created_at->format('d M Y, H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- AJAX Script to Handle Real-Time Search -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#search-input').on('keyup', function () {
            let search = $(this).val();

            $.ajax({
                url: "{{ route('owner.search.product') }}",
                method: 'GET',
                data: { search: search },
                success: function (response) {
                    // Clear the existing table rows
                    $('#productTable').empty();

                    if (response.length > 0) {
                        // Populate the table with the search results
                        response.forEach(product => {
                            let imageHTML = product.image ? `<img src="/storage/${product.image}" alt="Product Image" width="60" height="60">` : 'No Image';
                            let createdAt = new Date(product.created_at).toLocaleString();

                            $('#productTable').append(`
                                <tr>
                                    <td>${product.nama_produk}</td>
                                    <td>${product.kategori}</td>
                                    <td>${product.jenis}</td>
                                    <td>${product.stock}</td>
                                    <td>${product.harga_produk}</td>
                                    <td>${imageHTML}</td>
                                    <td>${createdAt}</td>
                                </tr>
                            `);
                        });
                    } else {
                        // Show a message if no results are found
                        $('#productTable').append('<tr><td colspan="8">No products found.</td></tr>');
                    }
                },
                error: function () {
                    $('#productTable').html('<tr><td colspan="8">An error occurred while searching.</td></tr>');
                }
            });
        });
    });
</script>

@endsection
