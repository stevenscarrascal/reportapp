<?php

namespace App\Http\Controllers;


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
            ->whereIn('estado', [7, 9])
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

        $reportes['latitud'] = $latitud;
        $reportes['longitud'] = $longitud;
        $reportes['direccion'] = $direccion;
       


        if ($imagen = $request->file('foto1')) {
            $path = 'imagen/';
            $foto = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen->getClientOriginalExtension();
            $imagen->move($path, $foto);
            $reportes['foto1'] = $foto;

            //  Abrir la imagen utilizando GD
            $imagenGD = imagecreatefromjpeg(public_path($path . $foto));

            // Añadir texto del contrato  a la imagen
            $textoContrato = "Contrato N°:" . $request->input('contrato');
            $colorTexto = imagecolorallocate($imagenGD, 255, 255, 255); // Color blanco
            $posXContrato = 10; // Ajusta según tu diseño
            $posYContrato = imagesy($imagenGD) - 170; // Ajusta según tu diseño
            imagettftext($imagenGD, $fontSize, 0, $posXContrato, $posYContrato, $colorTexto, public_path('font/arial.ttf'), $textoContrato);

            // Añadir texto de coordenadas a la imagen
            $textoCoordenadas = "Direccion: " . $direccion;
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
            imagejpeg($imagenGD, public_path($path . $foto));

            // Liberar la memoria
            imagedestroy($imagenGD);
        }

        if ($imagen = $request->file('foto2')) {
            $path = 'imagen/';
            $foto = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen->getClientOriginalExtension();
            $imagen->move($path, $foto);
            $reportes['foto2'] = $foto;
            //  Abrir la imagen utilizando GD
            $imagenGD = imagecreatefromjpeg(public_path($path . $foto));

            // Añadir texto del contrato  a la imagen
            $textoContrato = "Contrato N°:" . $request->input('contrato');
            $colorTexto = imagecolorallocate($imagenGD, 255, 255, 255); // Color blanco
            $posXContrato = 10; // Ajusta según tu diseño
            $posYContrato = imagesy($imagenGD) - 170; // Ajusta según tu diseño

            imagettftext($imagenGD, $fontSize, 0, $posXContrato, $posYContrato, $colorTexto, public_path('font/arial.ttf'), $textoContrato);
            // // Añadir texto de coordenadas a la imagen
            $textoCoordenadas = "Direccion: " . $direccion;
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
            imagejpeg($imagenGD, public_path($path . $foto));

            // Liberar la memoria
            imagedestroy($imagenGD);
        }
        if ($imagen = $request->file('foto3')) {
            $path = 'imagen/';
            $foto = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen->getClientOriginalExtension();
            $imagen->move($path, $foto);
            $reportes['foto3'] = $foto;
            //  Abrir la imagen utilizando GD
            $imagenGD = imagecreatefromjpeg(public_path($path . $foto));
            // Añadir texto del contrato  a la imagen
            $textoContrato = "Contrato N°:" . $request->input('contrato');
            $colorTexto = imagecolorallocate($imagenGD, 255, 255, 255); // Color blanco
            $posXContrato = 10; // Ajusta según tu diseño
            $posYContrato = imagesy($imagenGD) - 170; // Ajusta según tu diseño
            // // Añadir texto de coordenadas a la imagen
            $textoCoordenadas = "Direccion: " . $direccion;
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
            imagejpeg($imagenGD, public_path($path . $foto));
            // Liberar la memoria
            imagedestroy($imagenGD);
        }
        if ($imagen = $request->file('foto4')) {
            $path = 'imagen/';
            $foto = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen->getClientOriginalExtension();
            $imagen->move($path, $foto);
            $reportes['foto4'] = $foto;
            //  Abrir la imagen utilizando GD
            $imagenGD = imagecreatefromjpeg(public_path($path . $foto));
            // Añadir texto del contrato  a la imagen
            $textoContrato = "Contrato N°:" . $request->input('contrato');
            $colorTexto = imagecolorallocate($imagenGD, 255, 255, 255); // Color blanco
            $posXContrato = 10; // Ajusta según tu diseño
            $posYContrato = imagesy($imagenGD) - 170; // Ajusta según tu diseño

            // // Añadir texto de coordenadas a la imagen
            $textoCoordenadas = "Direccion: " . $direccion;
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
            imagejpeg($imagenGD, public_path($path . $foto));

            // Liberar la memoria
            imagedestroy($imagenGD);
        }
        if ($imagen = $request->file('foto5')) {
            $path = 'imagen/';
            $foto = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen->getClientOriginalExtension();
            $imagen->move($path, $foto);
            $reportes['foto5'] = $foto;
            //  Abrir la imagen utilizando GD
            $imagenGD = imagecreatefromjpeg(public_path($path . $foto));
            // Añadir texto del contrato  a la imagen
            $textoContrato = "Contrato N°:" . $request->input('contrato');
            $colorTexto = imagecolorallocate($imagenGD, 255, 255, 255); // Color blanco
            $posXContrato = 10; // Ajusta según tu diseño
            $posYContrato = imagesy($imagenGD) - 170; // Ajusta según tu diseño

            // // Añadir texto de coordenadas a la imagen
            $textoCoordenadas = "Direccion: " . $direccion;
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
            imagejpeg($imagenGD, public_path($path . $foto));

            // Liberar la memoria
            imagedestroy($imagenGD);
        }
        if ($imagen = $request->file('foto6')) {
            $path = 'imagen/';
            $foto = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen->getClientOriginalExtension();
            $imagen->move($path, $foto);
            $reportes['foto6'] = $foto;
            //  Abrir la imagen utilizando GD
            $imagenGD = imagecreatefromjpeg(public_path($path . $foto));
            // Añadir texto del contrato  a la imagen
            $textoContrato = "Contrato N°:" . $request->input('contrato');
            $colorTexto = imagecolorallocate($imagenGD, 255, 255, 255); // Color blanco
            $posXContrato = 10; // Ajusta según tu diseño
            $posYContrato = imagesy($imagenGD) - 170; // Ajusta según tu diseño

            // // Añadir texto de coordenadas a la imagen
            $textoCoordenadas = "Direccion: " . $direccion;
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
            imagejpeg($imagenGD, public_path($path . $foto));

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
        $fontSize = 50;
        $reportes['estado'] =  $estado;

        if ($imagen = $request->file('foto1')) {
            $path = 'imagen/';
            $foto = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen->getClientOriginalExtension();
            $imagen->move($path, $foto);
            $report['foto1'] = $foto;
            //  Abrir la imagen utilizando GD
            $imagenGD = imagecreatefromjpeg(public_path($path . $foto));
            // Añadir texto del contrato  a la imagen
            $textoContrato = "Contrato N°:" . $reportes->contrato;
            $colorTexto = imagecolorallocate($imagenGD, 255, 255, 255); // Color blanco
            $posXContrato = 10; // Ajusta según tu diseño
            $posYContrato = imagesy($imagenGD) - 170; // Ajusta según tu diseño
            imagettftext($imagenGD, $fontSize, 0, $posXContrato, $posYContrato, $colorTexto, public_path('font/arial.ttf'), $textoContrato);
            // Añadir texto de coordenadas a la imagen
            $textoCoordenadas = "Direccion:" . $reportes->direccion;
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
            imagejpeg($imagenGD, public_path($path . $foto));
            // Liberar la memoria
            imagedestroy($imagenGD);
            // Obtener el nombre de la foto anterior desde la base de datos
            $fotoAnterior = $reportes->foto1;
            // Eliminar la foto anterior si existe
            if ($fotoAnterior) {
                $rutaFotoAnterior = public_path($path . $fotoAnterior);
                if (file_exists($rutaFotoAnterior)) {
                    unlink($rutaFotoAnterior);
                }
            }
            $report['foto1'] = $foto;
        } else {
            unset($report['foto1']);
        }


        if ($imagen = $request->file('foto2')) {
            $path = 'imagen/';
            $foto = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen->getClientOriginalExtension();
            $imagen->move($path, $foto);
            $report['foto2'] = $foto;
            //  Abrir la imagen utilizando GD
            $imagenGD = imagecreatefromjpeg(public_path($path . $foto));
            // Añadir texto del contrato  a la imagen
            $textoContrato = "Contrato N°:" . $reportes->contrato;
            $colorTexto = imagecolorallocate($imagenGD, 255, 255, 255); // Color blanco
            $posXContrato = 10; // Ajusta según tu diseño
            $posYContrato = imagesy($imagenGD) - 170; // Ajusta según tu diseño
            imagettftext($imagenGD, $fontSize, 0, $posXContrato, $posYContrato, $colorTexto, public_path('font/arial.ttf'), $textoContrato);
            // Añadir texto de coordenadas a la imagen
            $textoCoordenadas = "Direccion:" . $reportes->direccion;
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
            imagejpeg($imagenGD, public_path($path . $foto));
            // Liberar la memoria
            imagedestroy($imagenGD);
            // Obtener el nombre de la foto anterior desde la base de datos
            $fotoAnterior = $reportes->foto2;
            // Eliminar la foto anterior si existe
            if ($fotoAnterior) {
                $rutaFotoAnterior = public_path($path . $fotoAnterior);
                if (file_exists($rutaFotoAnterior)) {
                    unlink($rutaFotoAnterior);
                }
            }
            $report['foto2'] = $foto;
        } else {
            unset($report['foto2']);
        }

        if ($imagen = $request->file('foto3')) {
            $path = 'imagen/';
            $foto = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen->getClientOriginalExtension();
            $imagen->move($path, $foto);
            $report['foto3'] = $foto;
            //  Abrir la imagen utilizando GD
            $imagenGD = imagecreatefromjpeg(public_path($path . $foto));
            // Añadir texto del contrato  a la imagen
            $textoContrato = "Contrato N°:" . $reportes->contrato;
            $colorTexto = imagecolorallocate($imagenGD, 255, 255, 255); // Color blanco
            $posXContrato = 10; // Ajusta según tu diseño
            $posYContrato = imagesy($imagenGD) - 170; // Ajusta según tu diseño
            imagettftext($imagenGD, $fontSize, 0, $posXContrato, $posYContrato, $colorTexto, public_path('font/arial.ttf'), $textoContrato);
            // Añadir texto de coordenadas a la imagen
            $textoCoordenadas = "Direccion:" . $reportes->direccion;
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
            imagejpeg($imagenGD, public_path($path . $foto));
            // Liberar la memoria
            imagedestroy($imagenGD);
            // Obtener el nombre de la foto anterior desde la base de datos
            $fotoAnterior = $reportes->foto3;
            // Eliminar la foto anterior si existe
            if ($fotoAnterior) {
                $rutaFotoAnterior = public_path($path . $fotoAnterior);
                if (file_exists($rutaFotoAnterior)) {
                    unlink($rutaFotoAnterior);
                }
            }
            $report['foto3'] = $foto;
        } else {
            unset($report['foto3']);
        }
        if ($imagen = $request->file('foto4')) {
            $path = 'imagen/';
            $foto = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen->getClientOriginalExtension();
            $imagen->move($path, $foto);
            $report['foto4'] = $foto;
             //  Abrir la imagen utilizando GD
             $imagenGD = imagecreatefromjpeg(public_path($path . $foto));
             // Añadir texto del contrato  a la imagen
             $textoContrato = "Contrato N°:" . $reportes->contrato;
             $colorTexto = imagecolorallocate($imagenGD, 255, 255, 255); // Color blanco
             $posXContrato = 10; // Ajusta según tu diseño
             $posYContrato = imagesy($imagenGD) - 170; // Ajusta según tu diseño
             imagettftext($imagenGD, $fontSize, 0, $posXContrato, $posYContrato, $colorTexto, public_path('font/arial.ttf'), $textoContrato);
             // Añadir texto de coordenadas a la imagen
             $textoCoordenadas = "Direccion:" . $reportes->direccion;
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
             imagejpeg($imagenGD, public_path($path . $foto));
             // Liberar la memoria
             imagedestroy($imagenGD);
            // Obtener el nombre de la foto anterior desde la base de datos
            $fotoAnterior = $reportes->foto4;
            // Eliminar la foto anterior si existe
            if ($fotoAnterior) {
                $rutaFotoAnterior = public_path($path . $fotoAnterior);
                if (file_exists($rutaFotoAnterior)) {
                    unlink($rutaFotoAnterior);
                }
            }
            $report['foto4'] = $foto;
        } else {
            unset($report['foto4']);
        }

        if ($imagen = $request->file('foto5')) {
            $path = 'imagen/';
            $foto = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen->getClientOriginalExtension();
            $imagen->move($path, $foto);
            $report['foto5'] = $foto;
            //  Abrir la imagen utilizando GD
            $imagenGD = imagecreatefromjpeg(public_path($path . $foto));
            // Añadir texto del contrato  a la imagen
            $textoContrato = "Contrato N°:" . $reportes->contrato;
            $colorTexto = imagecolorallocate($imagenGD, 255, 255, 255); // Color blanco
            $posXContrato = 10; // Ajusta según tu diseño
            $posYContrato = imagesy($imagenGD) - 170; // Ajusta según tu diseño
            imagettftext($imagenGD, $fontSize, 0, $posXContrato, $posYContrato, $colorTexto, public_path('font/arial.ttf'), $textoContrato);
            // Añadir texto de coordenadas a la imagen
            $textoCoordenadas = "Direccion:" . $reportes->direccion;
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
            imagejpeg($imagenGD, public_path($path . $foto));
            // Liberar la memoria
            imagedestroy($imagenGD);
            $fotoAnterior = $reportes->foto5;
            // Eliminar la foto anterior si existe
            if ($fotoAnterior) {
                $rutaFotoAnterior = public_path($path . $fotoAnterior);
                if (file_exists($rutaFotoAnterior)) {
                    unlink($rutaFotoAnterior);
                }
            }
            $report['foto5'] = $foto;
        } else {
            unset($report['foto5']);
        }
        if ($imagen = $request->file('foto6')) {
            $path = 'imagen/';
            $foto = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen->getClientOriginalExtension();
            $imagen->move($path, $foto);
            $report['foto6'] = $foto;
            //  Abrir la imagen utilizando GD
            $imagenGD = imagecreatefromjpeg(public_path($path . $foto));
            // Añadir texto del contrato  a la imagen
            $textoContrato = "Contrato N°:" . $reportes->contrato;
            $colorTexto = imagecolorallocate($imagenGD, 255, 255, 255); // Color blanco
            $posXContrato = 10; // Ajusta según tu diseño
            $posYContrato = imagesy($imagenGD) - 170; // Ajusta según tu diseño
            imagettftext($imagenGD, $fontSize, 0, $posXContrato, $posYContrato, $colorTexto, public_path('font/arial.ttf'), $textoContrato);
            // Añadir texto de coordenadas a la imagen
            $textoCoordenadas = "Direccion:" . $reportes->direccion;
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
            imagejpeg($imagenGD, public_path($path . $foto));
            // Liberar la memoria
            imagedestroy($imagenGD);
            // Obtener el nombre de la foto anterior desde la base de datos
            $fotoAnterior = $reportes->foto6;
            // Eliminar la foto anterior si existe
            if ($fotoAnterior) {
                $rutaFotoAnterior = public_path($path . $fotoAnterior);
                if (file_exists($rutaFotoAnterior)) {
                    unlink($rutaFotoAnterior);
                }
            }
            $report['foto6'] = $foto;
        } else {
            unset($report['foto6']);
        }

        $reportes->update($report);
        notify()->success('Registro Actualizado Con Exito');
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
