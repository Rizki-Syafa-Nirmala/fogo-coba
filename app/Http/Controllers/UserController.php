<?php

namespace App\Http\Controllers;

use Jenssegers\Agent\Agent;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{


    protected $agent;

    public function __construct()
    {
        $this->agent = new Agent();
    }

    public function indexprofile()
    {
        return view('user.setting.profile');
    }

    public function indexakun()
    {
        return view('user.setting.akun');
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
        if($this->agent->isMobile()){
             // Validate the request
            $request->validate([
                'current_password' => ['required', 'string'],
                'new_password' => [
                    'required',
                    'string',
                    'min:8',
                    'confirmed',
                    'different:current_password',
                    Password::min(7)
                        // ->mixedCase()
                        // ->numbers()
                        // ->symbols()
                        ->uncompromised(),
                ],
                'new_password_confirmation' => ['required', 'string'],
            ], [
                'current_password.required' => 'password sebelumnya harus diisi',
                'new_password.required' => 'password baru harus diisi',
                'new_password.min' => 'password baru harus memiliki minimal 8 karakter',
                'new_password.confirmed' => 'password baru harus sama dengan konfirmasi passwor',
                'new_password.different' => 'password baru tidak boleh sama dengan password sebelumnya',
                'new_password.mixedCase' => 'password baru harus memiliki huruf besar dan kecil',
                // 'new_password.numbers' => 'New password must contain at least one number.',
                // 'new_password.symbols' => 'New password must contain at least one special character.',
                'new_password.uncompromised' => 'password baru telah digunakan sebelumnya',
                'new_password_confirmation.required' => 'konfirmasi password harus diisi',
            ]);

            $user = Auth::user();

            // Check if current password is correct
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors([
                    'current_password' => 'password sebelumnya tidak cocok'
                ])->withInput();
            }

            // Update the password
            $user->update([
                'password' => Hash::make($request->new_password)
            ]);

            // Log the user out from other devices (optional)
            // Auth::logoutOtherDevices($request->new_password);

            return back()->with('success', 'Password berhasil diubah.');
        }
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
