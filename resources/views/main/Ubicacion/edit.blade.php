@extends ('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Distancia: {{ $distancia->id}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
					@foreach($errors->all() as $error)
						<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif
			{!!Form::model($distancia,['method'=>'PATCH','route'=>['main.distancia.update',$distancia->id]])!!}
            {{Form::token()}}
			<div class="form-group">
				<label for="nombre">Numero Placa Contenedor (chipid)</label>
				<input type="text" name="chipid" class="form-control" value="{{$distancia->chipid}}" placeholder="Numero Contenedor(chipid) ...">
			</div>
			<div class="form-group">
				<label for="nombre">Fecha</label>
				<input type="text" name="fecha" class="form-control" value="{{$distancia->fecha}}" placeholder="Fecha (aaaa/mm/dd hh/mm/ss)...">
			</div>
			<div class="form-group">
				<label for="nombre">Distancia</label>
				<input type=text name="distancia" class="form-control" value="{{$distancia->distancia}}" placeholder="Distancia medida...">
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar Cambios</button>
				<button class="btn btn-danger" type="reset">Borrar Campos</button>
				
			</div>


			{!!Form::close()!!}
@endsection