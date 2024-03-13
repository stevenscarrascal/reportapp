<?php

namespace App\Http\Controllers;

use App\Models\reportes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $historiales = reportes::with('personal', 'EstadoReporte')
        ->where('personal_id', Auth::user()->personal->id)
        ->get();
        return view('agentes.historial', compact('historiales'));
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
        $data = $request->validate(reportes::$rules);

        $reportes = new reportes($data);

        $reportes->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(reportes $reportes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(reportes $reportes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, reportes $reportes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(reportes $reportes)
    {
        //
    }
}
