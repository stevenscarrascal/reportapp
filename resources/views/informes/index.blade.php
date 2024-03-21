<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-gray-800 leading-tight">
                {{ __('Informes') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class=" mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-3 gap-4">
                        <div class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:max-w-xl">
                            <div style="width:100%;">
                                {!! $chartjs->render() !!}
                            </div>
                        </div>
                        <div class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:max-w-xl">
                            <div style="width:100%;">
                                {!! $chartjs2->render() !!}
                            </div>
                        </div>
                        <div class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:max-w-xl">
                            <div style="width:60%;">
                                {!! $chartjs3->render() !!}
                            </div>
                        </div>

                    </div>

                    <div class="grid grid-cols-2 gap-4 mt-4">
                        <div class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:max-w-xl">
                           
                        </div>
                        <!-- Añade aquí tus gráficos para la cuadrícula de 2 columnas -->
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
