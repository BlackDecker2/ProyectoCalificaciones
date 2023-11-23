<li  class="side-menus {{ Request::is('*') ? 'active' : '' }}" >
    <a class="nav-link" href="/home">
        <i class=" fas fa-building"></i><span>Dashboard</span>
    </a>
    <a class="nav-link" href="/usuarios" style="">
        <i class="fas fa-users-cog"></i><span>Usuarios</span>
    </a>
    <a class="nav-link" href="/roles">
        <i class=" fas fa-user-lock"></i><span>Roles</span>
    </a>
   {{--  <a class="nav-link" href="/documents">
        <i class="fas fa-file-upload"></i><span>Documentos</span>
    </a> --}}
    <a class="nav-link" href="/materias">
        <i class="fas fa-file-upload"></i><span>materias</span>
    </a>
</li>

