<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, Task $task)
    {
        $allTasks = $task->whereIn('user_id', $request->user())->with('user');
        $tasks = $allTasks->orderBy('created_at', 'desc')->take(20)->get();

        return response()->json([
            'tasks' => $tasks
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //validate
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);
        //create a new task 
        $task = $request->user()->tasks()->create([
            'name' => $request->name,
        ]);

        //return task with user object
        return response()->json($task->with('user')->find($task->id));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
