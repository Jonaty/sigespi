<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="">Brand</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    

    @if (Auth::check())

    <ul class="nav navbar-nav">
      <li><a href="">Enviar Mensaje</a></li>
      <li><a href="#">Notificaciones <span class="badge">1</span></a></li>
    </ul>

    <ul class="nav navbar-nav navbar-right">
        <li><a href="{{ route('salir') }}">Salir</a></li>
      </ul>
    @endif

    @if (Auth::guest())
      <ul class="nav navbar-nav navbar-right">
        <li><a href="{{ route('registro') }}">Registro</a></li>
        <li><a href="{{ route('login') }}">Login</a></li> 
      </ul>  
    @endif
         
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>