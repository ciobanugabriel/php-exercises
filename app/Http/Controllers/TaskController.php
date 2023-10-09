<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $username = $request->session()->get('username');
        if (!isset($username)) {
            return redirect()->route('login');
        } else {
            $tasks = Task::where('user_id', '=', User::where('name', '=', $username)->first()->id)->get();
            return view('home', ['username' => $username, 'tasks' => $tasks]);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $name = $request->input('addInputName');
        $user = User::where('name', '=', $request->session()->get('username'))->first();
        $description = $request->input('addInputDescription');
        if (isset($name) && isset($description)) {
            $newTask = new Task();
            $newTask->name = $name;
            $newTask->description = $description;
            $newTask->user_id = $user->id;
            $newTask->save();

        }
        return redirect()->route('home');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $taskID = $request->input('editInputTaskID');
        $name = $request->input('editInputName');
        $description = $request->input('editInputDescription');

        if (isset($name) && isset($description) && isset($taskID)) {
            Task::where('id', '=', $taskID)->update(['name' => $name, 'description' => $description]);
        }
        return redirect()->route('home');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $taskID = $request->input('deleteInputTaskID');
        if (isset($taskID)) {
            Task::where('id', '=', $taskID)->delete();
        }
        return redirect()->route('home');
    }
}
