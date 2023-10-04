<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSedeRequest;
use App\Http\Resources\SedeResource;
use App\Models\Sede;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class SedeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:sede index')->only('index');
        $this->middleware('can:sede create')->only('create','store');
        $this->middleware('can:sede update')->only('edit','update');
        $this->middleware('can:sede delete')->only('destroy');
    }

    public function index()
    {
        $sedes = SedeResource::collection(Sede::all());
        return Inertia::render('admin/sedes/Index', compact('sedes'));
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
    public function store(CreateSedeRequest $request)
    {
        $sede = new Sede();

        $sede->nombre = $request->nombre;
        $sede->direccion = $request->direccion;

        $sede->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(Sede $sede)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sede $sede)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateSedeRequest $request, Sede $sede)
    {
        $sede->nombre = $request->nombre;
        $sede->direccion = $request->direccion;

        $sede->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sede $sede)
    {
        $sede->delete();

        return Redirect::back();
    }
}
