@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Edit User</h1>
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama_produk">Product Name</label>
            <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="{{ old('nama_produk', $product->nama_produk) }}" required>
        </div>

        <div class="form-group">
            <label for="kategori">Category</label>
            <select class="form-control" id="kategori" name="kategori" required>
                <option value="makanan" {{ old('kategori', $product->kategori) == 'makanan' ? 'selected' : '' }}>Makanan</option>
                <option value="minuman" {{ old('kategori', $product->kategori) == 'minuman' ? 'selected' : '' }}>Minuman</option>
            </select>
        </div>

        <div class="form-group">
            <label for="jenis">Type</label>
            <input type="text" class="form-control" id="jenis" name="jenis" value="{{ old('jenis', $product->jenis) }}" required>
        </div>

        <div class="form-group">
            <label for="harga_produk">Product Price</label>
            <input type="text" class="form-control" id="harga_produk" name="harga_produk" value="{{ old('harga_produk', $product->harga_produk) }}" required>
        </div>

        <div class="form-group">
            <label for="stock">Product Stock</label>
            <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" required>
        </div>

        <div class="form-group">
            <label for="image">Product Image</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>

        <button type="submit" class="btn btn-primary btn-block">Update Product</button>
    </form>
</div>
@endsection
