<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\ProjectController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    // Proyectos
    Route::get('projects', [ProjectController::class, 'getProjectsByUser']);


    // Tareas (anidadas en proyectos)
    Route::get('projects/{project}/tasks', [TaskController::class, 'getTasks']);
    Route::post('projects/{project}/tasks', [TaskController::class, 'createTask']);
    Route::put('projects/{project}/tasks/{task}', [TaskController::class, 'updateTask']);
    Route::delete('projects/{project}/tasks/{task}', [TaskController::class, 'deleteTask']);
});
