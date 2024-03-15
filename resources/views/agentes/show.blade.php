<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Registro de Contrato N°:@if ($reporte->contrato)
                {{ $reporte->contrato }}
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!--Tabs navigation-->
                <ul class="mb-5 flex list-none flex-row flex-wrap border-b-0 ps-0" role="tablist" data-twe-nav-ref>
                    <li role="presentation" class="flex-auto text-center">
                        <a href="#tabs-home01"
                            class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[twe-nav-active]:border-primary data-[twe-nav-active]:text-primary dark:text-white/50 dark:hover:bg-neutral-700/60 dark:data-[twe-nav-active]:text-primary"
                            data-twe-toggle="pill" data-twe-target="#tabs-home01" data-twe-nav-active role="tab"
                            aria-controls="tabs-home01" aria-selected="true">Informacion</a>
                    </li>
                    <li role="presentation" class="flex-auto text-center">
                        <a href="#tabs-profile01"
                            class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[twe-nav-active]:border-primary data-[twe-nav-active]:text-primary dark:text-white/50 dark:hover:bg-neutral-700/60 dark:data-[twe-nav-active]:text-primary"
                            data-twe-toggle="pill" data-twe-target="#tabs-profile01" role="tab"
                            aria-controls="tabs-profile01" aria-selected="false">Fotos</a>
                    </li>
                    <li role="presentation" class="flex-auto text-center">
                        <a href="{{ route('reportes.create') }}"
                            class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[twe-nav-active]:border-primary data-[twe-nav-active]:text-primary dark:text-white/50 dark:hover:bg-neutral-700/60 dark:data-[twe-nav-active]:text-primary"
                            role="tab">regresar</a>
                    </li>

                </ul>

                <!--Tabs content-->
                <div class="mb-6">
                    <div class="hidden opacity-100 transition-opacity duration-150 ease-linear data-[twe-tab-active]:block"
                        id="tabs-home01" role="tabpanel" aria-labelledby="tabs-home-tab01" data-twe-tab-active>
                        <div>
                            <div class="flex flex-col">
                                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                                        <div class="overflow-hidden px-6">

                                            <table
                                                class="min-w-full  table-auto border border-neutral-200 text-center text-sm font-light text-surface">
                                                <thead
                                                    class="border-b border-neutral-200 font-medium dark:border-white/10">
                                                    <tr>
                                                        <th scope="col"
                                                            class="border-e border-neutral-200 px-6 py-4 dark:border-white/10">
                                                            Lectura
                                                        </th>
                                                        <th scope="col"
                                                            class="border-e border-neutral-200 px-6 py-4 dark:border-white/10">
                                                            Fecha
                                                        </th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="border-b border-neutral-200 dark:border-white/10">

                                                        <td
                                                            class="whitespace-nowrap border-e border-neutral-200 px-6 py-4 dark:border-white/10">
                                                            {{ $reporte->lectura }}
                                                        </td>
                                                        <td
                                                            class="whitespace-nowrap border-e border-neutral-200 px-6 py-4 dark:border-white/10">
                                                            {{ $reporte->created_at }}
                                                        </td>

                                                    </tr>

                                                    <tr class="border-b border-neutral-200 dark:border-white/10">

                                                        <td colspan="2"
                                                            class="whitespace-nowrap border-e border-neutral-200 px-6 py-4 dark:border-white/10">
                                                            <dl class=" font-normal items-center">
                                                                <dt class=" text-black"> <strong>Observacion</strong>
                                                                </dt>
                                                                <dd class=" text-black">{{ $reporte->observaciones }}</dd>
                                                            </dl>
                                                        </td>

                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
