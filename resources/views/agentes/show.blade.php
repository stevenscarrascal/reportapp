<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Contrato N°:@if ($reporte->contrato)
                    {{ $reporte->contrato }}
                @endif
            </h2>
            <a href="{{ route('reportes.index') }}" class="btn btn-primary btn-md flex items-center">
                <i class="fas fa-arrow-left"></i>  Regresar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!--Tabs navigation-->
                <ul class="mb-5 flex list-none flex-row flex-wrap border-b-0 ps-0" role="tablist" data-twe-nav-ref>
                    <li role="presentation" class="flex-auto text-center">
                        <a href="#tabs-home01"
                            class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[twe-nav-active]:border-primary data-[twe-nav-active]:text-primary"
                            data-twe-toggle="pill" data-twe-target="#tabs-home01" data-twe-nav-active role="tab"
                            aria-controls="tabs-home01" aria-selected="true">Informacion</a>
                    </li>
                    <li role="presentation" class="flex-auto text-center">
                        <a href="#tabs-profile01"
                            class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[twe-nav-active]:border-primary data-[twe-nav-active]:text-primary"
                            data-twe-toggle="pill" data-twe-target="#tabs-profile01" role="tab"
                            aria-controls="tabs-profile01" aria-selected="false">Fotos</a>
                    </li>
                </ul>
                <!--Tabs content-->
                <div class="mb-6">
                    <div class="hidden opacity-100 transition-opacity duration-150 ease-linear data-[twe-tab-active]:block"
                        id="tabs-home01" role="tabpanel" aria-labelledby="tabs-home-tab01" data-twe-tab-active>
                        <div class="row px-4">
                            <div class="col-md-6">
                                <div class="card bg-white overflow-hidden shadow-xl sm:rounded-lg">
                                    <div class="card-body">
                                        <h5 class="card-title text-center uppercase">Datos del predio</h5>
                                        <p class="card-text text">Lectura Numero: {{ $reporte->lectura }}</p>
                                        <p class="card-text">Fecha y hora: {{ $reporte->created_at }}</p>
                                        <p class="card-text">Direccion:{{ $reporte->direccion }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-white overflow-hidden shadow-xl sm:rounded-lg">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><span class="uppercase">observaciones</span>
                                        </h5>
                                        <p class="card-text overflow-hidden">{{ $reporte->observaciones }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[twe-tab-active]:block"
                        id="tabs-profile01" role="tabpanel" aria-labelledby="tabs-profile-tab01">
                        <div class="container mx-auto px-5 py-2 lg:px-32 lg:pt-10 mb-6">
                            <div class="-m-1 flex flex-wrap md:-m-2">
                                @if ($reporte->foto1)
                                    <div class="w-full lg:w-1/3 p-1 md:p-2">
                                        <img alt="gallery"
                                            class="block h-full w-full rounded-lg object-cover object-center"
                                            src="/imagen/{{ $reporte->foto1 }}" />
                                    </div>
                                @endif
                                @if ($reporte->foto2)
                                    <div class="w-full lg:w-1/3 p-1 md:p-2">
                                        <img alt="gallery"
                                            class="block h-full w-full rounded-lg object-cover object-center"
                                            src="/imagen/{{ $reporte->foto2 }}" />
                                    </div>
                                @endif
                                @if ($reporte->foto3)
                                    <div class="w-full lg:w-1/3 p-1 md:p-2">
                                        <img alt="gallery"
                                            class="block h-full w-full rounded-lg object-cover object-center"
                                            src="/imagen/{{ $reporte->foto3 }}" />
                                    </div>
                                @endif
                                @if ($reporte->foto4)
                                    <div class="w-full lg:w-1/3 p-1 md:p-2">
                                        <img alt="gallery"
                                            class="block h-full w-full rounded-lg object-cover object-center"
                                            src="/imagen/{{ $reporte->foto4 }}" />
                                    </div>
                                @endif
                                @if ($reporte->foto5)
                                    <div class="w-full lg:w-1/3 p-1 md:p-2">
                                        <img alt="gallery"
                                            class="block h-full w-full rounded-lg object-cover object-center"
                                            src="/imagen/{{ $reporte->foto5 }}" />
                                    </div>
                                @endif
                                @if ($reporte->foto6)
                                    <div class="w-full lg:w-1/3 p-1 md:p-2">
                                        <img alt="gallery"
                                            class="block h-full w-full rounded-lg object-cover object-center"
                                            src="/imagen/{{ $reporte->foto6 }}" />
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
