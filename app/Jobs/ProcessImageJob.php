<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessImageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $foto;
    protected $contrato;
    protected $direccion;

    public function __construct($foto, $contrato, $direccion)
    {
        $this->foto = $foto;
        $this->contrato = $contrato;
        $this->direccion = $direccion;
    }

    public function handle()
    {
        //  Abrir la imagen utilizando GD
        $imagenGD = imagecreatefromjpeg(public_path('imagen/' . $this->foto));
        // Añadir texto del contrato  a la imagen
        $textoContrato = "Contrato N°:" . $this->contrato;
        $colorTexto = imagecolorallocate($imagenGD, 255, 255, 255); // Color blanco
        $posXContrato = 10; // Ajusta según tu diseño
        $posYContrato = imagesy($imagenGD) - 170; // Ajusta según tu diseño
        imagettftext($imagenGD, 20, 0, $posXContrato, $posYContrato, $colorTexto, public_path('font/arial.ttf'), $textoContrato);
        // Añadir texto de coordenadas a la imagen
        $textoCoordenadas = "Direccion: " . $this->direccion;
        $colorTexto = imagecolorallocate($imagenGD, 255, 255, 255); // Color blanco
        $posXCoordenadas = 10; // Ajusta según tu diseño
        $posYCoordenadas = imagesy($imagenGD) - 20; // Ajusta según tu diseño
        imagettftext($imagenGD, 20, 0, $posXCoordenadas, $posYCoordenadas, $colorTexto, public_path('font/arial.ttf'), $textoCoordenadas);

        //Añadir texto de fecha a la imagen
        $fechaActual = date("Y-m-d H:i:s");
        $posXFecha = 10; // Ajusta según tu diseño
        $posYFecha = imagesy($imagenGD) - 90; // Ajusta según tu diseño
        imagettftext($imagenGD, 20, 0, $posXFecha, $posYFecha, $colorTexto, public_path('font/arial.ttf'), "Fecha: $fechaActual");

        // Guardar la imagen modificada
        imagejpeg($imagenGD, public_path('imagen/' . $this->foto));

        // Liberar la memoria
        imagedestroy($imagenGD);
    }
}
