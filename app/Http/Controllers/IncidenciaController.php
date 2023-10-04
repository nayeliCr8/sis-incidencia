<?php

namespace App\Http\Controllers;

use App\Models\Incidencia;
use App\Models\Perfil;
use App\Models\Resuelto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use PhpParser\Node\Expr\Cast\String_;

class IncidenciaController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:incidencia index')->only('index');
        $this->middleware('can:incidencia create')->only('create','store');
        $this->middleware('can:incidencia resolver')->only('edit','update');
        $this->middleware('can:incidencia delete')->only('destroy');
    }

    public function index()
    {
        $incidencias = Incidencia::with(
            'etiqueta',
            'equipo',
                'equipo.oficina',
                    'equipo.oficina.sede',
            'user',
                'user.perfil'
        )->orderBy('id','desc')->get();

        $estados = Incidencia::$estados;
        // dd($incidencias);
        return Inertia::render('admin/Incidencia/Index',compact('incidencias','estados'));
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

       
        $incidencia->estado = $request->estado;
        
        $incidencia->save();

        // \dd($request);
        $img = $request->file('evidencia')->store('public/imagen');
        $image = Storage::url($img);

        $resuelto = new Resuelto();
        $resuelto->evidencia = $image;
        $resuelto->descripcion = $request->descripcion;
        $resuelto->incidencia_id = $incidencia->id;
        $resuelto->user_id = auth()->user()->id;

        $resuelto->save();

        // return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Incidencia $incidencia)
    {
        //
    }
}
