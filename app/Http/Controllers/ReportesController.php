<?php

namespace App\Http\Controllers;

use App\Models\Localizacion;
use App\Models\reportes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;




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
        $latitud = $request->input('latitud');
        $longitud = $request->input('longitud');
        $localizacion = Localizacion::create([
            'latitud' => $latitud,
            'longitud' => $longitud
        ]);
        $response = Http::withoutVerifying()->get("https://revgeocode.search.hereapi.com/v1/revgeocode?apikey=auuOOORgqWd_T4DFf0onY2JlvMDhz4tP0G0o7fRYDRU&at=$latitud,$longitud&lang=es-ES");
        $data = $response->json();
        $direccion = $data['items'][0]['address']['label'];
        $request->validate(reportes::$rules);
        $reportes = $request->all();
        $reportes['localizacion'] = $localizacion->id;
        $reportes['direccion'] = $direccion;

        if ($imagen = $request->file('foto1')) {
            $Path1 = 'imagen/';
            $foto1 = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen->getClientOriginalExtension();
            $imagen->move($Path1, $foto1);
            $reportes['foto1'] = $foto1;
        }
        // Cargar la imagen con GD
        $imagePath = public_path($Path1 . $foto1);
        $image = imagecreatefromjpeg($imagePath);

        $imageWidth = imagesx($image);
        $imageHeight = imagesy($image);


        // Coordenadas a incrustar
        $fontSize = 70;
        $textColor = imagecolorallocate($image, 255, 255, 255); // Color blanco
        $textY = $imageHeight - 30;
        $textX = $imageWidth - 50;

        // Incrustar las coordenadas en la imagen
        imagettftext($image, $fontSize, 0, $textX, $textY, $textColor, public_path('font/arial.ttf'), "direccion: $direccion");

        // Guardar la imagen con las coordenadas incrustadas
        imagejpeg($image, $imagePath);

        // Liberar memoria
        imagedestroy($image);

        // if ($imagen2 = $request->file('foto2')) {
        //     $Path2 = 'imagen/';
        //     $foto2 = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen2->getClientOriginalExtension();
        //     $imagen2->move($Path2, $foto2);
        //     $reportes['foto2'] = $foto2;
        // }
        // if ($imagen3 = $request->file('foto3')) {
        //     $Path3 = 'imagen/';
        //     $foto3 = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen3->getClientOriginalExtension();
        //     $imagen3->move($Path3, $foto3);
        //     $reportes['foto3'] = $foto3;
        // }
        // if ($imagen4 = $request->file('foto4')) {
        //     $Path4 = 'imagen/';
        //     $foto4 = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen4->getClientOriginalExtension();
        //     $imagen4->move($Path4, $foto4);
        //     $reportes['foto4'] = $foto4;
        // }
        // if ($imagen5 = $request->file('foto5')) {
        //     $Path5 = 'imagen/';
        //     $foto5 = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen5->getClientOriginalExtension();
        //     $imagen5->move($Path5, $foto5);
        //     $reportes['foto5'] = $foto5;
        // }
        // if ($imagen6 = $request->file('foto6')) {
        //     $Path6 = 'imagen/';
        //     $foto6 = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen6->getClientOriginalExtension();
        //     $imagen6->move($Path6, $foto6);
        //     $reportes['foto6'] = $foto6;
        // }
        reportes::create($reportes);
        notify()->success('Lectura Guardada Con Exito');
        return redirect()->route('reportes.index');
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $reporte = reportes::with('localizacion')->find($id);
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
    public function update(Request $request, $reporte)
    {

        $request->validate(reportes::$rulesupdate);
        $reportes = reportes::find($reporte);
        $report = $request->all();
        $estado = '7';
        $reportes['estado'] =  $estado;

        if ($imagen = $request->file('foto1')) {
            $Path1 = 'imagen/';
            $foto1 = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen->getClientOriginalExtension();
            $imagen->move($Path1, $foto1);
            $report['foto1'] = $foto1;
            // Obtener el nombre de la foto anterior desde la base de datos
            $fotoAnterior = $reportes->foto1;
            // Eliminar la foto anterior si existe
            if ($fotoAnterior) {
                $rutaFotoAnterior = public_path($Path1 . $fotoAnterior);
                if (file_exists($rutaFotoAnterior)) {
                    unlink($rutaFotoAnterior);
                }
            }
            $report['foto1'] = $foto1;
        } else {
            unset($report['foto1']);
        }

        if ($imagen2 = $request->file('foto2')) {
            $Path2 = 'imagen/';
            $foto2 = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen2->getClientOriginalExtension();
            $imagen2->move($Path2, $foto2);
            $report['foto2'] = $foto2;
            // Obtener el nombre de la foto anterior desde la base de datos
            $fotoAnterior = $reportes->foto2;
            // Eliminar la foto anterior si existe
            if ($fotoAnterior) {
                $rutaFotoAnterior = public_path($Path2 . $fotoAnterior);
                if (file_exists($rutaFotoAnterior)) {
                    unlink($rutaFotoAnterior);
                }
            }
            $report['foto2'] = $foto2;
        } else {
            unset($report['foto2']);
        }

        if ($imagen3 = $request->file('foto3')) {
            $Path3 = 'imagen/';
            $foto3 = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen3->getClientOriginalExtension();
            $imagen3->move($Path3, $foto3);
            $report['foto3'] = $foto3;
            // Obtener el nombre de la foto anterior desde la base de datos
            $fotoAnterior = $reportes->foto3;
            // Eliminar la foto anterior si existe
            if ($fotoAnterior) {
                $rutaFotoAnterior = public_path($Path3 . $fotoAnterior);
                if (file_exists($rutaFotoAnterior)) {
                    unlink($rutaFotoAnterior);
                }
            }
            $report['foto3'] = $foto3;
        } else {
            unset($report['foto3']);
        }
        if ($imagen4 = $request->file('foto4')) {
            $Path4 = 'imagen/';
            $foto4 = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen4->getClientOriginalExtension();
            $imagen4->move($Path4, $foto4);
            $report['foto4'] = $foto4;
            // Obtener el nombre de la foto anterior desde la base de datos
            $fotoAnterior = $reportes->foto4;
            // Eliminar la foto anterior si existe
            if ($fotoAnterior) {
                $rutaFotoAnterior = public_path($Path4 . $fotoAnterior);
                if (file_exists($rutaFotoAnterior)) {
                    unlink($rutaFotoAnterior);
                }
            }
            $report['foto4'] = $foto4;
        } else {
            unset($report['foto4']);
        }
        if ($imagen5 = $request->file('foto5')) {
            $Path5 = 'imagen/';
            $foto5 = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen5->getClientOriginalExtension();
            $imagen5->move($Path5, $foto5);
            $report['foto5'] = $foto5;
            // Obtener el nombre de la foto anterior desde la base de datos
            $fotoAnterior = $reportes->foto5;
            // Eliminar la foto anterior si existe
            if ($fotoAnterior) {
                $rutaFotoAnterior = public_path($Path5 . $fotoAnterior);
                if (file_exists($rutaFotoAnterior)) {
                    unlink($rutaFotoAnterior);
                }
            }
            $report['foto5'] = $foto5;
        } else {
            unset($report['foto5']);
        }

        $reportes->update($report);
        notify()->success('Registro Actualizado Con Exito');
        return redirect()->route('reportes.create');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(reportes $reportes)
    {
        //
    }
}
