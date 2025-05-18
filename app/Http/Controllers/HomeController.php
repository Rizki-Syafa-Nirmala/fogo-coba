<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Agent $agent)
    {
        $isDesktop = $agent->isDesktop();

        // Belum login (guest)
        if (! Auth::check()) {
            if ($isDesktop) {
                // Redirect ke login Filament
                return view('guest.home');
            } else {
                // Redirect ke landing page guest
                return redirect()->route('filament.user.auth.login');
            }
        }else {

        }

        // Sudah login
        return view('welcome');
    }
}
