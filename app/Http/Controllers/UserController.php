<?php

namespace App\Http\Controllers;

use App\Models\cr;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!session()->has('userid')) {
            redirect('/login')->send();
        }
        $users = User::all();
        return view('user', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => [
                'required',
                Password::min(8) // Minimum 8 characters
                    ->mixedCase() // Must include uppercase and lowercase
                    ->letters() // Must include at least one letter
                    ->numbers() // Must include at least one number
                    ->symbols() // Must include at least one symbol
            ],
        ]);
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();
        return redirect()->route('user.index')->with('success', 'User created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        
        if (!session()->has('user_id')) {
            redirect('/login')->send();
        }
        $ids = base64_decode($id);
        $edituser = User::where('id', $ids)->first();
        $users = User::all();
        return view('user', compact('edituser', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => [
                'nullable',
                Password::min(8) // Minimum 8 characters
                    ->mixedCase() // Must include uppercase and lowercase
                    ->letters() // Must include at least one letter
                    ->numbers() // Must include at least one number
                    ->symbols() // Must include at least one symbol
            ]
        ]);

        $user = User::where('id', $id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect()->route('user.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->first();
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User deleted successfully');
    }
}
