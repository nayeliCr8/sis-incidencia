<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateParaUserRequest;
use App\Models\Etiqueta;
use App\Models\Incidencia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ParaUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuario = User::with(
            'perfil',
            'perfil.oficina',
            'perfil.oficina.equipos',
            )->where('id','=',auth()->user()->id)->get();
        $etiquetas = Etiqueta::all();
        // dd(Incidencia::$estados);
        return Inertia::render('ParaUsuarios/Index', compact('usuario','etiquetas'));
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
    public function store(CreateParaUserRequest $request)
    {
        // dd($request->all());
        
        $etiquetas = new Incidencia();
        $etiquetas->estado = 'Incidencia';
        $etiquetas->nivel = 'No urgente';
        $etiquetas->descripcion = $request->descripcion;

        $img = $request->file('evidencia')->store('public/imagen');
        $image = Storage::url($img);

        $etiquetas->evidencia = $image;
        $etiquetas->equipo_id = $request->equipo_id;
        $etiquetas->user_id = auth()->user()->id;
        if($request->otros == '1'){
            $etiquetas->extraetiqueta =  $request->etiqueta_id;
        }else{
            $etiquetas->etiqueta_id = $request->etiqueta_id;
        }
        $etiquetas->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
