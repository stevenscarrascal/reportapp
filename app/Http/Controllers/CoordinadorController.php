<?php

namespace App\Http\Controllers;


use App\Models\reportes;
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
        $pendientes = reportes::where('estado', '5')->get();
        $revisados = reportes::where('estado', '6')->get();
        $rechazados = reportes::where('estado', '7')->get();


        return view('coordinador.index', compact('pendientes', 'revisados', 'rechazados'));
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
        return view('coordinador.show', compact('reporte'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(reportes $id)
    {
        $reporte = reportes::find($id);
        // Ruta de la plantilla
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
        $templateProcessor->setValue('anomalia', $reporte->AnomaliaReporte->nombre);
        $templateProcessor->setValue('imposibilidad', $reporte->imposibilidadReporte->nombre);
        $templateProcessor->setValue('observaciones', $reporte->observaciones);

        for ($i = 1; $i < 7; $i++) {
            $foto = 'foto' . $i;
            $this->ImgExist($reporte->$foto, $templateProcessor, $foto);
        }

        // $templateProcessor->setImageValue('foto_inmueble', array('path' => public_path('imagen/'.$reporte->foto1), 'width' => 400, 'height' => 400, 'ratio' => true));
        // $templateProcessor->setImageValue('foto_serial', array('path' => public_path('imagen/'.$reporte->foto2), 'width' => 400, 'height' => 400, 'ratio' => true));
        // $templateProcessor->setImageValue('foto_lectura', array('path' => public_path('imagen/'.$reporte->foto3), 'width' => 400, 'height' => 400, 'ratio' => true));
        // $templateProcessor->setImageValue('foto_medidor', array('path' => public_path('imagen/'.$reporte->foto4), 'width' => 400, 'height' => 400, 'ratio' => true));
        // $templateProcessor->setImageValue('foto_estado', array('path' => public_path('imagen/'.$reporte->foto5), 'width' => 400, 'height' => 400, 'ratio' => true));
        // $templateProcessor->setImageValue('foto_opcional', array('path' => public_path('imagen/'.$reporte->foto6), 'width' => 400, 'height' => 400, 'ratio' => true));
        $outputFile = public_path('template/Reporte del contrato ' . $reporte->contrato . '.docx');
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
