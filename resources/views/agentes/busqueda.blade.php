<x-app-layout>

    <x-slot name="header">
        <x-breadcrumb :role="'Agentes'" :reportTitle="'Busquedas'" />
    </x-slot>

    @livewire('search')

</x-app-layout>
