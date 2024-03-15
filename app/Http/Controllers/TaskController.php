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
        return response()->json(['message' => 'La liste des taches de ' . $user->name, 'Tasks' => $tasks]);
    }


    /**
     * Créer une nouvelle tache
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:tasks,name,NULL,id,user_id,' . $request->user()->id
        ]);
        $user = $request->user();
        $task = Task::create([
            'name' => $request->name,
            'user_id' => $user->id,
            'status' => 'pending',
        ]);
        if (!$task) {
            return response()->json(['error' => 'Erreur lors de la création de la tâche'], 500);
        }
        $tasks = $user->tasks;
        $this->saveTasksToFile($user, $tasks);
        return response()->json(['message' => 'Tâche créée avec succès', 'task' => $task], 201);
    }

    /**
     * Recuperer une tache precise.
     */
    public function show(string $id)
    {
        $task = Task::find($id);
        if ($task) {
            return response()->json(['message' => 'La tache :', 'task' => $task], 200);
        }

        return response()->json(['error' => 'Tâche non trouvée'], 404);
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

        $task = Task::find($id);

        if (!$task) {
            return response()->json(['error' => 'Tâche non trouvée'], 404);
        }

        $oldTaskData = $task->toArray();
        $task->update($request->all());

        $newTaskData = $task->toArray();

        $changesDetected = !empty(array_diff_assoc($oldTaskData, $newTaskData));
        if ($changesDetected) {

            $tasks = $this->loadTasksFromFile($user);
            foreach ($tasks as &$taskItem) {
                if ($taskItem['id'] == $id) {
                    $taskItem['name'] = $task->name;
                    $taskItem['status'] = $task->status;
                    break;
                }
            }
            $this->saveTasksToFile($user, $tasks);
            return response()->json(['message' => 'La tâche a été mise à jour avec succès', 'task' => $task], 200);
        }
        return response()->json(['message' => 'La tâche n\'a subi aucun changement'], 200);
    }

    /**
     * Supprimer une tache.
     */
    public function destroy(string $id)
    {
        $found = Task::find($id);
        if ($found) {
            $found->delete();
            $user = auth()->user();
            $tasks = $user->tasks;
            $this->saveTasksToFile($user, $tasks);
            return response()->json(['message' => 'Tâche supprimée avec succès']);
        }
        return response()->json(['message' => 'Tâche inexistante']);
    }
    /**
     * Recuperer les taches finies
     */
    public function finished_tasks(Request $request)
    {
        $user = $request->user();

        $finishedTasks = Task::where('user_id', $user->id)
            ->where('status', 'finished')
            ->get();
        if ($finishedTasks->isEmpty()) {
            return response()->json(['message' => 'Aucune tâche finie trouvée pour cet utilisateur'], 404);
        }
        return response()->json(['message' => 'Liste des taches finies de ' . $user->name, 'Tasks' => $finishedTasks]);
    }
    /**
     * Recuperer les taches en attente
     */
    public function pending_tasks(Request $request)
    {
        $user = $request->user();

        $pendingTasks = Task::where('user_id', $user->id)
            ->where('status', 'pending')
            ->get();
        if ($pendingTasks->isEmpty()) {
            return response()->json(['message' => 'Aucune tâche en attente trouvée pour cet utilisateur'], 404);
        }
        return response()->json(['message' => 'Liste des taches en attente de ' . $user->name, 'Tasks' => $pendingTasks]);
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
        if (!$task) {
            return response()->json(['error' => 'Tâche non trouvée'], 404);
        }
        $task->status = $task->status == 'pending' ? 'finished' : 'pending';
        $task->save();
        return response()->json([
            'message' => 'Statut de la tâche mis à jour avec succès',
            'ID task' => $task->id,
            'Statut tache' => $task->status

        ]);
    }
}
