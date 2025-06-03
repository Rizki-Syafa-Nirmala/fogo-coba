<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function indexprofile()
    {
        return view('user.profile');
    }

    public function indexakun()
    {
        return view('user.akun');
    }


    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi
        $validated = $request->validate([
            'first_name'       => 'required|string|max:255',
            'last_name'        => 'nullable|string|max:255',
            'email'            => 'nullable|email|unique:users,email,' . $user->id,
            'phone'            => 'nullable|string|max:20',
            'address'          => 'nullable|string|max:255',
            'profile_picture'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Cek dan simpan gambar baru jika diunggah
        if ($request->hasFile('profile_picture')) {
            // Hapus gambar lama jika ada
            if ($user->profpic && Storage::exists('public/' . $user->profpic)) {
                Storage::delete('public/' . $user->profpic);
            }

            // Simpan gambar baru
            $path = $request->file('profile_picture')->store('profile_picture', 'public');
            $user->profpic = $path;
        }

        // Update field lain
        $user->name = $validated['first_name'];
        $user->last_name  = $validated['last_name'] ?? null;
        $user->email      = $validated['email'] ?? null;
        $user->no_telp     = $validated['phone'] ?? null;
        $user->alamat    = $validated['address'] ?? null;

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');

    }

    public function updatePassword(Request $request)
    {
        // Mendapatkan user yang sedang login
        $user = Auth::user();

        // Validasi input form
        $request->validate([
            'current-password' => 'required|string', // Password lama harus diisi
            'new-password' => 'required|string|min:6', // Password baru harus memiliki minimal 6 karakter dan konfirmasi
        ]);

        // Verifikasi password lama
        $currentPasswordStatus = Hash::check($request->input('current-password'), $user->password);

        if ($currentPasswordStatus) {
            // Update password jika password lama valid
            $user->update([
                'password' => Hash::make($request->input('new-password')),
            ]);

            // Redirect dengan pesan sukses
            return redirect()->back()->with('swalMessage', [
                'title' => 'Success!',
                'text' => 'Password Updated Successfully.',
                'icon' => 'success',
            ]);
        } else {
            // Password lama tidak cocok
            return redirect()->back()->with('swalMessage', [
                'title' => 'Error!',
                'text' => 'Current Password does not match with Old Password.',
                'icon' => 'error',
            ]);
        }
    }


    public function deleteAccount(Request $request)
    {
        $user = Auth::user();

        Auth::logout();
        $user->delete();

        return redirect('/')->with('success', 'Akun berhasil dihapus.');
    }
}
