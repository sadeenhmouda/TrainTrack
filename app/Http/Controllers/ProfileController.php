<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user() ?? (object)[
            'full_name' => session('fullName') ?? 'Guest User',
            'email' => session('email') ?? 'guest@example.com',
            'avatar' => session('avatar') ?? null,
        ];

        return view('traintrack.profile', compact('user'));
    }
}
