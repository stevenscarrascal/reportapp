<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('coordinador.index') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <img src="../images/icons/icon-96x96.png" alt="" style="width: 50px; high:50px">
        </div>
        <div class="sidebar-brand-text mx-3"> </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('coordinador.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span class="active">Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Auditoria
    </div>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#auditoria"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-clipboard"></i>
                <span>Auditoria</span>
            </a>
            <div id="auditoria" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Acciones</h6>
                    <a class="collapse-item" href="{{ route('auditorias.index') }}">Revisiones</a>
                </div>
            </div>
        </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Gestion de Personal
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-users"></i>
            <span>Registros de Personal</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Acciones</h6>
                <a class="collapse-item" href="{{ route('personals.index') }}">Personal Activo</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Heading -->
    <div class="sidebar-heading">
        Informes
    </div>
     <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#informes"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="far fa-chart-bar"></i>
            <span>Graficos</span>
        </a>
        <div id="informes" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Acciones</h6>
                <a class="collapse-item" href="{{ route('General') }}">Informes Generales</a>
                <a class="collapse-item" href="{{ route('ConteoDia') }}">Informes Por Dia</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <li class="nav-item d-md-none">
        <form method="POST" action="{{ route('logout') }}" x-data>
            @csrf
            <button type="submit" class=" btn nav-link">
                <i class="fas fa-sign-out-alt"></i>
                <span>Cerrar sesión</span>
            </button>
        </form>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
