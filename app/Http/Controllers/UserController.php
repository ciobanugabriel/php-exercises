<?php

namespace App\Http\Controllers;

use App\Mail\UserCreatedMail;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
    public function store(Request $request)
    {

        $password = request('password');
        $repeatPass = request('repeatPass');

        if ((request('password') & request('repeatPass')) && $password !== $repeatPass) {
            return view('create-account', ['errorMessage' => 'Passwords don`t match!']);
        }

        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'password' => 'required',
            'email' => 'required|email',
            'image' => 'image'
        ]);


        if (User::query()->where('name', '=', $validatedData['name'])->first()) {
            return view('create-account', ['errorMessage' => 'Username already exist!']);
        } else {
            $randomName = Str::random(30) . '.' . $request->file('image')->extension();
            $request->file('image')->storeAs('public/images/', $randomName);

            $user = User::query()->create(['name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password'],)
            ]);

            $photo = new Photo();
            $photo->name = $randomName;
            $photo->user_id = $user->id;
            $photo->is_profile_picture = true;
            $photo->save();
            $user->profile_photo_id = $photo->id;
            $user->save();

            //Mail::to($user)->send(new UserCreatedMail($user));
        }

        return redirect()->route('login');
    }

    public function create()
    {
        return view('create-account');
    }

}
