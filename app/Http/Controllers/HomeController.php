<?php

namespace App\Http\Controllers;

use Domain\Enums\UserRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        if ($user && $user->role === UserRoles::ADMIN) {
            return redirect('admin');
        }

        return view('home');
    }
}
