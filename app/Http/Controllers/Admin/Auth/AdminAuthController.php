<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }
    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $user = Auth::guard('admin')->user();

            // Check role and redirect accordingly
            if ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard')->with('success', 'Admin login successful');
            } elseif ($user->hasRole('manager')) {
                return redirect()->route('manager.dashboard')->with('success', 'Manager login successful');
            } elseif ($user->hasRole('salesperson')) {
                return redirect()->route('sales.dashboard')->with('success', 'Salesperson login successful');
            } else {
                Auth::guard('admin')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('admin.login')->withErrors('Unauthorized Role');
            }
        }

        return redirect()->route('admin.login')->withErrors('Invalid Credentials');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('status', 'Successfully logged out.');
    }
}
