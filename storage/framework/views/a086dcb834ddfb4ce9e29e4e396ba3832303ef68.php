<?php $__env->startSection('contenido'); ?>
<div>
		<h1>Bienvenido</h1>
	<h4>Aqui podrás conocer el estado de los contenedores de la Municipalidad de Yerba Buena</h4>
	
	</div>

	<div class="row">
		<div class="col-lg-8 cold-md-8 col-sm-8 col-xs-12">
			<h3>Distancias medidas por contenedor  
			<?php echo $__env->make('main.distancia.search', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
					<?php foreach($distancias as $dist): ?>
					<tr>
						<td><?php echo e($dist->id); ?></td>
						<td><?php echo e($dist->chipid); ?></td>
						<td><?php echo e($dist->fecha); ?></td>
						<td><?php echo e($dist->distancia); ?></td>
						<td><?php echo e($dist->estado); ?></td>
						<td>
							
							
						</td>
					</tr>
					<?php echo $__env->make('main.distancia.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<?php endforeach; ?>
				</table>
			</div>
			<?php echo e($distancias->render()); ?>

		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>