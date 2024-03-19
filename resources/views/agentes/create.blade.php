<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Registro de Leturas') }}
            </h2>
            <a href="{{ route('reportes.index') }}"
                class="inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 motion-reduce:transition-none mb-2">
                <i class="fas fa-arrow-left"></i> Regresar
            </a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <h1 class="mt-8 text-2xl font-medium text-gray-900 text-center mb-5">
                        TOMA DE LECTURA COMERCIO ZONA MONTERIA
                    </h1>
                    <form action="{{ route('reportes.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="text" hidden id="latitud" name="latitud" value="">
                        <input type="text" hidden id="longitud" name="longitud" value="">
                        <input type="text" hidden name="personal_id" value="{{ Auth::user()->personal->id }}">

                        <div class=" mb-3">
                            <x-label for='contrato' value='Numero de contrato' class="mb-2" />
                            <input type="text"
                                class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                name="contrato" id="contrato" placeholder="Ingrese su Numero de Contrato"
                                value="{{ old('contrato') }}">
                            <x-input-error for="contrato" />
                        </div>
                        <div class=" mb-3">
                            <x-label for='medidor' value='Numero de medidor' class="mb-2" />
                            <input type="text"
                                class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                name="medidor" id="medidor" placeholder="Ingrese su Numero de Medidor"
                                value="{{ old('medidor') }}">
                            <x-input-error for="medidor" />
                        </div>
                        <div class=" mb-3">
                            <x-label for='lectura' value='Numero de lectura' class="mb-2" />
                            <input type="text"
                                class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                name="lectura" id="lectura" placeholder="Ingrese su Numero de Lectura"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="{{ old('lectura') }}">
                            <x-input-error for="lectura" />
                        </div>
                        <div class=" mb-3">
                            <label for="countries"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Opciones de Anomalia</label>
                            <select id="countries" name="anomalia"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Seleccione Su Anomalia</option>
                                <option value="US">United States</option>
                                <option value="CA">Canada</option>
                                <option value="FR">France</option>
                                <option value="DE">Germany</option>
                            </select>

                            <x-input-error for="anomalia" />
                        </div>
                        <div class="mb-4">
                            <label for="obstaculo" class="mb-4">Imposibilidad de toma de
                                Lectura</label>
                            <div class="mb-3">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    {{-- ninguna --}}
                                    <label for="obstaculo">
                                        <input type="radio" name="imposibilidad" id="obstaculo" value="ninguna"
                                            class="px-2 mb-1">
                                        Ninguna
                                    </label>
                                    {{-- obstaculos --}}
                                    <label for="obstaculo">
                                        <input type="radio" name="imposibilidad" id="obstaculo" value="obstaculo"
                                            class="px-2 mb-1">
                                        Obstaculos
                                    </label>
                                    {{-- rejas --}}
                                    <label>
                                        <input type="radio" name="imposibilidad" id="reja" value="reja"
                                            class="px-2 mb-1">
                                        Rejas
                                    </label>
                                    {{-- no medidor --}}
                                    <label>
                                        <input type="radio" name="imposibilidad" id="medidor" value="medidor"
                                            class="px-2 mb-1">
                                        Sin Medidor
                                    </label>
                                    {{-- usuario no lectura --}}
                                    <label>
                                        <input type="radio" name="imposibilidad" id="lectura_m" value="lectura"
                                            class="px-2">
                                        Usuario no Permite Lectura
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="flex flex-wrap gap-2">
                                <label for="foto1" class="file-label">Foto del inmueble
                                    <input capture="camera"
                                        class="mb-1 relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none"
                                        id="foto1" name="foto1" type="file" accept="image/*" />
                                    <x-input-error for="foto1" />
                                </label>
                                <label for="foto2" class="file-label">Numero de Serial
                                    <input capture="camera"
                                        class="mb-1 relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none"
                                        id="foto2" name="foto2" type="file" accept="image/*" />
                                    <x-input-error for="foto2" />
                                </label>
                                <label for="foto3" class="file-label">Numero de Lectura
                                    <input capture="camera"
                                        class="mb-1 relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none"
                                        id="foto3" name="foto3" type="file" accept="image/*" />
                                    <x-input-error for="foto3" />
                                </label>
                                <label for="foto4" class="file-label">Numero del medidor
                                    <input capture="camera"
                                        class="mb-1 relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none"
                                        id="foto4" name="foto4" type="file" accept="image/*" />
                                    <x-input-error for="foto4" />
                                </label>
                                <label for="foto5" class="file-label">Estado del Medidor
                                    <input capture="camera"
                                        class="mb-1 relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none"
                                        id="foto5" name="foto5" type="file" accept="image/*" />
                                    <x-input-error for="foto5" />
                                </label>
                                <label for="foto6" class="file-label">Opcional
                                    <input capture="camera"
                                        class="mb-1 relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none"
                                        id="foto6" name="foto6" type="file" accept="image/*" />
                                    <x-input-error for="foto6" />
                                </label>
                            </div>
                        </div>
                        <x-button>
                            Enviar
                        </x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @section('js')
        <script>
            // Obtén todos los botones de radio, los campos de entrada de archivos y las etiquetas
            var radios = document.querySelectorAll('input[type=radio][name="imposibilidad"]');
            var fileInputs = document.querySelectorAll('input[type=file]');
            var fileLabels = document.querySelectorAll('.file-label');

            // Función para manejar el cambio de estado de los botones de radio
            function handleRadioChange(event) {
                // Si el valor del botón de radio es 'ninguna', muestra todos los campos de entrada de archivos y sus etiquetas
                if (event.target.value === 'ninguna') {
                    fileInputs.forEach(function(input) {
                        input.style.display = 'block';
                    });
                    fileLabels.forEach(function(label) {
                        label.style.display = 'block';
                    });
                } else {
                    // De lo contrario, solo muestra el primer campo de entrada de archivos y su etiqueta
                    fileInputs.forEach(function(input, index) {
                        if (index === 0) {
                            input.style.display = 'block';
                        } else {
                            input.style.display = 'none';
                        }
                    });
                    fileLabels.forEach(function(label, index) {
                        if (index === 0) {
                            label.style.display = 'block';
                        } else {
                            label.style.display = 'none';
                        }
                    });
                }
            }

            // Agrega el controlador de eventos a todos los botones de radio
            radios.forEach(function(radio) {
                radio.addEventListener('change', handleRadioChange);
            });

            // Oculta todos los campos de entrada de archivos y sus etiquetas cuando la página se carga por primera vez
            document.addEventListener('DOMContentLoaded', function() {
                fileInputs.forEach(function(input) {
                    input.style.display = 'none';
                });
                fileLabels.forEach(function(label) {
                    label.style.display = 'none';
                });
            });
        </script>
        <script>
            // Función para manejar la obtención de la ubicación actual
            function obtenerUbicacion() {
                navigator.geolocation.getCurrentPosition(function(position) {
                    // Obtener latitud y longitud
                    var latitud = position.coords.latitude;
                    var longitud = position.coords.longitude;

                    // Colocar latitud y longitud en los elementos de entrada
                    document.getElementById('latitud').value = latitud;
                    document.getElementById('longitud').value = longitud;
                });
            }
            // Llamar a la función para obtener la ubicación al cargar la página
            window.onload = obtenerUbicacion;
        </script>
    @endsection
</x-app-layout>
