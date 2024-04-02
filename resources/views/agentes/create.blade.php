<x-app-layout>
    <x-slot name="header">
        <x-breadcrumb :role="'Coordinador'" :reportTitle="'Creacion de Reportes'" />
        <x-back-button route="{{ route('reportes.index') }}" />
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <h1 class="mt-8 text-2xl font-medium text-gray-900 text-center mb-5">
                        TOMA DE LECTURA
                    </h1>
                    <form action="{{ route('reportes.store') }}" method="post" enctype="multipart/form-data"
                        id="myForm">
                        @csrf
                        <input type="text" hidden id="latitud" name="latitud" value="">
                        <input type="text" hidden id="longitud" name="longitud" value="">
                        <input type="text" hidden name="personal_id" value="{{ Auth::user()->personal->id }}">

                        <div class=" mb-3">
                            <x-label for='contrato' value='Numero de contrato' class="mb-2" />
                            <input type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                name="contrato" id="contrato" placeholder="Ingrese su Numero de Contrato"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="{{ old('contrato') }}"  inputmode="numeric">
                            <x-input-error for="contrato" />
                        </div>
                        <div class=" mb-3">
                            <x-label for='medidor' value='Numero de medidor' class="mb-2" />
                            <input type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                name="medidor" id="medidor" placeholder="Ingrese su Numero de Medidor"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="{{ old('medidor') }}"  inputmode="numeric">
                            <x-input-error for="medidor" />
                        </div>
                        <div class=" mb-3">
                            <x-label for='lectura' value='Numero de lectura' class="mb-2" />
                            <input type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                name="lectura" id="lectura" placeholder="Ingrese su Numero de Lectura"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="{{ old('lectura') }}" inputmode="numeric">
                            <x-input-error for="lectura" />
                        </div>
                        <div class=" mb-3">
                            <x-label for='comercio' class="mb-2" value="Tipo de Comercios" />
                            <select id="comercio" name="tipo_comercio"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mb-3">
                                <option selected disabled>Seleccione tipo de Comercio</option>
                                @foreach ($comercios as $id => $nombre)
                                    <option value="{{ $id }}">{{ $nombre }}</option>
                                @endforeach
                            </select>
                            <x-input-error for="comercio" />
                            <div id="div-comercio-nuevo" style="display: none;" class=" flex">
                                <input type="text" name="nueva_opcion" id="nueva_opcion"
                                    class="w-1/2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <button type="button" data-twe-ripple-init data-twe-ripple-color="light"
                                    id="agregarOpcionBtn"
                                    class="inline-block rounded-full bg-primary p-2 uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 motion-reduce:transition-none">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class=" mb-3">
                            <label for="anomalia"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Opciones de
                                Anomalia</label>
                            <select id="anomalia" name="anomalia[]" multiple="multiple"
                                class="select2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mb-3"
                                placeholder="Seleccione su Anomalia">
                                @foreach ($anomalias as $id => $nombre)
                                    <option value="{{ $id }}">{{ $nombre }}</option>
                                @endforeach
                            </select>
                            <x-input-error for="anomalia" />
                        </div>
                        <div class="mb-4">
                            <label for="obstaculos" class="mb-4">Imposibilidad de toma de
                                Lectura</label>
                            <div class="mb-3">
                                <select id="obstaculos" name="imposibilidad"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option selected disabled>Selecione su imposibilidad</option>
                                    @foreach ($imposibilidad as $id => $nombre)
                                        <option value="{{ $id }}">{{ $nombre }}</option>
                                    @endforeach
                                </select>
                                <x-input-error for="obstaculos" />
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="mb-3">
                                <label for="comentarios"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Observaciones</label>
                                <textarea id="comentarios" name="comentarios" rows="4"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"></textarea>
                                <x-input-error for="comentarios" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <div id="video_evidencia" class=" hidden mb-3">
                                <label for="foto7" id="label_help7"
                                    class="flex flex-col items-center w-full max-w-lg p-5 mx-auto mt-2 text-center bg-white border-2 border-gray-300 border-dashed cursor-pointer dark:bg-gray-900 dark:border-gray-700 rounded-xl">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="w-8 h-8 text-gray-500 dark:text-gray-400">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                    </svg>
                                    <h2
                                        class="mt-1 font-medium tracking-wide text-gray-700 dark:text-gray-200">
                                        Video de Anomalia</h2>
                                    <p id="elemento_7"
                                        class="mt-2 text-xs tracking-wide text-gray-500 dark:text-gray-400">
                                        sube tu video en formato MP4 </p>
                                    <input id="foto7" name="video" type="file" class="hidden"
                                        accept="video/*" />
                                </label>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <!-- Elemento 1 -->
                                <div>
                                    <div>
                                        <label for="foto1" id="label_help1"
                                            class="flex flex-col items-center w-full max-w-lg p-5 mx-auto mt-2 text-center bg-white border-2 border-gray-300 border-dashed cursor-pointer dark:bg-gray-900 dark:border-gray-700 rounded-xl">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-8 h-8 text-gray-500 dark:text-gray-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                            </svg>
                                            <h2
                                                class="mt-1 font-medium tracking-wide text-gray-700 dark:text-gray-200">
                                                Foto del Inmueble</h2>
                                            <p id="elemento_1"
                                                class="mt-2 text-xs tracking-wide text-gray-500 dark:text-gray-400">
                                                sube la foto en formato JPEG </p>
                                            <input id="foto1" name="foto1" type="file" class="hidden"
                                                accept="image/*;camara=user" />
                                                <x-input-error for="foto1" />
                                        </label>
                                    </div>
                                </div>
                                <!-- Elemento 2 -->
                                <div>
                                    <div>
                                        <label for="foto2" id="label_help2"
                                            class="flex flex-col items-center w-full max-w-lg p-5 mx-auto mt-2 text-center bg-white border-2 border-gray-300 border-dashed cursor-pointer dark:bg-gray-900 dark:border-gray-700 rounded-xl">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-8 h-8 text-gray-500 dark:text-gray-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                            </svg>
                                            <h2
                                                class="mt-1 font-medium tracking-wide text-gray-700 dark:text-gray-200">
                                                Numero de Serial</h2>

                                            <p id="elemento_2"
                                                class="mt-2 text-xs tracking-wide text-gray-500 dark:text-gray-400">
                                                Realiza la foto en formato JPEG </p>

                                            <input id="foto2" name="foto2" type="file" class="hidden"
                                                capture="camera" accept="image/*" />
                                        </label>
                                    </div>
                                </div>
                                <!-- Elemento 3 -->
                                <div>
                                    <div>
                                        <label for="foto3" id="label_help3"
                                            class="flex flex-col items-center w-full max-w-lg p-5 mx-auto mt-2 text-center bg-white border-2 border-gray-300 border-dashed cursor-pointer dark:bg-gray-900 dark:border-gray-700 rounded-xl">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-8 h-8 text-gray-500 dark:text-gray-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                            </svg>
                                            <h2
                                                class="mt-1 font-medium tracking-wide text-gray-700 dark:text-gray-200">
                                                Numero de Lectura</h2>

                                            <p id="elemento_3"
                                                class="mt-2 text-xs tracking-wide text-gray-500 dark:text-gray-400">
                                                Realiza la foto en formato JPEG </p>

                                            <input id="foto3" name="foto3" type="file" class="hidden"
                                                capture="camera" accept="image/*" />
                                        </label>
                                    </div>
                                </div>
                                <!-- Elemento 4 -->
                                <div>
                                    <div>
                                        <label for="foto4" id="label_help4"
                                            class="flex flex-col items-center w-full max-w-lg p-5 mx-auto mt-2 text-center bg-white border-2 border-gray-300 border-dashed cursor-pointer dark:bg-gray-900 dark:border-gray-700 rounded-xl">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-8 h-8 text-gray-500 dark:text-gray-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                            </svg>
                                            <h2
                                                class="mt-1 font-medium tracking-wide text-gray-700 dark:text-gray-200">
                                                Numero del Medidor</h2>

                                            <p id="elemento_4"
                                                class="mt-2 text-xs tracking-wide text-gray-500 dark:text-gray-400">
                                                Realiza la foto en formato JPEG </p>

                                            <input id="foto4" name="foto4" type="file" class="hidden"
                                                capture="camera" accept="image/*" />
                                        </label>
                                    </div>
                                </div>
                                <!-- Elemento 5 -->
                                <div>
                                    <div>
                                        <label for="foto5" id="label_help5"
                                            class="flex flex-col items-center w-full max-w-lg p-5 mx-auto mt-2 text-center bg-white border-2 border-gray-300 border-dashed cursor-pointer dark:bg-gray-900 dark:border-gray-700 rounded-xl">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-8 h-8 text-gray-500 dark:text-gray-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                            </svg>
                                            <h2
                                                class="mt-1 font-medium tracking-wide text-gray-700 dark:text-gray-200">
                                                Estado del Medidor</h2>

                                            <p id="elemento_5"
                                                class="mt-2 text-xs tracking-wide text-gray-500 dark:text-gray-400">
                                                Realiza la foto en formato JPEG </p>

                                            <input id="foto5" name="foto5" type="file" class="hidden"
                                                capture="camera" accept="image/*" />
                                        </label>
                                    </div>
                                </div>
                                <!-- Elemento 6 -->
                                <div>
                                    <div>
                                        <label for="foto6" id="label_help6"
                                            class="flex flex-col items-center w-full max-w-lg p-5 mx-auto mt-2 text-center bg-white border-2 border-gray-300 border-dashed cursor-pointer dark:bg-gray-900 dark:border-gray-700 rounded-xl">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-8 h-8 text-gray-500 dark:text-gray-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                            </svg>
                                            <h2
                                                class="mt-1 font-medium tracking-wide text-gray-700 dark:text-gray-200">
                                                Opcional</h2>

                                            <p id="elemento_6"
                                                class="mt-2 text-xs tracking-wide text-gray-500 dark:text-gray-400">
                                                Realiza la foto en formato JPEG </p>

                                            <input id="foto6" name="foto6" type="file" class="hidden"
                                                capture="camera" accept="image/*" />
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <x-button id="submitButton">
                                Enviar
                            </x-button>
                            <span id="progressBar" style="display: none;"
                                class='text-md font-bold text-green-700  animate-pulse ml-2'>
                                Cargando Archivos Porfavor Espere.....
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @section('js')
        <script>
            document.getElementById("comercio").addEventListener("change", function() {
                var divComercioNuevo = document.getElementById("div-comercio-nuevo");
                if (this.value == "19") {
                    divComercioNuevo.style.display = "block";
                } else {
                    divComercioNuevo.style.display = "none";
                }
            });
        </script>

        <script>
            $(document).ready(function() {

                $('#agregarOpcionBtn').click(function(e) {
                    e.preventDefault();

                    var nuevaOpcion = $('#nueva_opcion').val();

                    $.ajax({
                        url: '/addcomercio', // Reemplaza esto con la ruta correcta
                        type: 'POST',
                        data: {
                            nombre: nuevaOpcion,
                            _token: '{{ csrf_token() }}' // Asegúrate de que esto esté en tu archivo blade
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    title: "Exito!",
                                    text: "Nuevo Comecio Agregado Exitosamente",
                                    icon: "success"
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload(); // Recarga la página
                                    }
                                });
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            // Aquí puedes manejar los errores
                            console.error(textStatus, errorThrown);
                        }
                    });
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $('#submitButton').click(function() {
                    $('#submitButton').prop('disabled', true);
                    $('#submitButton').css('background-color', '#D3D3D3');
                    $('#progressBar').css('display', 'block');
                    $('#myForm').submit();
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('.select2').select2();
            });
        </script>
        <script>
            $(document).ready(function() {
                var alertShown = false; // Variable de control

                $('#anomalia').on('select2:select', function(e) {
                    var anomalia = document.getElementById('video_evidencia');
                    var values = $(this).val();

                    if (values.includes('8')) {
                        anomalia.classList.add('hidden');
                        alertShown = false; // Resetea la variable de control cuando se selecciona '8'
                    } else if (!alertShown) { // Solo muestra el alerta si no se ha mostrado antes
                        Swal.fire({
                            title: "Anomalia?",
                            text: "Debes Subir el Video de Evidencia de la Anomalia",
                            icon: "question"
                        });
                        anomalia.classList.remove('hidden');
                        alertShown =
                            true; // Marca la variable de control como verdadera después de mostrar el alerta
                    }
                });
            });
        </script>

        <script>
            for (let i = 1; i <= 7; i++) {
                const fileInput = document.getElementById(`foto${i}`);
                const fileInputHelp = document.getElementById(`elemento_${i}`);
                const labelHelp = document.getElementById(`label_help${i}`);
                const originalText = fileInputHelp.innerText;

                fileInput.addEventListener('change', function() {
                    if (this.files && this.files[0]) {
                        fileInputHelp.innerText = 'Archivo cargado.';
                        fileInputHelp.style.color = 'white';
                        labelHelp.classList.remove('bg-white');
                        labelHelp.classList.add('bg-green-500');
                    } else {
                        fileInputHelp.innerText = originalText;
                        fileInputHelp.style.color = 'initial';
                        labelHelp.classList.remove('bg-green-500');
                        labelHelp.classList.add('bg-white');
                    }
                });
            }
        </script>
        <script>
            function obtenerUbicacion() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        // Obtener latitud y longitud
                        var latitud = position.coords.latitude;
                        var longitud = position.coords.longitude;

                        // Colocar latitud y longitud en los elementos de entrada
                        document.getElementById('latitud').value = latitud;
                        document.getElementById('longitud').value = longitud;
                    }, function(error) {
                        // Manejar los errores
                        switch (error.code) {
                            case error.PERMISSION_DENIED:
                                alert("El usuario no permitió la solicitud de geolocalización.");
                                break;
                            case error.POSITION_UNAVAILABLE:
                                alert("La información de ubicación no está disponible.");
                                break;
                            case error.TIMEOUT:
                                alert("La solicitud para obtener la ubicación del usuario ha expirado.");
                                break;
                            case error.UNKNOWN_ERROR:
                                alert("Ha ocurrido un error desconocido.");
                                break;
                        }
                    });
                } else {
                    alert("Geolocalización no es soportada por este navegador.");
                }
            }

            // Llamar a la función para obtener la ubicación al cargar la página
            window.onload = obtenerUbicacion;
        </script>
    @endsection
</x-app-layout>
