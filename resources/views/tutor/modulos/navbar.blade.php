<nav style="margin-top: 20px;" class="navbar navbar-default">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      @php
        $roles = Auth::user()->rol;
        $rol = explode(',', $roles);
      @endphp

      @if ($rol[0] == 2 && $rol[1] == 3 && $rol[2] == 4)
      <a class="navbar-brand" href="{{ route('nivel3') }}"><span class="glyphicon glyphicon-home"></span></a>

      @elseif($rol[0] == 3 && $rol[1] == 4)
      <a class="navbar-brand" href="{{ route('nivel4') }}"><span class="glyphicon glyphicon-home"></span></a>
      @endif
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    

    @if (Auth::check())

    <ul class="nav navbar-nav">
      <li><a href="{{ route('elegirCicloProtocolo') }}">Crear Protocolo</a></li>
      <li><a href="{{ route('verProtocolos') }}">Ver Protocolos</a></li>
      <li><a href="{{ route('asignarDocentesProtocolo') }}">Asignar Docentes</a></li>
      <li><a href="{{ route('crearEquipos') }}">Crear Equipos</a></li>
      <li><a href="{{ route('crearMensaje') }}">Mensajes</a></li>
    </ul>

    <ul class="nav navbar-nav navbar-right">
        <li><a href="{{ route('salir') }}">Salir</a></li>
      </ul>
    @endif
         
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>