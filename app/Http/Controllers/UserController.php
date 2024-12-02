<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // Display a list of users
    public function index(){

        $users = User::paginate(10);
        return view('admin.data_users', compact('users'));
    }

    // Show the form for creating a new user
    public function create(){
        return view('admin.user.create');
    }

    // Store a newly created user in the database without hashing the password
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|string'
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => $request->password, // Save the password directly
            'role' => $request->role
        ]);

        return redirect()->route('admin.data_users')->with('success', 'User added successfully.');
    }

    // Show the form for editing the specified user
    public function edit($id){
        $users = User::findOrFail($id);
        return view('admin.user.edit', compact('users'));
    }

    // Update the specified user in the database without hashing the password
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'role' => 'required|string'
        ]);

        $users = User::findOrFail($id);
        $users->update([
            'name' => $request->name,
            'username' => $request->username,
            'role' => $request->role
        ]);

        if ($request->filled('password')) {
            $users->update([
                'password' => $request->password // Save the password directly
            ]);
        }

        return redirect()->route('admin.data_users')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
{
    // Find the user by ID
    $users = User::findOrFail($id);
    
    // Delete the user
    $users->delete();

    // Redirect to the users list with a success message
    return redirect()->route('admin.data_users')->with('success', 'User deleted successfully!');
}

public function logAktivitas()
{
    $logs = DB::table('log')
                ->join('users', 'log.id_user', '=', 'users.id')
                ->select('log.id', 'log.id_user', 'log.tanggal_login', 'log.tanggal_logout', 'log.role')
                ->orderBy('log.tanggal_login', 'desc') // Urutan DESC berdasarkan tanggal_login
                ->paginate(10);
                
    return view('admin.log_activity', compact('logs'));
}


public function searchUser(Request $request)
{
    $search = $request->input('search');

    // Query to search users by 'id' or 'username'
    $users = DB::table('users')
        ->where('id', 'like', '%' . $search . '%') // Search by partial ID
        ->orWhere('username', 'like', '%' . $search . '%') // Search by username (partial match)
        ->orWhere('name', 'like', '%' . $search . '%') // Optionally search by user name
        ->get();

    return response()->json($users);
}

}
