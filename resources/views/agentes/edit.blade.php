<x-app-layout>
    <x-slot name="header">
        <x-breadcrumb :role="'Coordinador'" :reportTitle="'Edicion de Reportes'" />
        <x-back-button route="{{ route('coordinador.index') }}" />
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
                                            <form action="{{ route('reportes.update', $reporte) }}" method="post"
                                                enctype="multipart/form-data" id="myForm">
                                                @method('PUT')
                                                @csrf
                                                <input type="text" hidden id="latitud" name="latitud"
                                                    value="">
                                                <input type="text" hidden id="longitud" name="longitud"
                                                    value="">
                                                <input type="text" hidden name="personal_id"
                                                    value="{{ Auth::user()->personal->id }}">
                                                    @if ($reporte->observaciones)
                                                    <button type="button"
                                                        class="mb-2 inline-block rounded border-2 border-danger px-6 pb-[6px] pt-2 text-xs font-medium uppercase leading-normal text-danger transition duration-150 ease-in-out hover:border-danger-accent-300 hover:bg-danger-50/50 hover:text-danger-accent-300 focus:border-danger-600 focus:bg-danger-50/50 focus:text-danger-600 focus:outline-none focus:ring-0 active:border-danger-700 active:text-danger-700 motion-reduce:transition-none"
                                                        data-twe-toggle="modal" data-twe-target="#exampleModalCenter"
                                                        data-twe-ripple-init data-twe-ripple-color="light">
                                                        Observaciones
                                                    </button>
                                                    @endif
                                                <div class=" mb-3">
                                                    <x-label for='contrato' value='Numero de contrato' class="mb-2" />
                                                    <input type="text"
                                                        class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                                        name="contrato" id="contrato"
                                                        placeholder="Ingrese su Numero de Contrato"
                                                        value="{{ $reporte->contrato }}" readonly>
                                                    <x-input-error for="contrato" />
                                                </div>
                                                <div class=" mb-3">
                                                    <x-label for='medidor' value='Numero de medidor' class="mb-2" />
                                                    <input type="text"
                                                        class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                                        name="medidor" id="medidor"
                                                        placeholder="Ingrese su Numero de Medidor"
                                                        value="{{ $reporte->medidor }}" readonly>
                                                    <x-input-error for="medidor" />
                                                </div>
                                                <div class=" mb-3">
                                                    <x-label for='lectura' value='Numero de lectura' class="mb-2" />
                                                    <input type="number"
                                                        class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                                        name="lectura" id="lectura"
                                                        placeholder="Ingrese su Numero de Lectura"
                                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                        value="{{ $reporte->lectura }}">
                                                    <x-input-error for="lectura" />
                                                </div>
                                                <div class=" mb-3">
                                                    <x-label for='comercio' class="mb-2" value="Tipo de Comercio" />
                                                    <select id="comercio" name="tipo_comercio"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mb-3">
                                                        <option selected>Seleccione tipo de Comercio</option>
                                                        @foreach ($comercios as $id => $nombre)
                                                            <option value="{{ $id }}"
                                                                {{ $reporte->tipo_comercio == $id ? 'selected' : '' }}>
                                                                {{ $nombre }} </option>
                                                        @endforeach
                                                    </select>

                                                    <x-input-error for="comercio" />
                                                    <!-- Añade aquí tu input -->
                                                    <input id="input-comercio" placeholder="Ingrese el tipo de Comercio"
                                                        name="tipo_Comercio" type="text" hidden
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  w-full p-2.5  " />
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
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                            <option selected>Selecione su inposibilidad</option>
                                                            @foreach ($imposibilidad as $id => $nombre)
                                                                <option value="{{ $id }}"
                                                                    {{ $reporte->imposibilidad == $id ? 'selected' : '' }}>
                                                                    {{ $nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                        <x-input-error for="obstaculos" />
                                                    </div>
                                                </div>
                                                <div class="mb-3">

                                                    <div id="video_evidencia" class=" hidden mb-3">
                                                        <label for="video" class="file-label">Video evidencia de
                                                            anomalia
                                                            <input capture="camera"
                                                                class="mb-1 relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none"
                                                                id="video" name="video" type="file"
                                                                accept="video/*"
                                                                aria-describedby="file_input_help7" />
                                                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300"
                                                                id="file_input_video">
                                                                MP4, WebM, QuickTime, AVI, MPEG, WMV .</p>
                                                            <x-input-error for="video" />
                                                        </label>
                                                    </div>

                                                    <div id="fotos_inmueble">
                                                        <label for="foto1" class="file-label">Foto del inmueble
                                                            <input capture="camera"
                                                                class="mb-1 relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none"
                                                                id="foto1" name="foto1" type="file"
                                                                accept="image/*"
                                                                aria-describedby="file_input_help1" />
                                                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300"
                                                                id="file_input_help1">
                                                                SVG,
                                                                PNG, JPG or GIF (MAX. 800x400px).</p>
                                                            <x-input-error for="foto1" />
                                                        </label>
                                                    </div>

                                                    <div class=" flex-wrap gap-2 hidden" id="fotos_evidencia">
                                                        <label for="foto2" class="file-label">Numero de Serial
                                                            <input capture="camera"
                                                                class="mb-1 relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none"
                                                                id="foto2" name="foto2" type="file"
                                                                accept="image/*" aria-describedby="file_input_help" />
                                                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300"
                                                                id="file_input_help2">
                                                                SVG,
                                                                PNG, JPG or GIF (MAX. 800x400px).</p>
                                                            <x-input-error for="foto2" />
                                                        </label>
                                                        <label for="foto3" class="file-label">Numero de Lectura
                                                            <input capture="camera"
                                                                class="mb-1 relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none"
                                                                id="foto3" name="foto3" type="file"
                                                                accept="image/*" aria-describedby="file_input_help" />
                                                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300"
                                                                id="file_input_help3">
                                                                SVG,
                                                                PNG, JPG or GIF (MAX. 800x400px).</p>
                                                            <x-input-error for="foto3" />
                                                        </label>
                                                        <label for="foto4" class="file-label">Numero del medidor
                                                            <input capture="camera"
                                                                class="mb-1 relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none"
                                                                id="foto4" name="foto4" type="file"
                                                                accept="image/*" aria-describedby="file_input_help" />
                                                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300"
                                                                id="file_input_help4">
                                                                SVG,
                                                                PNG, JPG or GIF (MAX. 800x400px).</p>
                                                            <x-input-error for="foto4" />
                                                        </label>
                                                        <label for="foto5" class="file-label">Estado del Medidor
                                                            <input capture="camera"
                                                                class="mb-1 relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none"
                                                                id="foto5" name="foto5" type="file"
                                                                accept="image/*" aria-describedby="file_input_help" />
                                                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300"
                                                                id="file_input_help5">
                                                                SVG,
                                                                PNG, JPG or GIF (MAX. 800x400px).</p>
                                                            <x-input-error for="foto5" />
                                                        </label>
                                                        <label for="foto6" class="file-label">Opcional
                                                            <input capture="camera"
                                                                class="mb-1 relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none"
                                                                id="foto6" name="foto6" type="file"
                                                                accept="image/*" aria-describedby="file_input_help" />
                                                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300"
                                                                id="file_input_help6">
                                                                SVG,
                                                                PNG, JPG or GIF (MAX. 800x400px).</p>
                                                            <x-input-error for="foto6" />
                                                        </label>

                                                    </div>
                                                </div>
                                                <div class="flex items-center">
                                                    <x-button id="submitButton">
                                                        Enviar
                                                    </x-button>
                                                    <span id="progressBar" style="display: none;" class='text-md font-bold text-green-700  animate-pulse ml-2'>
                                                        Cargando Archivos Porfavor Espere.....
                                                    </span>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[twe-tab-active]:block"
                        id="tabs-profile01" role="tabpanel" aria-labelledby="tabs-profile-tab01">
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

                    <!--Vertically centered modal-->
                    <div data-twe-modal-init
                        class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none"
                        id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
                        aria-modal="true" role="dialog">
                        <div data-twe-modal-dialog-ref
                            class="pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[500px]">
                            <div
                                class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-4 outline-none dark:bg-surface-dark">
                                <div
                                    class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 p-4 dark:border-white/10">
                                    <!-- Modal title -->
                                    <h5 class="text-xl font-medium leading-normal text-surface dark:text-white"
                                        id="exampleModalCenterTitle">
                                        Observaciones
                                    </h5>
                                </div>
                                <!-- Modal body -->
                                <div class="relative p-4">
                                    <p>{{$reporte->observaciones}}</p>
                                </div>
                                <!-- Modal footer -->
                                <div
                                    class="flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md border-t-2 border-neutral-100 p-4 dark:border-white/10">
                                    <button type="button"
                                        class="inline-block rounded bg-primary-100 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-200 focus:bg-primary-accent-200 focus:outline-none focus:ring-0 active:bg-primary-accent-200 dark:bg-primary-300 dark:hover:bg-primary-400 dark:focus:bg-primary-400 dark:active:bg-primary-400"
                                        data-twe-modal-dismiss data-twe-ripple-init data-twe-ripple-color="light">
                                        Close
                                    </button>

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
    document.getElementById('obstaculos').addEventListener('change', function() {
        var anomalia = document.getElementById('fotos_evidencia');

        if (this.value == '57') {
            anomalia.classList.remove('hidden');
        } else {
            anomalia.classList.add('hidden');
        }
    });
</script>

<script>
    function validate(id, x) {
        var fileInputHelp = document.getElementById(id);

        if (x.files && x.files[0]) {
            fileInputHelp.textContent = 'Archivo cargado';
            fileInputHelp.classList.add('text-green-500');
        } else {
            fileInputHelp.textContent = 'SVG, PNG, JPG or GIF (MAX. 800x400px).';
            fileInputHelp.classList.remove('text-green-500');
        }
    }

    document.getElementById('foto1').addEventListener('change', function() {
        validate('file_input_help1', this);
    });

    document.getElementById('foto2').addEventListener('change', function() {
        validate('file_input_help2', this);
    });

    document.getElementById('foto3').addEventListener('change', function() {
        validate('file_input_help3', this);
    });

    document.getElementById('foto4').addEventListener('change', function() {
        validate('file_input_help4', this);
    });

    document.getElementById('foto5').addEventListener('change', function() {
        validate('file_input_help5', this);
    });

    document.getElementById('foto6').addEventListener('change', function() {
        validate('file_input_help6', this);
    });
    document.getElementById('video').addEventListener('change', function() {
        validate('file_input_video', this);
    });
</script>

<script>
    document.getElementById('comercio').addEventListener('change', function() {
        var inputComercio = document.getElementById('input-comercio');

        if (this.value == '56') {
            inputComercio.hidden = false;
            inputComercio.name = "tipo_comercio";
            this.name = "";
        } else {
            inputComercio.hidden = true;
            inputComercio.name = "";
            this.name = "tipo_comercio";
        }
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
