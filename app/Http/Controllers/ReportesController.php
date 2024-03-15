<?php

namespace App\Http\Controllers;

use App\Models\reportes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;



class ReportesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('agentes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $historiales = reportes::with('personal', 'EstadoReporte')
            ->where('personal_id', Auth::user()->personal->id)
            ->get();
        return view('agentes.historial', compact('historiales'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate(reportes::$rules);

        $reportes = $request->all();

        if ($imagen = $request->file('foto1')) {
            $Path1 = 'imagen/';
            $foto1 = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen->getClientOriginalExtension();
            $imagen->move($Path1, $foto1);
            $reportes['foto1'] = $foto1;
        }
        if ($imagen2 = $request->file('foto2')) {
            $Path2 = 'imagen/';
            $foto2 = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen2->getClientOriginalExtension();
            $imagen2->move($Path2, $foto2);
            $reportes['foto2'] = $foto2;
        }
        if ($imagen3 = $request->file('foto3')) {
            $Path3 = 'imagen/';
            $foto3 = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen3->getClientOriginalExtension();
            $imagen3->move($Path3, $foto3);
            $reportes['foto3'] = $foto3;
        }
        if ($imagen4 = $request->file('foto4')) {
            $Path4 = 'imagen/';
            $foto4 = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen4->getClientOriginalExtension();
            $imagen4->move($Path4, $foto4);
            $reportes['foto4'] = $foto4;
        }
        if ($imagen5 = $request->file('foto5')) {
            $Path5 = 'imagen/';
            $foto5 = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen5->getClientOriginalExtension();
            $imagen5->move($Path5, $foto5);
            $reportes['foto5'] = $foto5;
        }

        reportes::create($reportes);

        notify()->success('Lectura Guardada Con Exito');

        return redirect()->route('reportes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $reporte = reportes::find($id);
        return view('agentes.show', compact('reporte'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $reporte = reportes::find($id);
        return view('agentes.edit', compact('reporte'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $reportes)
    {
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(reportes $reportes)
    {
        //
    }
}
