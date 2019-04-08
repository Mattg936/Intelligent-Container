@extends ('layouts.admin')
@section('contenido')
<div>
		<h1>Bienvenido</h1>
	<h4>Aqui podrás conocer el estado de los contenedores de la Municipalidad de Yerba Buena</h4>
	
	</div>

	<div class="row">
		<div class="col-lg-8 cold-md-8 col-sm-8 col-xs-12">
			<h3>Distancias medidas por contenedor  
			@include('main.distancia.search')
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Id</th>
						<th>Chipid</th>
						<th>Fecha</th>
						<th>Distancia</th>
						<th>Estado</th>
						
					</thead>
					@foreach ($distancias as $dist)
					<tr>
						<td>{{ $dist->id}}</td>
						<td>{{ $dist->chipid}}</td>
						<td>{{ $dist->fecha}}</td>
						<td>{{ $dist->distancia}}</td>
						<td>{{ $dist->estado}}</td>
						<td>
							
							
						</td>
					</tr>
					@include('main.distancia.modal')
					@endforeach
				</table>
			</div>
			{{$distancias->render()}}
		</div>
	</div>
@endsection