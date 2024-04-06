<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BusquedaController extends Controller
{
    public function index()
    {
        return view('agentes.busqueda');
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $direccion = Reporte::where('nombre', 'like', '%' . $search . '%')->paginate(5);
        return view('agentes.busqueda', ['reportes' => $reportes]);
    }
}
