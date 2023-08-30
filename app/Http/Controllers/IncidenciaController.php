<?php

namespace App\Http\Controllers;

use App\Models\Incidencia;
use App\Models\Perfil;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class IncidenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $incidencias = Incidencia::with(
            'etiqueta',
            'equipo',
            'user',
                'user.perfil'
        )->get();
        // dd($incidencias);
        return Inertia::render('admin/Incidencia/Index',compact('incidencias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Incidencia $incidencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Incidencia $incidencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Incidencia $incidencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Incidencia $incidencia)
    {
        //
    }
}
