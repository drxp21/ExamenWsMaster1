<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)

    {
        return $request->user()->tasks;
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:tasks,name'
        ]);
        $user = $request->user();
        $task = Task::create([
            'name' => $request->name,
            'user_id' => $user->id,
            'status' => 'pending',
        ]);
        return $task;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Task::find($id);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required'
        ]);
        Task::find($id)->update($request->all());
        return Task::find($id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Task::find($id)->delete();
    }

    /**
     * Toggle the current status of the task.
     */
    public function toggle_status(string $id)
    {
        $task = Task::find($id);
        $task->status = $task->status == 'pending' ? 'finished' : 'pending';
        $task->save();
        return $task;
    }
}
