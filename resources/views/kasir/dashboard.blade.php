@extends('kasir.layouts.app')

@section('content')
<style>
    .container {
        display: flex;
        gap: 16px;
        height: 100vh;
        overflow: hidden;
    }
    .product-grid {
        flex-grow: 1;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
        overflow-y: auto;
        padding-right: 8px;
    }
    .product-card {
    cursor: pointer;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 12px; /* Kurangi padding */
    text-align: center;
    background-color: #fff;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    max-width: 200px; /* Tambahkan batas lebar maksimum */
    margin: auto; /* Pastikan card terpusat */
    font-size: 0.9rem; /* Perkecil ukuran font */
}
.product-image img {
    width: 100%;
    height: 100px; /* Kurangi tinggi gambar */
    object-fit: cover;
    border-radius: 8px;
}

.product-card {
    cursor: pointer;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    text-align: center;
    background-color: #fff;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    width: 200px; /* Ukuran lebar tetap */
    height: 300px; /* Tambahkan ukuran tinggi tetap */
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    margin: auto;
    font-size: 0.9rem;
}


.product-image img {
        width: 100%;
        height: 120px;
        object-fit: cover;
        border-radius: 8px;
    }

    .product-name {
    font-weight: bold;
    margin-top: 8px;
    font-size: 0.95rem; /* Perkecil ukuran font */
}


.product-price, .product-stock {
    font-size: 0.85rem; /* Perkecil ukuran font */
}
    .product-stock {
        color: #4caf50;
    }
    .order-form {
        background-color: #f8f9fa;
        padding: 16px;
        width: 350px;
        border-radius: 8px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        max-height: 100%;
        overflow-y: auto;
    }
    .order-form-header {
        font-weight: bold;
        margin-bottom: 16px;
    }
    .order-table th, .order-table td {
        padding: 8px;
        border: 1px solid #ddd;
        text-align: left;
    }
    .order-total {
        text-align: right;
        font-weight: bold;
        margin-top: 16px;
    }
    .btn-add, .btn-minus, .btn-plus, .btn-bayar {
        background-color: #FF6347;
        color: #fff;
        padding: 4px 8px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 0.85rem; /* Perkecil ukuran font */
    }
    .btn-minus:hover, .btn-plus:hover, .btn-bayar:hover {
        background-color: #FF4500;
    }

    .input-group {
        max-width: 300px;
        margin-bottom: 20px;
    }
</style>


<form class="form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
    <div class="input-group">
        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
            aria-label="Search" aria-describedby="basic-addon2" id="search-input">
        <div class="input-group-append">
            <button class="btn btn-primary" type="button" id="search-button">
                <i class="fas fa-search fa-sm"></i>
            </button>
        </div>
    </div>
</form>

<script>
    document.getElementById("search-button").addEventListener("click", function() {
    searchProducts(); // Trigger the search function on button click
});

document.getElementById("search-input").addEventListener("keypress", function(event) {
    if (event.key === "Enter") {
        searchProducts(); // Trigger the search function on Enter key press
    }
});

function searchProducts() {
    let searchQuery = document.getElementById("search-input").value;

    $.ajax({
        url: "{{ route('kasir.search.product') }}", // Your route for searching products
        method: 'GET',
        data: { search: searchQuery },
        success: function(response) {
            // Clear the existing product grid
            $('.product-grid').empty();

            if (response.length > 0) {
                // Populate the product grid with the search results
                response.forEach(product => {
                    $('.product-grid').append(`
                        <div class="product-card">
                            <div class="product-image">
                                <img src="{{ Storage::url('${product.image}') }}" alt="${product.nama_produk}">
                            </div>
                            <h3 class="product-name">${product.nama_produk}</h3>
                            <p class="product-price">Rp${product.harga_produk.toLocaleString()}</p>
                            <p class="product-stock">Stock: ${product.stock}</p>
                            <button class="btn-add" onclick="addToOrder('${product.id}', '${product.nama_produk}', ${product.harga_produk}, ${product.stock})">
                                <i class="fas fa-shopping-cart"></i> Tambah
                            </button>
                        </div>
                    `);
                });
            } else {
                $('.product-grid').append('<p>No products found.</p>');
            }
        },
        error: function() {
            $('.product-grid').html('<p>An error occurred while searching.</p>');
        }
    });
}
</script>


