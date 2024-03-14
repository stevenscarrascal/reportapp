<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Historial de Registros') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8 overflow-x-auto">
                                <div class="overflow-hidden">
                                    <table class="text-start text-sm font-light table-auto text-surface md:table-fixed w-full ">
                                        <!-- Encabezado de la tabla -->
                                        <thead class="bg-gray-50 w-auto">
                                            <tr>
                                                <th scope="col" class="px-4 py-3 sm:px-6 lg:px-8 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Contrato
                                                </th>
                                                <th scope="col" class=" hidden sm:table-cell px-4 py-3 sm:px-6 lg:px-8 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Fecha y hora
                                                </th>
                                                <th scope="col" class="px-2 py-3 sm:px-6 lg:px-8 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Estado
                                                </th>
                                                <th scope="col" class="px-2 py-3 sm:px-6 lg:px-8 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                   <p class="hidden sm:table-cell">Accion</p>
                                                </th>
                                            </tr>
                                        </thead>
                                        <!-- Cuerpo de la tabla -->
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($historiales as $historial)
                                            <tr>
                                                <td class="px-4 py-4 sm:px-6 lg:px-8 whitespace-nowrap">
                                                    <div class=" font-medium text-sm text-black">N° {{ $historial->contrato }}</div>
                                                    <dl class="sm:hidden font-normal">
                                                        <dt class=" text-gray-500">Fecha y hora</dt>
                                                        <dd class=" text-gray-500">{{ $historial->created_at }}</dd>
                                                    </dl>
                                                </td>
                                                <td class=" hidden sm:table-cell px-4 py-4 sm:px-6 lg:px-8 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $historial->created_at }}</div>
                                                </td>
                                                <td class="px-4 py-4 sm:px-6 lg:px-8 whitespace-nowrap">
                                                    @switch($historial->EstadoReporte->id)
                                                        @case(7)
                                                            <strong class="text-white bg-yellow-500 rounded px-2 py-1">
                                                                {{ $historial->EstadoReporte->nombre }}
                                                            </strong>
                                                        @break
                                                        @case(8)
                                                            <strong class="text-white bg-green-500 rounded px-2 py-1">
                                                                {{ $historial->EstadoReporte->nombre }}
                                                            </strong>
                                                        @break
                                                        @case(9)
                                                            <strong class="text-white bg-red-500 rounded px-2 py-1">
                                                                {{ $historial->EstadoReporte->nombre }}
                                                            </strong>
                                                        @break
                                                        @default
                                                            {{ $historial->EstadoReporte->nombre }}
                                                    @endswitch
                                                </td>
                                                <td class=" lg:px-8  py-2 text-sm w-auto">
                                                    <a href="{{ route('reportes.show', $historial->id) }}" class="bg-blue-600 text-white hover:text-blue-800 mr-1 rounded px-4 py-1 inline-block sm:px-2 sm:py-2 mb-1">Ver</a>
                                                    @if ($historial->estado == 9)
                                                        <a href="{{ route('reportes.edit', $historial->id) }}" class="bg-red-600 hover:text-red-900 rounded px-2 py-1 inline-block sm:px-2 sm:py-2 text-white">Editar</a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
