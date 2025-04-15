<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed, redirect to the success page
            return Redirect::to('/login-success');
        }

        // Authentication failed, redirect back with an error message
        return redirect()->back()->withErrors(['error' => 'Invalid credentials']);
    }
}
