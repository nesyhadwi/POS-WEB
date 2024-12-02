<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Mendapatkan data pengguna yang sedang login
        $user = Auth::user();
        
        // Mengirim data pengguna ke view
        return view('admin.dashboard', compact('user'));
    }
}
