<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use Illuminate\Http\Request;
use \Illuminate\Database\QueryException;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $docentes = Docente::all();
        $docentesActivos = [];
        foreach ($docentes as $docente) {
            if ($docente->estado === 1) {
                array_push($docentesActivos,$docente);
            }
        }

        return $docentesActivos;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $nuevoDocente = new Docente();

            $nuevoDocente->nombre = $request ->nombre;
            $nuevoDocente->correo = $request ->correo;
            $nuevoDocente->curso_id = $request ->curso_id;
            $nuevoDocente->estado = $request ->estado;

            $nuevoDocente->save();
            return "Docente creado";

        } catch (QueryException $e) {
            return $e->getMessage();
        }               
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $docente = Docente::find($id);
        
        if ($docente === null || $docente->estado === 0) {
            return "El docente con ID: $id, no existe";
        } else {
            $docente->curso;
            return $docente;
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $docenteActualizar = Docente::find($id);
            $request->nombre ? $docenteActualizar->nombre = $request->nombre : $docenteActualizar->nombre;
            $request->correo ? $docenteActualizar->correo = $request->correo : $docenteActualizar->correo;
            $request->curso_id ? $docenteActualizar->curso_id = $request->curso_id : $docenteActualizar->curso_id;
            $request->estado ? $docenteActualizar->estado = $request->estado : $docenteActualizar->estado;
            $docenteActualizar->save();

            return "El Docente $id se actualizo";

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
            $docenteEliminar = Docente::find($id);
            $docenteEliminar->estado = 0;
            $docenteEliminar->save();

            return "El Docente $id se elimino";

        } catch (QueryException $e) {
            return $e->getMessage();
        } 
    }
}
