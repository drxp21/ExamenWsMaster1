<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    /**
     * Recuperer la liste des taches d'un utilisateur
     */
    public function index()
    {
        $user = auth()->user();
        $tasks = $this->loadTasksFromFile($user);
        return response()->json($tasks);
    }


    /**
     * Créer une nouvelle tache
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
     * Recuperer une tache precise.
     */
    public function show(string $id)
    {
        return Task::find($id);
    }

    /**
     * Modifier une tache
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $user = $request->user();

        $task = Task::findOrFail($id)->update($request->all());

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
     * Supprimer une tache.
     */
    public function destroy(string $id)
    {
        Task::find($id)->delete();
        $user = auth()->user();
        $tasks = $user->tasks;
        $this->saveTasksToFile($user, $tasks);
        return response()->json(['message' => 'Tache supprimée avec succès']);
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



    /**
     * Marquer une tache comme finie ou comme non finie.
     */
    public function toggle_status(string $id)
    {
        $task = Task::find($id);
        $task->status = $task->status == 'pending' ? 'finished' : 'pending';
        $task->save();
        return $task;
    }
}
