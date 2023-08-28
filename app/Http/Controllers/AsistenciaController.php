<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Asistencia;
use Illuminate\Http\Request;
use \Illuminate\Database\QueryException;

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Asistencia::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        try {
            $nuevoAsistencia = new Asistencia();

            $nuevoAsistencia->alumno_id = $id;
            $nuevoAsistencia->descripcion = $request ->descripcion;
            $nuevoAsistencia->fecha = fake()->date();

            $nuevoAsistencia->save();
            return "Asistencia creada";

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
            $alumno->asistencias;
            return $alumno;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $dia , $id)
    {
        try {
            $asistenciaActualizar = Asistencia::find($dia)->where('alumno_id',$id);
            $asistenciaActualizar->alumno_id = $id;
            $request->descripcion ? $asistenciaActualizar->descripcion = $request->descripcion : $asistenciaActualizar->descripcion;
            $request->fecha ? $asistenciaActualizar->fecha = $request->fecha : $asistenciaActualizar->fecha;
            $asistenciaActualizar->save();

            return "La asistencia del dia: $dia, del alumno con ID: $id se actualizo";

        } catch (QueryException $e) {
            return $e->getMessage();
        }  
    }

}
