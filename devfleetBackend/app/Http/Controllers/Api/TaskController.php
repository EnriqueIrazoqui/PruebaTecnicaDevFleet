<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\createTask;
use App\Http\Requests\updateTask;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\DB;



class TaskController extends Controller
{
     public function getTasks(Project $project)
    {
        try {

             $tasks = Task::where('project_id', $project->id)
                     ->orderBy('due_date')
                     ->get();

            return response()->json([
                'error' => false,
                'mensaje' => 'Tareas obtenidas correctamente.',
                'data' => $tasks,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
                'mensaje' => 'Error al obtener tareas.',
                'errorInfo' => $th->getMessage(),
                'traza' => $th->getTraceAsString(),
            ], 500);
        }
    }

    public function createTask(createTask $request, Project $project)
    {
        try {

            $data = $request->validated();

            $data['project_id'] = $project->id;

            $task = Task::create($data);

            return response()->json([
                'error' => false,
                'mensaje' => 'Tarea creada correctamente.',
                'data' => $task,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
                'mensaje' => 'Error al crear tarea.',
                'errorInfo' => $th->getMessage(),
                'traza' => $th->getTraceAsString(),
            ], 500);
        }
    }

    public function updateTask(updateTask $request, Project $project, Task $task)
    {
        try {

            $task->update($request->validated());

            return response()->json([
                'error' => false,
                'mensaje' => 'Tarea actualizada correctamente.',
                'data' => $task,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
                'mensaje' => 'Error al actualizar tarea.',
                'errorInfo' => $th->getMessage(),
                'traza' => $th->getTraceAsString(),
            ], 500);
        }
    }

    public function deleteTask(Project $project, Task $task)
    {
        try {

            $task->delete();

            return response()->json([
                'error' => false,
                'mensaje' => 'Tarea eliminada correctamente.',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
                'mensaje' => 'Error al eliminar tarea.',
                'errorInfo' => $th->getMessage(),
                'traza' => $th->getTraceAsString(),
            ], 500);
        }
    }
}
