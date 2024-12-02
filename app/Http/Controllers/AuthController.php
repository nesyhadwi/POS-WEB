<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('login');
    }

    // Handle the login request
    public function login(Request $request)
    {
        // Validate the request inputs
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Retrieve the user by username
        $user = User::where('username', $request->username)->first();

        // Check if the user exists and the password matches
        if ($user && $user->password === $request->password) {
            // Log the user in
            Auth::login($user);

            // Simpan tanggal login ke database
            DB::table('log')->insert([
                'id_user' => $user->id,
                'tanggal_login' => now(),
                'tanggal_logout' => null, // Set null karena user masih login
                'role' => $user->role,
            ]);

            // Redirect the user based on their role
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'kasir':
                    return redirect()->route('kasir.dashboard');
                case 'owner':
                    return redirect()->route('owner.dashboard');
                default:
                    return redirect()->route('dashboard.index');
            }
        }

        // If the login attempt fails, throw an authentication exception
        throw new AuthenticationException('Invalid credentials');
    }

    // Handle logout
    public function logout(Request $request)
    {
        // Dapatkan user yang sedang login
        $user = Auth::user();
        
        // Cek jika user ada
        if ($user) {
            // Simpan tanggal logout ke database
            DB::table('log')
                ->where('id_user', $user->id)
                ->whereNull('tanggal_logout') // Pastikan kita hanya memperbarui catatan yang belum logout
                ->update([
                    'tanggal_logout' => now(), // Menyimpan waktu saat ini
                ]);
        }

        // Logout user
        Auth::logout();
        
        // Redirect ke halaman login atau halaman lain
        return redirect('/')->with('success', 'You have been logged out successfully!');
    }
}
