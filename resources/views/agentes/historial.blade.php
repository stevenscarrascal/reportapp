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
                            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                                <div class="overflow-hidden">
                                    <div class="sm:overflow-x-auto">
                                         <table class="min-w-full text-start text-sm font-light text-surface dark:text-white">
                                            <!-- Encabezado de la tabla -->
                                            <thead class="bg-gray-50 dark:bg-gray-800">
                                                <tr>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Contrato
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Nombres
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Apellidos
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Fecha y hora
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Estado
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Acciones
                                                    </th>
                                                </tr>
                                            </thead>
                                            <!-- Cuerpo de la tabla -->
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                @foreach ($historiales as $historial)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">{{ $historial->contrato }}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">{{ $historial->personal->nombres }}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">{{ $historial->personal->apellidos }}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">{{ $historial->created_at }}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
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
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                        <a href="{{ route('reportes.show', $historial) }}"
                                                            class="bg-blue-600 text-white hover:text-blue-800 mr-1 rounded px-4 py-1">Ver</a>
                                                        @if ($historial->estado == 9)
                                                            <a href="{{ route('reportes.edit', $historial) }}"
                                                                class="bg-red-600 hover:text-red-900 rounded px-2 py-1 text-white ">Editar</a>
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
    </div>

</x-app-layout>
