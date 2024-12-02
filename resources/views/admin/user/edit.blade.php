<!-- resources/views/admin/users/edit.blade.php -->
@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Edit User</h1>
    <form action="{{ route('admin.users.update', $users->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $users->name }}" required>
        </div>

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="{{ $users->username }}" required>
        </div>

        <div class="form-group">
            <label for="password">Password (Leave blank to keep current password)</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <select class="form-control" id="role" name="role" required>
                <option value="admin" {{ $users->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="kasir" {{ $users->role == 'kasir' ? 'selected' : '' }}>Cashier</option>
                <option value="owner" {{ $users->role == 'owner' ? 'selected' : '' }}>Owner</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Update User</button>
    </form>
</div>
@endsection
