<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-gray-800 leading-tight">
                <p class="text-sm">Contrato</p>
                <p class=" uppercase">N°: @if ($reporte->contrato)
                        {{ $reporte->contrato }}
                    @endif
                </p>
            </h2>
            <a href="{{ route('coordinador.index') }}"
                class="inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 motion-reduce:transition-none mb-2">
                <i class="fas fa-arrow-left"></i> Regresar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div id="accordionFlushExample" class="px-4 py-2">
                    <div class="rounded-t-lg border border-neutral-200 bg-white">
                        <h2 class="mb-0" id="flush-headingOne">
                            <button
                                class="group relative flex w-full items-center rounded-none border-1 bg-white px-5 py-4 text-left text-base text-neutral-800 transition [overflow-anchor:none] hover:z-[2] focus:z-[3] focus:outline-none dark:bg-body-dark dark:text-white [&:not([data-twe-collapse-collapsed])]:bg-white [&:not([data-twe-collapse-collapsed])]:text-primary [&:not([data-twe-collapse-collapsed])]:shadow-border-b dark:[&:not([data-twe-collapse-collapsed])]:bg-surface-dark dark:[&:not([data-twe-collapse-collapsed])]:text-primary dark:[&:not([data-twe-collapse-collapsed])]:shadow-white/10 "
                                type="button" data-twe-collapse-init data-twe-target="#flush-collapseOne"
                                aria-expanded="false" aria-controls="flush-collapseOne">
                                Información del contrato
                                <span
                                    class="-me-1 ms-auto h-5 w-5 shrink-0 rotate-[-180deg] transition-transform duration-200 ease-in-out group-data-[twe-collapse-collapsed]:me-0 group-data-[twe-collapse-collapsed]:rotate-0 motion-reduce:transition-none [&>svg]:h-6 [&>svg]:w-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </span>
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="!visible border-0" data-twe-collapse-item
                            data-twe-collapse-show aria-labelledby="flush-headingOne"
                            data-twe-parent="#accordionFlushExample">
                            <div class="px-5 py-4">
                                <div class="grid md:grid-cols-2 grid-cols-1 gap-4">
                                    <div>
                                        <div
                                            class="block mb-3 rounded-lg bg-white p-6 text-surface shadow-secondary-1 dark:bg-surface-dark dark:text-white">
                                            <h5 class="mb-2 text-xl font-medium leading-tight">Numero de Lectura:
                                                {{ $reporte->lectura }}</h5>
                                            <p class="mb-2 text-base">Fecha y Hora: {{ $reporte->created_at }}</p>
                                            <p class="mb-2 text-base">Direccion: {{ $reporte->direccion }}</p>
                                            <p class="mb-2 text-base">Anomalia Detectada: {{ $reporte->AnomaliaReporte->nombre }}</p>
                                            <p class="mb-2 text-base">Imposibilidad:{{$reporte->imposibilidad}} </p>
                                        </div>
                                        <div
                                            class="block rounded-lg bg-white p-6 text-surface shadow-secondary-1 dark:bg-surface-dark dark:text-white">
                                            <h5 class="mb-2 text-xl font-medium leading-tight">Observaciones</h5>
                                            <p class="mb-2 text-base"> {{ $reporte->observaciones }}</p>

                                        </div>
                                    </div>
                                    <div>
                                        <div>
                                            @if ($reporte->estado == 5 || $reporte->estado == 7)

                                            <form action="{{ route('coordinador.update', $reporte) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <input type="text" name="estado" value="" hidden>
                                                <div
                                                    class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                                                    <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
                                                        <textarea id="comment" rows="4" name="observaciones"
                                                            class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                                                            placeholder="Escriba su observacion" @if ($reporte->estado == 6) readonly @endif>

                                                        </textarea>
                                                    </div>
                                                    <div
                                                        class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
                                                        @if ($reporte->estado == 5)
                                                            <button type="submit" onclick="cambiarEstado(7)"
                                                                class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-red-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-red-900 hover:bg-red-800">
                                                                Rechazado
                                                            </button>
                                                        @endif
                                                        @if ($reporte->estado == 5)
                                                            <button type="submit" onclick="cambiarEstado(6)"
                                                                class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-green-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-green-900 hover:bg-green-800">
                                                                Revisado
                                                            </button>
                                                        @endif

                                                    </div>
                                                </div>
                                                <p class="ms-auto text-xs text-gray-500 dark:text-gray-400">Aqui podra
                                                    colocar Las observaciones referentes a esta lectura</p>
                                            </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="rounded-none border border-e-0 border-s-0 border-t-0 border-neutral-200 bg-white dark:border-neutral-600 dark:bg-body-dark">
                            <h2 class="mb-0" id="flush-headingTwo">
                                <button
                                    class="group relative flex w-full items-center rounded-none border-0 bg-white px-5 py-4 text-left text-base text-neutral-800 transition [overflow-anchor:none] hover:z-[2] focus:z-[3] focus:outline-none dark:bg-body-dark dark:text-white [&:not([data-twe-collapse-collapsed])]:bg-white [&:not([data-twe-collapse-collapsed])]:text-primary [&:not([data-twe-collapse-collapsed])]:shadow-border-b dark:[&:not([data-twe-collapse-collapsed])]:bg-surface-dark dark:[&:not([data-twe-collapse-collapsed])]:text-primary dark:[&:not([data-twe-collapse-collapsed])]:shadow-white/10 "
                                    type="button" data-twe-collapse-init data-twe-collapse-collapsed
                                    data-twe-target="#flush-collapseTwo" aria-expanded="false"
                                    aria-controls="flush-collapseTwo">
                                    Fotos de Evidencias
                                    <span
                                        class="-me-1 ms-auto h-5 w-5 shrink-0 rotate-[-180deg] transition-transform duration-200 ease-in-out group-data-[twe-collapse-collapsed]:me-0 group-data-[twe-collapse-collapsed]:rotate-0 motion-reduce:transition-none [&>svg]:h-6 [&>svg]:w-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </span>
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="!visible hidden border-0" data-twe-collapse-item
                                aria-labelledby="flush-headingTwo" data-twe-parent="#accordionFlushExample">
                                {{-- Galery --}}
                                <div class="px-5 py-4">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        @foreach (range(1, 6) as $i)
                                            @if ($reporte->{'foto' . $i})
                                                <img alt="gallery" class="h-auto max-w-full rounded-lg"
                                                    src="/imagen/{{ $reporte->{'foto' . $i} }}" />
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @section('js')
            <script>
                function cambiarEstado(estado) {
                    document.getElementsByName('estado')[0].value = estado;
                }
            </script>
        @endsection
</x-app-layout>
