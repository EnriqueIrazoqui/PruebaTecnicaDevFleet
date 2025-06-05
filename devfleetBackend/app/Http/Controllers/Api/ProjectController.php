<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProjectController extends Controller
{
     public function getProjectsByUser(Request $request)
    {
        try {
            
            $projects = DB::table('projects')
            ->where('user_id', $request->user()->id)
            ->get();

            return response()->json([
                'error' => false,
                'mensaje' => 'Proyectos obtenidos correctamente.',
                'data' => $projects,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
                'mensaje' => 'Error al obtener proyectos.',
                'errorInfo' => $th->getMessage(),
                'traza' => $th->getTraceAsString(),
            ], 500);
        }
    }




}
