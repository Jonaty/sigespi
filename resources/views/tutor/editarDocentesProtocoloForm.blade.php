@extends('tutor.modulos.plantilla')

@section('title', 'Asignar Docentes')

@section('contenido')

<div class="row">
<div class="col s8 offset-s2">

<div class="card-panel green lighten-4">
	<h5>Editar asignacion de docentes al protocolo</h5>
  
  <p><b>{{ $protocolo->nom_protocolo }}</b></p>

{!! Form::model($protocolo, ['route' => ['datosEditarDocentesProtocolo', $protocolo->id], 'method' => 'PUT']) !!}

  <div>
    {!! Form::label('docentes', 'Docentes:') !!}
    <br>
    {!! Form::select('users[]', $users, null, ['multiple', 'class' => 'input-field col s12']) !!}
  </div>

    {!! Form::submit('Asignar',['class' => 'btn waves-effect waves-light']) !!}

    {!! Form::close() !!}
</div>

</div>
</div>
@endsection

