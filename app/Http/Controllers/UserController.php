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
        $username = $request->getSession()->get('username');
        if (isset($username)) {
            return redirect()->route('home');
        } else {
            return view('login');
        }
    }

    public function login(Request $request)
    {

        $username = $request->input('username');
        $password = $request->input('password');

        if (isset($username) && isset($password)) {
            $user = User::where('name', '=', $username)->where('password', '=', $password)->first();
            if (isset($user)) {
                $request->session()->put('username', $username);
                $request->session()->forget('errorMessage');
                return redirect()->route('home');
            }
        }
        return view('login', ['errorMessage' => 'Wrong Credentials!']);
    }


    public function logout(Request $request)
    {
        $request->session()->forget('username');
        return redirect()->route('login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $repeatPass = $request->input('repeatPass');

        if (isset($username)) {
            $user = User::query()->where('name', '=', $username)->first();
        } else {
            return redirect()->route('show_create_account');
        }

        if (isset($password) && isset($repeatPass)) {
            if ($password !== $repeatPass) {
                return view('create_account', ['errorMessage' => 'Passwords don`t match!']);
            }
        }

        if (isset($user)) {
            return view('create_account', ['errorMessage' => 'Username already exist!']);
        } else {
            $newUser = new User();
            $newUser->name = $username;
            $newUser->password = $request->input('password');
            $newUser->save();
            return redirect()->route('login');
        }
    }

    public function showCreateAccount()
    {
        return view('create_account');
    }

}
