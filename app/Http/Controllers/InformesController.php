<?php

namespace App\Http\Controllers;

use App\Models\reportes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Fx\Chartjs\Factory\Chartjs;
use Illuminate\Support\Facades\DB;

class InformesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('informes.informeGeneral');
    }

}
