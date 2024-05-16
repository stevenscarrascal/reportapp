<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class adminController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if ($request->user()->hasRole('Lector')) {
            return redirect()->action([ReportesController::class, 'index']);
        }

        if ($request->user()->hasRole('Coordinador')) {
            return redirect()->action([CoordinadorController::class, 'index']);
        }
        if ($request->user()->hasRole('Pno')) {
            return redirect()->action([AuditoriaController::class, 'index']);
        }

        if ($request->user()->hasRole('Administrador')) {
            return redirect()->action([ReportesController::class, 'index']);
        }

        // Redirigir a otra ubicación si el usuario no tiene ninguno de los roles anteriores
    }
}
