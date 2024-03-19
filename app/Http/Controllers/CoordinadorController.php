<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use App\Models\personals;
use App\Models\reportes;
use App\Models\User;
use App\Models\vs_cargo;
use App\Models\vs_tipo_documento;
use Illuminate\Http\Request;

class CoordinadorController extends Controller
{
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
    public function show(string $id)
    {
        $reporte = reportes::find($id);
        return view('coordinador.show', compact('reporte'));
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
        // Buscar el registro personal
        $personal = personals::find($id);

        // Verificar si el registro personal existe
        if (!$personal) {
            // Manejar el caso cuando el registro no se encuentra
            // Por ejemplo, puedes redirigir de vuelta con un mensaje de error
            notify()->success('Registro personal no encontrado.');
            return redirect()->back();
        }

        // Buscar el registro de usuario asociado con el registro personal
        $usuario = User::where('personal_id', $personal->id)->first();

        
        // Verificar si el registro de usuario existe
        if (!$usuario) {
            // Manejar el caso cuando el registro no se encuentra
            // Por ejemplo, puedes redirigir de vuelta con un mensaje de error
            notify()->success('Registro de usuario no encontrado.');
            return redirect()->back();
        }

        // Actualizar la propiedad estado para ambos registros
        $personal->estado = 0;
        $personal->update();

        $usuario->estado = 0;
        $usuario->update();

        // Notificar éxito
        notify()->success('Usuario eliminado con éxito');

        // Redirigir a la ruta de índice
        return redirect()->route('personals.index');
    }
}
