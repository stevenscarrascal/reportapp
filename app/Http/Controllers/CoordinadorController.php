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
