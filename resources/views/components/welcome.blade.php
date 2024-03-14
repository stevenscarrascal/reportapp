<div class="p-6 lg:p-8 bg-white border-b border-gray-200">


    <h1 class="mt-8 text-2xl font-medium text-gray-900 text-center mb-5">
        TOMA DE LECTURA COMERCIO ZONA MONTERIA
    </h1>
    <form action="{{ route('reportes.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class=" mb-3">
            <x-label for='contrato' value='Numero de contrato' class="mb-2" />
            <input type="text"
                class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                name="contrato" id="contrato" placeholder="Ingrese su Numero de Contrato"
                oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="{{ old('contrato') }}">
            <x-input-error for="contrato" />
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
            <x-label for='anomalia' value='Observacion de Anomalia' class=" mb-2" />
            <textarea name="anomalia" id="anomalia" rows="5"
                class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                placeholder="Ingrese su Observacion"></textarea>
            <x-input-error for="anomalia" />
        </div>
        <div class="mb-3">
            <x-label for="obstaculo" value="Imposibilidad de toma de lecturas" class="mb-2" />
            <div class="">
                {{-- obstaculos --}}
                <div>
                    <label for="obstaculo">
                        <input type="radio" name="motivo" id="obstaculo" value="obstaculo" class="px-2 mb-1">
                        Obstaculos
                    </label>
                </div>
                {{-- rejas --}}
                <div>
                    <label>
                        <input type="radio" name="motivo" id="reja" value="reja" class="px-2 mb-1">
                        Rejas
                    </label>
                </div>
                {{-- no medidor --}}
                <div>
                    <label>
                        <input type="radio" name="motivo" id="medidor" value="medidor" class="px-2 mb-1">
                        Sin Medidor
                    </label>
                </div>
                {{-- usuario no lectura --}}
                <div>
                    <label>
                        <input type="radio" name="motivo" id="lectura_m" value="lectura" class="px-2">
                        Usuario no Permite Lectura
                    </label>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <x-label for="foto1" value="Fotos de Observacion" class="mb-2" />
           <div id="image">
                <input
                    class="mb-1 relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none"
                    name="foto1" type="file" accept="image/*" />
                <x-input-error for="foto1" />
                <input
                    class="mb-1 relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none"
                    name="foto2" type="file" accept="image/*" />
                <x-input-error for="foto2" />
                <input
                    class="mb-1 relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none"
                    name="foto3" type="file" accept="image/*" />
                <x-input-error for="foto3" />
                <input
                    class="mb-1 relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none"
                    name="foto4" type="file" accept="image/*" />
                <x-input-error for="foto4" />
                <input
                    class="mb-1 relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent bg-clip-padding px-3 py-[0.32rem] text-xs font-normal text-surface transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 focus:shadow-inset focus:outline-none"
                    name="foto5" type="file" accept="image/*" />
                <x-input-error for="foto5" />
            </div>
        </div>
        <x-button class="mb-3">
            Enviar
        </x-button>
    </form>
</div>

