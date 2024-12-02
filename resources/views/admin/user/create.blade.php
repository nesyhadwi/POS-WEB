<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restauran App</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f8; /* Warna latar belakang pastel */
        }

        .container {
            margin-top: 50px;
            max-width: 500px; /* Ukuran maksimal container */
            background-color: #ffffff; /* Warna latar belakang form */
            border-radius: 8px; /* Sudut membulat */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Bayangan halus */
            padding: 20px; /* Padding di dalam container */
        }

        h1 {
            color: #4a4a4a; /* Warna teks judul */
            margin-bottom: 20px; /* Margin bawah judul */
        }

        .form-group {
            margin-bottom: 15px; /* Margin bawah untuk setiap grup form */
        }

        label {
            font-weight: bold; /* Menebalkan teks label */
            color: #6c757d; /* Warna label pastel */
        }

        input[type="text"],
        input[type="password"],
        select {
            width: 100%; /* Lebar input 100% dari container */
            padding: 10px; /* Padding dalam input */
            border: 1px solid #ced4da; /* Border halus */
            border-radius: 5px; /* Sudut membulat pada input */
            transition: border-color 0.3s; /* Transisi saat fokus */
        }

        input[type="text"]:focus,
        input[type="password"]:focus,
        select:focus {
            border-color: #80bdff; /* Warna border saat fokus */
            outline: none; /* Menghilangkan outline default */
        }

        .btn-primary {
            background-color: #a5d8e0; /* Warna tombol pastel */
            color: #fff; /* Warna teks tombol */
            border: none; /* Menghilangkan border */
            padding: 10px 15px; /* Padding tombol */
            border-radius: 5px; /* Sudut membulat pada tombol */
            cursor: pointer; /* Pointer saat hover */
            transition: background-color 0.3s; /* Transisi saat hover */
        }

        .btn-primary:hover {
            background-color: #84c2d1; /* Warna latar belakang saat hover */
        }

        .btn-block {
            width: 100%; /* Lebar tombol 100% */
        }
    </style>
</head>
<body>
    <!-- resources/views/admin/users/create.blade.php -->
@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Add New User</h1>
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <select class="form-control" id="role" name="role" required>
                <option value="admin">Admin</option>
                <option value="kasir">Cashier</option>
                <option value="owner">Owner</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Add User</button>
    </form>
</div>
@endsection

</body>
</html>
