@extends('coordinador.modulos.plantilla')

@section('title', 'Alta Tutores')

@section('contenido')

@if (Session::has('info'))
	<div class="alert alert-success">
		{{ Session::get('info') }}
	</div>
@endif

<div class="col-md-10 col-md-offset-1">
	<h1>Alta tutores</h1>
<table class="table table-hover table-bordered table-responsive">
	
	<thead>
		<tr>
			<th>Docente</th>
			<th>Roles</th>
			<th>C. Carrera</th>
			<th>Tutores de la Carrera</th>
			<th>Acciones</th>
		</tr>
	</thead>

	<tbody>
		@foreach ($docentes as $docente)
			@if ($docente->c_carr != 'N' && $docente->c_carr != 'Z' && Auth::user()->plantel == $docente->plantel)
				<tr>
					<td>{{ $docente->nom_docente }}</td>

					<td>{{ $docente->rol }}</td>

					<td>{{ $docente->c_carr }}</td>

					<td>
						@foreach ($tutores as $tutor)
							@if ($docente->c_carr == $tutor->t_proy)
								<ul>
									<li>{{ $tutor->nom_docente }}</li>
								</ul>
							@endif
						@endforeach
					</td>

					<td>
						<a href="{{ route('asignarTutores', $docente->id) }}" class="btn btn-primary btn-xs">Asignar</a>
					</td>
				</tr>
			@endif
		@endforeach
	</tbody>
</table>
</div>

@endsection