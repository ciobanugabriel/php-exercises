<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $profilePictures = Photo::query()->where('is_profile_picture', '=', true)->get();

        $photos = Photo::query()->with('user')->where('is_profile_picture', '=', false)->orderByDesc('updated_at')->get();

        return view('home', ['user' => auth()->user(),
            'profilePictures' => $profilePictures,
            'photos' => $photos]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $image = request()->file('addInputImage');
        $description = request('addInputDescription');

        if (isset($image) && isset($description)) {
            $randomName = Str::random(30) . '.' . $image->extension();
            $image->storeAs('public/images/', $randomName);

            $photo = new Photo();
            $photo->name = $randomName;
            $photo->description = $description;
            $photo->user_id = auth()->user()->id;
            $photo->is_profile_picture = false;
            $photo->save();
        }
        return redirect()->route('home');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $photoID = request('editInputPhotoID');
        $newPhoto = request()->file('editInputImage');
        $description = request('editInputDescription');
        if (isset($photoID) && isset($description)) {
            if (isset($newPhoto)) {
                $randomName = Str::random(30) . '.' . $newPhoto->extension();
                $newPhoto->storeAs('public/images/', $randomName);
                Photo::query()->where('id', '=', $photoID)->update(['name' => $randomName, 'description' => $description]);
            } else {
                Photo::query()->where('id', '=', $photoID)->update(['description' => $description]);
            }
        }
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        $photoID = request('deleteInputPhotoID');

        if (isset($photoID)) {
            Photo::query()->where('id', '=', $photoID)->delete();
        }
        return redirect()->route('home');
    }
}
