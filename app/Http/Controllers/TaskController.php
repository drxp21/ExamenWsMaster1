<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    /**
     * Display all tasks.
     */
    public function index()
    {
        $user = auth()->user();
        $tasks = $this->loadTasksFromFile($user);
        return response()->json($tasks);
        //return response()->json(request()->user()->tasks);
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
        $tasks = $user->tasks;
        $this->saveTasksToFile($user, $tasks);
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
        $user = $request->user();

        $task = Task::find($id);
        if (!$task) {
            return response()->json(['message' => 'Tâche non trouvée'], 404);
        }
        $task->name = $request->name;
        $task->status = $request->status;
        $task->save();

        $tasks = $this->loadTasksFromFile($user);

        foreach ($tasks as &$taskItem) {
            if ($taskItem['id'] == $id) {
                $taskItem['name'] = $task->name;
                $taskItem['status'] = $task->status;
                break;
            }
        }
        $this->saveTasksToFile($user, $tasks);
        return response()->json($task, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Task::find($id)->delete();
        $user = auth()->user();
        $tasks = $user->tasks;
        $this->saveTasksToFile($user, $tasks);
        return response()->json(['message' => 'Tache supprimee avec success']);
    }

    public function findMyTask()
    {
        return response()->json(auth()->user()->tasks);
    }

    public function loadUserTasks(Request $request)
    {
        $user = $request->user();
        $tasks = $this->loadTasksFromFile($user);
        return response()->json($tasks);
    }

    private function loadTasksFromFile($user)
    {
        $tasksJson = Storage::disk('local')->get('tasks_' . $user->id . '.json');
        return json_decode($tasksJson, true);
    }

    private function saveTasksToFile($user, $tasks)
    {
        $tasksJson = json_encode($tasks);
        Storage::disk('local')->put('tasks_' . $user->id . '.json', $tasksJson);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        $response = [
            'message' => 'Déconnexion réussie'
        ];

        return $response;
    }
}
