<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('login');
    }

    public function login()
    {
        $credentials = request()->validate([
            'name' => 'required',
            'password' => 'required',
        ]);
        if (auth()->attempt($credentials)) {
            session()->forget('errorMessage');
            return redirect()->route('home');
        } else {
            return view('login', ['errorMessage' => 'Wrong Credentials!']);
        }
    }


    public function logout(Request $request)
    {
        auth()->logout();
        return redirect()->route('login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $password = request('password');
        $repeatPass = request('repeatPass');

        if (isset($password) && isset($repeatPass)) {
            if ($password !== $repeatPass) {
                return view('create-account', ['errorMessage' => 'Passwords don`t match!']);
            }
        }

        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'password' => 'required',
        ]);

        if (User::query()->where('name', '=', $validatedData['name'])->first()) {
            return view('create-account', ['errorMessage' => 'Username already exist!']);
        } else {
            User::query()->create(['name' => $validatedData['name'],
                'password' => bcrypt($validatedData['password'])
            ]);
        }
        return redirect()->route('login');
    }

    public function showCreateAccount()
    {
        return view('create-account');
    }

}
