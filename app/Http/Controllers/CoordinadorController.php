<?php

namespace App\Http\Controllers;


use App\Models\reportes;
use App\Models\vs_anomalias;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\IOFactory;

class CoordinadorController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:coordinador');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('coordinador.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fontSize = 50;
        $reportes = reportes::find($request["id"]);
        $report = $request->all();

        if ($video = $request->file('video')) {
            $path = 'video/';
            $videoname = rand(1000, 9999) . "_" . date('YmdHis') . "." . $video->getClientOriginalExtension();
            $video->move($path, $videoname);
            $reportes['video'] = $videoname;
        }

        foreach (range(1, 6) as $i) {
            if ($imagen = $request->file('foto' . $i)) {
                $path = 'imagen/';
                $foto = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen->getClientOriginalExtension();
                $imagen->move($path, $foto);
                $reportes['foto' . $i] = $foto;
                //  Abrir la imagen utilizando GD
                $imagenGD = imagecreatefromjpeg(public_path($path . $foto));
                // Añadir texto del contrato  a la imagen
                $textoContrato = "Contrato N°:" . $reportes->contrato;
                $colorTexto = imagecolorallocate($imagenGD, 255, 255, 255); // Color blanco
                $posXContrato = 10; // Ajusta según tu diseño
                $posYContrato = imagesy($imagenGD) - 170; // Ajusta según tu diseño
                imagettftext($imagenGD, $fontSize, 0, $posXContrato, $posYContrato, $colorTexto, public_path('font/arial.ttf'), $textoContrato);
                // Añadir texto de coordenadas a la imagen
                $textoCoordenadas = "Direccion: " . $reportes->direccion;
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
        }
        $reportes->save($report);

        return response()->json(['success' => 'Evidencias creadas con éxito']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $reporte = reportes::find($id);
        $anomaliasIds = json_decode($reporte->anomalia);
        $anomalias = vs_anomalias::whereIn('id', $anomaliasIds)->get();
        return view('coordinador.show', compact('reporte', 'anomalias'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reporte = reportes::find($id);
        // Ruta de la plantilla
        $anomaliasIds = json_decode($reporte->anomalia);
        $anomalias = vs_anomalias::whereIn('id', $anomaliasIds)->get();

        $templateFile = public_path('template/temp.docx');

        // Cargar la plantilla
        $templateProcessor = new TemplateProcessor($templateFile);


        // Reemplazar marcadores de posición con datos
        $templateProcessor->setValue('contrato', $reporte->contrato);
        $templateProcessor->setValue('fecha', $reporte->created_at);
        $templateProcessor->setValue('direccion', $reporte->direccion);
        $templateProcessor->setValue('medidor', $reporte->medidor);
        $templateProcessor->setValue('lectura', $reporte->lectura);
        $templateProcessor->setValue('comercio', $reporte->ComercioReporte->nombre);
        $nombresAnomalias = array();
        foreach ($anomalias as $anomalia) {
            $nombresAnomalias[] = $anomalia->nombre;
        }
        $stringAnomalias = implode(", ", $nombresAnomalias);
        $templateProcessor->setValue('anomalia', $stringAnomalias);

        $templateProcessor->setValue('imposibilidad', $reporte->imposibilidadReporte->nombre);
        $templateProcessor->setValue('observaciones', $reporte->observaciones);
        $templateProcessor->setValue('video', config('app.url') . '/video/' . $reporte->video);

        for ($i = 1; $i < 7; $i++) {
            $foto = 'foto' . $i;
            $this->ImgExist($reporte->$foto, $templateProcessor, $foto);
        }

        $rand = rand(600, 1000);
        $fecha = Carbon::now()->format('d-m-Y');

        $outputFile = public_path('template/Reporte del contrato ' . $reporte->contrato . '-' . $fecha . '-' . $rand . '.docx');
        $templateProcessor->saveAs($outputFile);

        // Descargar el documento
        return response()->download($outputFile)->deleteFileAfterSend();
    }

    private function ImgExist($img, $templateProcessor, $var)
    {
        if (file_exists(public_path('imagen/' . $img)) and $img != null) {
            return $templateProcessor->setImageValue($var, array('path' => public_path('imagen/' . $img), 'width' => 400, 'height' => 400, 'ratio' => true));
        } else {
            return $templateProcessor->setValue($var, 'Sin Registro Fotografico');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'estado' => 'required',
        ]);

        $estado = $request->estado;

        $reporte = reportes::find($id);
        if ($estado == 6) {
            $reporte->estado = $request->estado;
            $reporte->update();
            notify()->success('Observacion creada con éxito');
        }

        $reporte->estado = $request->estado;
        $reporte->observaciones = $request->observaciones;
        $reporte->update();
        notify()->success('Observacion creada con éxito');
        return redirect()->route('coordinador.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }
}
