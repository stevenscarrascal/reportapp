<?php

namespace App\Http\Controllers;

use App\Models\personals;
use App\Models\reportes;
use App\Models\vs_tipo_documento;
use Illuminate\Http\Request;

class CoordinadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pendientes = reportes::where('estado', '7')->get();
        $revisados = reportes::where('estado', '8')->get();
        $rechazados = reportes::where('estado', '9')->get();

        return view('coordinador.index',compact('pendientes','revisados','rechazados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $personals = personals::with('cargos','estado','tipodocumento')->get();
        $tipodocumento = vs_tipo_documento::pluck('nombre','id');
        return view('coordinador.create',compact('personals','tipodocumento'));
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
