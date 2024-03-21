<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function login()
    {
        return view('auths/login');
    }

    public function register()
    {
        return view('auths/register');
    }

    public function loginProcess(Request $request)
    // {
    //     $credentials = $request->validate([
    //         'email' => ['required'],
    //         'password' => ['required'],
    //     ]);
 
    //     if (Auth::attempt($credentials)) {

    //         $request->session()->regenerate();
    //         if (Auth::user()->role_id == 1) {
    //             return redirect('/dashboard');
    //         }

    //         if (Auth::user()->role_id == 2) {
    //             return redirect('/dashboard');
    //         }
    //     }

    //     Session::flash('status', 'failed');
    //     Session::flash('message', 'Login invalid');
    //     return redirect('/login')->with('success', 'Success update data');;
    // }
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role_id == 5) {

                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                Session::flash('status', 'failed');
                Session::flash('message', 'Akun anda belum disetujui admin, hubungi admin untuk konfirmasi akun anda!');
                return redirect('/login');
            }
 
            return redirect()->intended('/dashboard');
        }

        Session::flash('status', 'failed');
        Session::flash('message', 'Login Wrong!');

        return redirect('/login');
    }

    public function registerProcess(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);

        if ($request->file('image')) {
            $fileName = $this->generateRandomString();
            $extension = $request->file('image')->extension();
            $image = $fileName.'.'.$extension;
            Storage::putFileAs('images', $request->file('image'), $image);
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = 5;
        $user->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Register sukses, hubungi admin untuk konfirmasi akun anda');
        return redirect('/register');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
