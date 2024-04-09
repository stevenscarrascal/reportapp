<?php

namespace App\View\Components;

use App\Models\personals;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Busqueda extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $personals = personals::all();
        return view('components.busqueda',compact('personals'));
    }
}
