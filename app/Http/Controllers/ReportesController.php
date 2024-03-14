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

        $Path1 = $request->file('foto1')->store('public/imagenes');
        $Path2 = $request->file('foto2')->store('public/imagenes');
        $Path3 = $request->file('foto3')->store('public/imagenes');
        $Path4 = $request->file('foto4')->store('public/imagenes');
        $Path5 = $request->file('foto5')->store('public/imagenes');

        // $url1 = Storage::url($Path1);
        // $url2 = Storage::url($Path2);
        // $url3 = Storage::url($Path3);
        // $url4 = Storage::url($Path4);
        // $url5 = Storage::url($Path5);

        $reportes = new reportes($data);

        $reportes->create([
            'personal_id' => Auth::user()->personal->id,
            'contrato' => $request->input('contrato'),
            'lectura' => $request->input('lectura'),
            'anomalia' => $request->input('anomalia'),
            'imposibilidad' => $request->input('motivo'),
            'foto1' => $Path1,
            'foto2' => $Path2,
            'foto3' => $Path3,
            'foto4' => $Path4,
            'foto5' => $Path5
        ]);

        notify()->success('Lectura Guardada Con Exito');

        return redirect()->route('dashboard');
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
        $reportes = reportes::find($reportes);
        // Verificar si se han proporcionado nuevas imágenes en los campos de archivo

        if ($request->hasFile('foto1') || $request->hasFile('foto2') || $request->hasFile('foto3') || $request->hasFile('foto4') || $request->hasFile('foto5')) {
            // Borrar las imágenes antiguas si existen

            foreach (['foto1', 'foto2', 'foto3','foto4','foto5'] as $field) {
                $foto = str_replace('/storage/imagenes/', '/public/imagenes/', $reportes->$field);
                if (Storage::exists($foto))
                {
                    Storage::delete($foto);
                }
            }
            // Almacenar las nuevas imágenes
            $Path1 = $request->file('foto1')->store('public/imagenes');
            // $Path2 = $request->file('foto2')->store('public/imagenes');
            // $Path3 = $request->file('foto3')->store('public/imagenes');
            // $Path4 = $request->file('foto4')->store('public/imagenes');
            // $Path5 = $request->file('foto5')->store('public/imagenes');
            $url1 = Storage::url($Path1);
            // $url2 = Storage::url($Path2);
            // $url3 = Storage::url($Path3);
            // $url4 = Storage::url($Path4);
            // $url5 = Storage::url($Path5);
            // Actualizar el modelo reportes con las nuevas imágenes
            $reportes->update([
                'contrato' => $request->input('contrato'),
                'lectura' => $request->input('lectura'),
                'anomalia' => $request->input('anomalia'),
                'imposibilidad' => $request->input('motivo'),
                'foto1' => $url1,
                // 'foto2' => $url2,
                // 'foto3' => $url3,
                // 'foto4' => $url4,
                // 'foto5' => $url5
            ]);
            notify()->success('Información actualizada con éxito');
        } else {
            // Si no se proporcionan nuevas imágenes, solo actualizar los otros campos del modelo reportes
            $reportes->update([
                'contrato' => $request->input('contrato'),
                'lectura' => $request->input('lectura'),
                'anomalia' => $request->input('anomalia'),
                'imposibilidad' => $request->input('motivo')
            ]);
            notify()->success('Información actualizada sin cambios en las imágenes');
        }
        return redirect()->route('reportes.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(reportes $reportes)
    {
        //
    }
}
