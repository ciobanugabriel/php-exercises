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
        return view('home', ['username' => auth()->user()->name,
            'tasks' => Task::where('user_id', '=', auth()->user()->id)->get()]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $name = request('addInputName');
        $description = request('addInputDescription');

        if (isset($name) && isset($description)) {
            $newTask = new Task();
            $newTask->name = $name;
            $newTask->description = $description;
            $newTask->user_id = auth()->user()->id;
            $newTask->save();

        }
        return redirect()->route('home');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $taskID = request('editInputTaskID');
        $name = request('editInputName');
        $description = request('editInputDescription');

        if (isset($name) && isset($description) && isset($taskID)) {
            Task::where('id', '=', $taskID)->update(['name' => $name, 'description' => $description]);
        }
        return redirect()->route('home');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        $taskID = request('deleteInputTaskID');
        if (isset($taskID)) {
            Task::where('id', '=', $taskID)->delete();
        }
        return redirect()->route('home');
    }
}
