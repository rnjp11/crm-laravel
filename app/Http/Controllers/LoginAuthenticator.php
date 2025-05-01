<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginAuthenticator extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function demo(Request $request)
    {
        $password = "Riya@123";
        // $passwordhash = '$2y$10$TLVbXb6a5B2VfAJKzU6Iru0RQjS/P5zRzV1ADvJ1Bf1Vrg82ZsKiC';

        dd(Hash::make($password));
    }
    public function loginCheck(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = DB::table('users')->where('email', $email)->first();

        if ($user && Hash::check($password, $user->password)) {
            session([
                'userid' => $user->id,
                'username' => $user->name,
                'useremail' => $user->email,
                'roleid' => $user->role_id
            ]);
            return redirect()->route('dashboard');
        } else {
            return back()->with('error', 'Invalid Email or Password');
        }
    }
    public function logout(Request $request)
    {
        $request->session()->flush();

        return redirect('/login')->with('success', 'You have been logged out.');
    }
}
