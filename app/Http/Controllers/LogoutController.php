<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
        /**
     * Log the user out.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout(); // Proses logout
        $request->session()->invalidate(); // Hapus sesi yang aktif
        $request->session()->regenerateToken(); // Regenerasi token CSRF

        return redirect('/'); // Arahkan pengguna ke halaman utama setelah logout
    }
}
