<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-gray-800 leading-tight">
                {{ __('Agentes de Campo') }}
            </h2>
            <a href="{{ route('personals.index') }}"
                class="inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 motion-reduce:transition-none mb-2">
                <i class="fas fa-arrow-left"></i> Regresar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class=" mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <form action="{{ route('personals.update' , $personal->id) }}" method="POST" class="mt-3">
                        @method('PUT')
                        @csrf
                        <div class="px-4">
                            <div class="grid gap-6 mb-6 md:grid-cols-2 px-4">
                                <div>
                                    <label for="tipo_documento"
                                        class="block mb-2 text-sm font-medium text-gray-900">Tipo de
                                        Documento</label>
                                    <select id="tipo_documento" name="tipo_documento"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option>Seleccione su tipo de documento</option>
                                        @foreach ($tipodocumento as $id => $nombre)
                                            <option value="{{ $id }}"
                                                {{ $personal->tipodocumento->id == $id ? 'selected' : '' }}>
                                                {{ $nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="numero_documento"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numero de
                                        Documento</label>
                                    <input type="text" id="numero_documento" name="numero_documento"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Ingrese su numero de documento"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                        value="{{ $personal->numero_documento }}" />
                                </div>
                                <div>
                                    <label for="nombres"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombres</label>
                                    <input type="text" id="nombres" name="nombres" value="{{ $personal->nombres }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="ingrese Nombres Completos" />
                                </div>
                                <div>
                                    <label for="apellidos"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apellidos</label>
                                    <input type="text" id="apellidos" name="apellidos"
                                        value="{{ $personal->apellidos }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Ingrese sus Apellidos Completos" />
                                </div>
                                <div>
                                    <label for="phone-input"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numero de
                                        Telefono:</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 19 18">
                                                <path
                                                    d="M18 13.446a3.02 3.02 0 0 0-.946-1.985l-1.4-1.4a3.054 3.054 0 0 0-4.218 0l-.7.7a.983.983 0 0 1-1.39 0l-2.1-2.1a.983.983 0 0 1 0-1.389l.7-.7a2.98 2.98 0 0 0 0-4.217l-1.4-1.4a2.824 2.824 0 0 0-4.218 0c-3.619 3.619-3 8.229 1.752 12.979C6.785 16.639 9.45 18 11.912 18a7.175 7.175 0 0 0 5.139-2.325A2.9 2.9 0 0 0 18 13.446Z" />
                                            </svg>
                                        </div>
                                        <input type="text" id="phone-input" name="telefono"
                                            value="{{ $personal->telefono }}" aria-describedby="helper-text-explanation"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                            placeholder="123-456-7890" />
                                    </div>
                                </div>
                                <div>
                                    <label for="rol"
                                        class="block mb-2 text-sm font-medium text-gray-900">Cargos</label>
                                    <select id="rol" name="rol"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option>Seleccione su Cargo</option>
                                        @foreach ($roles as $id => $name)
                                            <option value="{{ $id }}"
                                                {{ is_array($userRoles) && in_array($id, $userRoles) ? 'selected' : '' }}>
                                                {{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-6 px-4">
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" >Correo
                                    Electronico - Usuario</label>
                                <input type="email" id="email" name="correo" value="{{ $personal->correo }}" readonly
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="example@company.com" />
                            </div>
                            <div class="mb-6 px-4">
                                <label for="password"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
                                <input type="password" id="password" name="password"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="•••••••••" readonly value="" />
                            </div>

                        </div>
                        <div
                            class="flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md border-t-2 border-neutral-100 p-4 dark:border-white/10">
                            <button type="button"
                                class="inline-block rounded bg-primary-100 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-200 focus:bg-primary-accent-200 focus:outline-none focus:ring-0 active:bg-primary-accent-200 dark:bg-primary-300 dark:hover:bg-primary-400 dark:focus:bg-primary-400 dark:active:bg-primary-400"
                                data-twe-modal-dismiss data-twe-ripple-init data-twe-ripple-color="light">
                                Cancelar
                            </button>
                            <button type="submit"
                                class="ms-1 inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong"
                                data-twe-ripple-init data-twe-ripple-color="light">
                                Gruardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
