<?php $__env->startSection('contenido'); ?>
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Distancia</h3>
			<?php if(count($errors)>0): ?>
			<div class="alert alert-danger">
				<ul>
					<?php foreach($errors->all() as $error): ?>
						<li><?php echo e($error); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php endif; ?>
			<?php echo Form::open(array('url'=>'main/distancia','method'=>'POST','autocomplete'=>'off')); ?>

			<?php echo e(Form::token()); ?>

			<div class="form-group">
				<label for="nombre">Numero Placa Contenedor (chipid)</label>
				<input type="text" name="chipid" class="form-control" placeholder="Numero Contenedor(chipid) ...">
			</div>
			<div class="form-group">
				<label for="nombre">Fecha</label>
				<input type="text" name="fecha" class="form-control" placeholder="Fecha (aaaa/mm/dd hh/mm/ss)...">
			</div>
			<div class="form-group">
				<label for="nombre">Distancia</label>
				<input type=int name="distancia" class="form-control" placeholder="Distancia medida...">
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Enviar</button>
				<button class="btn btn-danger" type="reset">Borrar Campos</button>
				
			</div>


			<?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>