<div class="container mx-auto p-4">
    <div class="product-grid">
        @foreach($products as $product)
        <div class="product-card">
            <div class="product-image">
                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->nama_produk }}">
            </div>
            <h3 class="product-name">{{ $product->nama_produk }}</h3>
            <p class="product-price">Rp{{ number_format($product->harga_produk, 0, ',', '.') }}</p>
            <p class="product-stock">Stock: {{ $product->stock }}</p>
            <button class="btn-add" onclick="addToOrder('{{ $product->id }}', '{{ $product->nama_produk }}', {{ $product->harga_produk }}, {{ $product->stock }})">
                <i class="fas fa-shopping-cart"></i> Tambah
            </button>
        </div>
        @endforeach
    </div>

    <div class="order-form">
        <h2 class="order-form-header">Keranjang</h2>
        <table class="w-full order-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody id="order-items">
                <!-- Items will be added here dynamically -->
            </tbody>
        </table>
        <div class="order-total">
            Total: Rp<span id="grand-total">0</span>
        </div>

        <div class="mt-4">
            <label for="nama_pelanggan">Nama Pelanggan:</label>
            <input type="text" id="nama_pelanggan" placeholder="Masukkan nama pelanggan" class="w-full p-2 mt-2 border rounded" />
        </div>

        <div class="mt-4">
            <label for="uang_bayar">Uang Dibayar:</label>
            <input type="number" id="uang_bayar" placeholder="Masukkan jumlah uang dibayar" class="w-full p-2 mt-2 border rounded" />
        </div>

        <button class="btn-bayar mt-4" onclick="handlePayment()">Bayar</button>
    </div>
</div>

<script>
    let orderList = [];
    let grandTotal = 0;

    function addToOrder(productId, productName, productPrice, productStock) {
        let existingOrder = orderList.find(item => item.id === productId);

        if (existingOrder) {
    if (existingOrder.quantity < productStock) {
        existingOrder.quantity += 1;
        existingOrder.total += productPrice;
    } else {
        alert("Stok tidak mencukupi untuk menambah item ini!");
        return;
    }
} else {
    if (productStock < 1) {
        alert("Produk ini habis!");
        return;
    }
    orderList.push({
        id: productId,
        name: productName,
        price: productPrice,
        quantity: 1,
        total: productPrice,
        stock: productStock
    });
}


        renderOrderItems();
    }

    function renderOrderItems() {
        const orderItems = document.getElementById("order-items");
        orderItems.innerHTML = ''; // Clear previous content

        grandTotal = 0; // Reset grand total

        orderList.forEach(item => {
            grandTotal += item.total;

            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${item.name}</td>
                <td>Rp${item.price.toLocaleString('id-ID')}</td>
                <td>
                    <button class="btn-minus" onclick="updateQuantity('${item.id}', -1)">-</button>
                    ${item.quantity}
                    <button class="btn-plus" onclick="updateQuantity('${item.id}', 1)">+</button>
                </td>
                <td>Rp${item.total.toLocaleString('id-ID')}</td>
            `;
            orderItems.appendChild(row);
        });

        document.getElementById("grand-total").textContent = grandTotal.toLocaleString('id-ID');
    }

    function updateQuantity(productId, change) {
        const item = orderList.find(order => order.id === productId);
        if (!item) return;

        item.quantity += change;
        if (item.quantity <= 0) {
            orderList = orderList.filter(order => order.id !== productId);
        } else if (item.quantity > item.stock) {
            item.quantity -= change;
            alert("Stok tidak mencukupi!");
        } else {
            item.total = item.quantity * item.price;
        }

        renderOrderItems();
    }

    function handlePayment() {
    const amountPaid = parseInt(document.getElementById("uang_bayar").value);
    const customerName = document.getElementById("nama_pelanggan").value;
    const change = amountPaid - grandTotal;

    if (!customerName) {
        alert("Nama pelanggan harus diisi!");
        return;
    }

    if (amountPaid < grandTotal) {
        alert("Uang yang dibayar tidak cukup!");
        return;
    }

    const orderData = {
        nama_pelanggan: customerName,
        total_amount: grandTotal,
        uang_bayar: amountPaid,
        uang_kembali: change,
        id_produk: orderList.map(item => item.id),
        qty: orderList.map(item => item.quantity)
    };

    fetch("{{ route('kasir.transaksi.store') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify(orderData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Transaksi berhasil! Kembalian: Rp" + change.toLocaleString('id-ID'));
            orderList = [];
            grandTotal = 0;
            renderOrderItems();
            document.getElementById("uang_bayar").value = '';
            document.getElementById("nama_pelanggan").value = '';
        } else {
            alert(data.error);
        }
    })
    .catch(error => {
        alert("Terjadi kesalahan: " + error.message);
    });
}

</script>
@endsection
