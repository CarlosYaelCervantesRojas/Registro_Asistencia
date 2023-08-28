<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;
use \Illuminate\Database\QueryException;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alumnos = Alumno::all();
        $alumnosActivos = [];
        foreach ($alumnos as $alumno) {
            if ($alumno->estado === 1) {
                array_push($alumnosActivos,$alumno);
            }
        }

        return $alumnosActivos;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $nuevoAlumno = new Alumno();

            $nuevoAlumno->nombre = $request ->nombre;
            $nuevoAlumno->correo = $request ->correo;
            $nuevoAlumno->curso_id = $request ->curso_id;
            $nuevoAlumno->estado = $request ->estado;

            $nuevoAlumno->save();
            return "Alumno creado";

        } catch (QueryException $e) {
            return $e->getMessage();
        }               
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $alumno = Alumno::find($id);

        if ($alumno === null || $alumno->estado === 0) {
            return "El alumno con ID: $id, no existe";
        } else {
            $alumno->curso;
            $alumno->curso->docente;
            return $alumno;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $alumnoActualizar = Alumno::find($id);
            $request->nombre ? $alumnoActualizar->nombre = $request->nombre : $alumnoActualizar->nombre;
            $request->correo ? $alumnoActualizar->correo = $request->correo : $alumnoActualizar->correo;
            $request->curso_id ? $alumnoActualizar->curso_id = $request->curso_id : $alumnoActualizar->curso_id;
            $request->estado ? $alumnoActualizar->estado = $request->estado : $alumnoActualizar->estado;
            $alumnoActualizar->save();

            return "El alumno $id se actualizo";

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
            $alumnoEliminar = Alumno::find($id);
            $alumnoEliminar->estado = 0;
            $alumnoEliminar->save();

            return "El Alumno $id se elimino";

        } catch (QueryException $e) {
            return $e->getMessage();
        } 
    }
}
