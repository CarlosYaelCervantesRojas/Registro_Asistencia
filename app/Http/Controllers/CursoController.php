<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cursos = Curso::all();
        $cursosActivos = [];
        foreach ($cursos as $curso) {
            if ($curso->estado === 1) {
                array_push($cursosActivos,$curso);
            }
        }

        return $cursosActivos;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $nuevoCurso = new Curso();

            $nuevoCurso->curso = $request ->curso;
            $nuevoCurso->estado = $request ->estado;

            $nuevoCurso->save();
            return "Curso creado";

        } catch (QueryException $e) {
            return $e->getMessage();
        }               
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $curso = Curso::find($id);

        if ($curso === null || $curso->estado === 0) {
            return "El curso con ID: $id, no existe";
        } else {
            $curso->docente;
            $curso->alumnos;
            return $curso;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $cursoActualizar = Curso::find($id);
            $request->curso ? $cursoActualizar->curso = $request->curso : $cursoActualizar->curso;
            $request->estado ? $cursoActualizar->estado = $request->estado : $cursoActualizar->estado;
            $cursoActualizar->save();

            return "El curso $id se actualizo";

        } catch (QueryException $e) {
            return $e->getMessage();
        }  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $cursoEliminar = Curso::find($id);
            $cursoEliminar->estado = 0;
            $cursoEliminar->save();

            return "El Curso $id se elimino";

        } catch (QueryException $e) {
            return $e->getMessage();
        } 
    }
}
