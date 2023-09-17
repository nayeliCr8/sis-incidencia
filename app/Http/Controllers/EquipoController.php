<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEquipoRequest;
use App\Http\Resources\EquipoResource;
use App\Http\Resources\OficinaResource;
use App\Models\Equipo;
use App\Models\Oficina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Enum;
use Inertia\Inertia;
use PhpParser\Node\Expr\BinaryOp\Equal;
use Illuminate\Support\Collection;

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipos = EquipoResource::collection(Equipo::with('oficina')->get());
        return Inertia::render('admin/equipos/Index', compact('equipos'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $oficinas = OficinaResource::collection(Oficina::select('id','nombre')->get());
        $estados = Equipo::$estados;
        // dump($estados);  
        return Inertia::render('admin/equipos/Create', compact('oficinas','estados'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateEquipoRequest $request)
    {
        $equipo = new Equipo();

        $equipo->marca = $request->marca;
        $equipo->serie = $request->serie;
        $equipo->ip = $request->ip;
        $equipo->estado = $request->estado;
        $equipo->observacion = $request->observacion;
        $equipo->tipo_equipo = $request->tipo;
        $equipo->oficina_id = $request->oficina;

        $equipo->save();

        return Redirect::route('admin.equipos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipo $equipo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipo $equipo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Equipo $equipo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipo $equipo)
    {
        //
    }
}
