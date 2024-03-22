<!-- resources/views/components/breadcrumb.blade.php -->
<ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
    <li class="text-sm leading-normal">
        <a class="text-black opacity-50" href="javascript:;">Pagina</a>
    </li>
    <li class="text-sm pl-2 capitalize leading-normal text-black before:float-left before:pr-2 before:text-black before:content-['/']" aria-current="page">{{ $role }}</li>
</ol>
<h6 class="mb-0 font-bold text-black capitalize">{{ $reportTitle }}</h6>
