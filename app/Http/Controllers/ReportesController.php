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
        $historiales = reportes::with('personal', 'EstadoReporte')
            ->where('personal_id', Auth::user()->personal->id)
            ->whereIn('estado', [7,9])
            ->get();
        return view('agentes.index', compact('historiales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('agentes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $latitud = $request->input('latitud');
        $longitud = $request->input('longitud');
        $fontSize = 50;

        $response = Http::withoutVerifying()->get("https://revgeocode.search.hereapi.com/v1/revgeocode?apikey=auuOOORgqWd_T4DFf0onY2JlvMDhz4tP0G0o7fRYDRU&at=$latitud,$longitud&lang=es-ES");
        $data = $response->json();

        $direccion = $data['items'][0]['address']['label'];
        $request->validate(reportes::$rules);

        $reportes = $request->all();


        $reportes['direccion'] = $direccion;

        if ($imagen1 = $request->file('foto1')) {
            $path1 = 'imagen/';
            $foto1 = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen1->getClientOriginalExtension();
            $imagen1->move($path1, $foto1);
            $reportes['foto1'] = $foto1;

            //  Abrir la imagen utilizando GD
            $imagenGD = imagecreatefromjpeg(public_path($path1 . $foto1));

            // Añadir texto del contrato  a la imagen
            $textoContrato = "Contrato N°:" . $request->input('contrato');
            $colorTexto = imagecolorallocate($imagenGD, 255, 255, 255); // Color blanco
            $posXContrato = 10; // Ajusta según tu diseño
            $posYContrato = imagesy($imagenGD) - 170; // Ajusta según tu diseño
            imagettftext($imagenGD, $fontSize, 0, $posXContrato, $posYContrato, $colorTexto, public_path('font/arial.ttf'), $textoContrato);

            // Añadir texto de coordenadas a la imagen
            $textoCoordenadas = "Direccion: $direccion";
            $colorTexto = imagecolorallocate($imagenGD, 255, 255, 255); // Color blanco
            $posXCoordenadas = 10; // Ajusta según tu diseño
            $posYCoordenadas = imagesy($imagenGD) - 20; // Ajusta según tu diseño
            imagettftext($imagenGD, $fontSize, 0, $posXCoordenadas, $posYCoordenadas, $colorTexto, public_path('font/arial.ttf'), $textoCoordenadas);

            //Añadir texto de fecha a la imagen
            $fechaActual = date("Y-m-d H:i:s");
            $posXFecha = 10; // Ajusta según tu diseño
            $posYFecha = imagesy($imagenGD) - 90; // Ajusta según tu diseño
            imagettftext($imagenGD, $fontSize, 0, $posXFecha, $posYFecha, $colorTexto, public_path('font/arial.ttf'), "Fecha: $fechaActual");

            // Guardar la imagen modificada
            imagejpeg($imagenGD, public_path($path1 . $foto1));

            // Liberar la memoria
            imagedestroy($imagenGD);
        }

        if ($imagen2 = $request->file('foto2')) {
            $path2 = 'imagen/';
            $foto2 = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen2->getClientOriginalExtension();
            $imagen2->move($path2, $foto2);
            $reportes['foto2'] = $foto2;
            //  Abrir la imagen utilizando GD
            $imagenGD = imagecreatefromjpeg(public_path($path2 . $foto2));
            // // Añadir texto de coordenadas a la imagen
            $textoCoordenadas = "Direccion: $direccion";
            $colorTexto = imagecolorallocate($imagenGD, 255, 255, 255); // Color blanco
            $posXCoordenadas = 10; // Ajusta según tu diseño
            $posYCoordenadas = imagesy($imagenGD) - 20; // Ajusta según tu diseño
            imagettftext($imagenGD, $fontSize, 0, $posXCoordenadas, $posYCoordenadas, $colorTexto, public_path('font/arial.ttf'), $textoCoordenadas);

            //Añadir texto de fecha a la imagen
            $fechaActual = date("Y-m-d H:i:s");
            $posXFecha = 10; // Ajusta según tu diseño
            $posYFecha = imagesy($imagenGD) - 130; // Ajusta según tu diseño
            imagettftext($imagenGD, $fontSize, 0, $posXFecha, $posYFecha, $colorTexto, public_path('font/arial.ttf'), "Fecha: $fechaActual");

            // Guardar la imagen modificada
            imagejpeg($imagenGD, public_path($path2 . $foto2));

            // Liberar la memoria
            imagedestroy($imagenGD);
        }
        if ($imagen3 = $request->file('foto3')) {
            $path3 = 'imagen/';
            $foto3 = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen3->getClientOriginalExtension();
            $imagen3->move($path3, $foto3);
            $reportes['foto3'] = $foto3;
            //  Abrir la imagen utilizando GD
            $imagenGD = imagecreatefromjpeg(public_path($path3 . $foto3));
            // // Añadir texto de coordenadas a la imagen
            $textoCoordenadas = "Direccion: $direccion";
            $colorTexto = imagecolorallocate($imagenGD, 255, 255, 255); // Color blanco
            $posXCoordenadas = 10; // Ajusta según tu diseño
            $posYCoordenadas = imagesy($imagenGD) - 20; // Ajusta según tu diseño
            imagettftext($imagenGD, $fontSize, 0, $posXCoordenadas, $posYCoordenadas, $colorTexto, public_path('font/arial.ttf'), $textoCoordenadas);

            //Añadir texto de fecha a la imagen
            $fechaActual = date("Y-m-d H:i:s");
            $posXFecha = 10; // Ajusta según tu diseño
            $posYFecha = imagesy($imagenGD) - 130; // Ajusta según tu diseño
            imagettftext($imagenGD, $fontSize, 0, $posXFecha, $posYFecha, $colorTexto, public_path('font/arial.ttf'), "Fecha: $fechaActual");

            // Guardar la imagen modificada
            imagejpeg($imagenGD, public_path($path3 . $foto3));

            // Liberar la memoria
            imagedestroy($imagenGD);
        }
        if ($imagen4 = $request->file('foto4')) {
            $path4 = 'imagen/';
            $foto4 = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen4->getClientOriginalExtension();
            $imagen4->move($path4, $foto4);
            $reportes['foto4'] = $foto4;
            //  Abrir la imagen utilizando GD
            $imagenGD = imagecreatefromjpeg(public_path($path4 . $foto4));
            // // Añadir texto de coordenadas a la imagen
            $textoCoordenadas = "Direccion: $direccion";
            $colorTexto = imagecolorallocate($imagenGD, 255, 255, 255); // Color blanco
            $posXCoordenadas = 10; // Ajusta según tu diseño
            $posYCoordenadas = imagesy($imagenGD) - 20; // Ajusta según tu diseño
            imagettftext($imagenGD, $fontSize, 0, $posXCoordenadas, $posYCoordenadas, $colorTexto, public_path('font/arial.ttf'), $textoCoordenadas);

            //Añadir texto de fecha a la imagen
            $fechaActual = date("Y-m-d H:i:s");
            $posXFecha = 10; // Ajusta según tu diseño
            $posYFecha = imagesy($imagenGD) - 130; // Ajusta según tu diseño
            imagettftext($imagenGD, $fontSize, 0, $posXFecha, $posYFecha, $colorTexto, public_path('font/arial.ttf'), "Fecha: $fechaActual");

            // Guardar la imagen modificada
            imagejpeg($imagenGD, public_path($path4 . $foto4));

            // Liberar la memoria
            imagedestroy($imagenGD);
        }
        if ($imagen5 = $request->file('foto5')) {
            $path5 = 'imagen/';
            $foto5 = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen5->getClientOriginalExtension();
            $imagen5->move($path5, $foto5);
            $reportes['foto5'] = $foto5;
            //  Abrir la imagen utilizando GD
            $imagenGD = imagecreatefromjpeg(public_path($path5 . $foto5));
            // // Añadir texto de coordenadas a la imagen
            $textoCoordenadas = "Direccion: $direccion";
            $colorTexto = imagecolorallocate($imagenGD, 255, 255, 255); // Color blanco
            $posXCoordenadas = 10; // Ajusta según tu diseño
            $posYCoordenadas = imagesy($imagenGD) - 20; // Ajusta según tu diseño
            imagettftext($imagenGD, $fontSize, 0, $posXCoordenadas, $posYCoordenadas, $colorTexto, public_path('font/arial.ttf'), $textoCoordenadas);

            //Añadir texto de fecha a la imagen
            $fechaActual = date("Y-m-d H:i:s");
            $posXFecha = 10; // Ajusta según tu diseño
            $posYFecha = imagesy($imagenGD) - 130; // Ajusta según tu diseño
            imagettftext($imagenGD, $fontSize, 0, $posXFecha, $posYFecha, $colorTexto, public_path('font/arial.ttf'), "Fecha: $fechaActual");

            // Guardar la imagen modificada
            imagejpeg($imagenGD, public_path($path5 . $foto5));

            // Liberar la memoria
            imagedestroy($imagenGD);
        }
        if ($imagen6 = $request->file('foto6')) {
            $path6 = 'imagen/';
            $foto6 = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen6->getClientOriginalExtension();
            $imagen6->move($path6, $foto6);
            $reportes['foto6'] = $foto6;
            //  Abrir la imagen utilizando GD
            $imagenGD = imagecreatefromjpeg(public_path($path6 . $foto6));
            // // Añadir texto de coordenadas a la imagen
            $textoCoordenadas = "Direccion: $direccion";
            $colorTexto = imagecolorallocate($imagenGD, 255, 255, 255); // Color blanco
            $posXCoordenadas = 10; // Ajusta según tu diseño
            $posYCoordenadas = imagesy($imagenGD) - 20; // Ajusta según tu diseño
            imagettftext($imagenGD, $fontSize, 0, $posXCoordenadas, $posYCoordenadas, $colorTexto, public_path('font/arial.ttf'), $textoCoordenadas);

            //Añadir texto de fecha a la imagen
            $fechaActual = date("Y-m-d H:i:s");
            $posXFecha = 10; // Ajusta según tu diseño
            $posYFecha = imagesy($imagenGD) - 130; // Ajusta según tu diseño
            imagettftext($imagenGD, $fontSize, 0, $posXFecha, $posYFecha, $colorTexto, public_path('font/arial.ttf'), "Fecha: $fechaActual");

            // Guardar la imagen modificada
            imagejpeg($imagenGD, public_path($path6 . $foto6));

            // Liberar la memoria
            imagedestroy($imagenGD);
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


        // if ($imagen2 = $request->file('foto2')) {
        //     $Path2 = 'imagen/';
        //     $foto2 = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen2->getClientOriginalExtension();
        //     $imagen2->move($Path2, $foto2);
        //     $report['foto2'] = $foto2;
        //     // Obtener el nombre de la foto anterior desde la base de datos
        //     $fotoAnterior = $reportes->foto2;
        //     // Eliminar la foto anterior si existe
        //     if ($fotoAnterior) {
        //         $rutaFotoAnterior = public_path($Path2 . $fotoAnterior);
        //         if (file_exists($rutaFotoAnterior)) {
        //             unlink($rutaFotoAnterior);
        //         }
        //     }
        //     $report['foto2'] = $foto2;
        // } else {
        //     unset($report['foto2']);
        // }
        // if ($imagen3 = $request->file('foto3')) {
        //     $Path3 = 'imagen/';
        //     $foto3 = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen3->getClientOriginalExtension();
        //     $imagen3->move($Path3, $foto3);
        //     $report['foto3'] = $foto3;
        //     // Obtener el nombre de la foto anterior desde la base de datos
        //     $fotoAnterior = $reportes->foto3;
        //     // Eliminar la foto anterior si existe
        //     if ($fotoAnterior) {
        //         $rutaFotoAnterior = public_path($Path3 . $fotoAnterior);
        //         if (file_exists($rutaFotoAnterior)) {
        //             unlink($rutaFotoAnterior);
        //         }
        //     }
        //     $report['foto3'] = $foto3;
        // } else {
        //     unset($report['foto3']);
        // }
        // if ($imagen4 = $request->file('foto4')) {
        //     $Path4 = 'imagen/';
        //     $foto4 = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen4->getClientOriginalExtension();
        //     $imagen4->move($Path4, $foto4);
        //     $report['foto4'] = $foto4;
        //     // Obtener el nombre de la foto anterior desde la base de datos
        //     $fotoAnterior = $reportes->foto4;
        //     // Eliminar la foto anterior si existe
        //     if ($fotoAnterior) {
        //         $rutaFotoAnterior = public_path($Path4 . $fotoAnterior);
        //         if (file_exists($rutaFotoAnterior)) {
        //             unlink($rutaFotoAnterior);
        //         }
        //     }
        //     $report['foto4'] = $foto4;
        // } else {
        //     unset($report['foto4']);
        // }
        // if ($imagen5 = $request->file('foto5')) {
        //     $Path5 = 'imagen/';
        //     $foto5 = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen5->getClientOriginalExtension();
        //     $imagen5->move($Path5, $foto5);
        //     $report['foto5'] = $foto5;
        //     // Obtener el nombre de la foto anterior desde la base de datos
        //     $fotoAnterior = $reportes->foto5;
        //     // Eliminar la foto anterior si existe
        //     if ($fotoAnterior) {
        //         $rutaFotoAnterior = public_path($Path5 . $fotoAnterior);
        //         if (file_exists($rutaFotoAnterior)) {
        //             unlink($rutaFotoAnterior);
        //         }
        //     }
        //     $report['foto5'] = $foto5;
        // } else {
        //     unset($report['foto5']);
        // }
        // if ($imagen6 = $request->file('foto5')) {
        //     $Path6 = 'imagen/';
        //     $foto6 = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen6->getClientOriginalExtension();
        //     $imagen5->move($Path6, $foto6);
        //     $report['foto6'] = $foto6;
        //     // Obtener el nombre de la foto anterior desde la base de datos
        //     $fotoAnterior = $reportes->foto5;
        //     // Eliminar la foto anterior si existe
        //     if ($fotoAnterior) {
        //         $rutaFotoAnterior = public_path($Path6 . $fotoAnterior);
        //         if (file_exists($rutaFotoAnterior)) {
        //             unlink($rutaFotoAnterior);
        //         }
        //     }
        //     $report['foto6'] = $foto6;
        // } else {
        //     unset($report['foto6']);
        // }

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
