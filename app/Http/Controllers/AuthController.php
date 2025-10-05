<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    //register----------

    public function register()
    {
        return view('auth.register');
    }

    //register Store-------
    public function registerStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|max:16',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $existendUser = User::latest()->get();

        if ($existendUser->isEmpty()) {
            $user->role = 'admin';
        } else {
            $user->role = 'user';
        }

        $user->save();

        Auth::login($user);
        // flash()->success('Regostration successfully!');
        return redirect('/');
    }


    //login------------
    public function login()
    {
        return view('auth.login');
    }

    //loginStore------------
    public function loginStore(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|max:16',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();
            // flash()->success('Login successfully!');
            return redirect()->intended('/');
        };

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
