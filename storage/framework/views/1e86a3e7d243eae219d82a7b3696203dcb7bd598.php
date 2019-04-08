<?php $__env->startSection('contenido'); ?>
	<div>
		<h1>Mapa de Contenedores</h1>
	<h4>En el siguiente mapa de Google Maps se puede encontrar los distintos puntos de ubicacion de los contenedores y sus respectivos estados de llenado mediante marcadores (rojo para LLENO, amarillo para MEDIO LLENO y verde para VACÍO).  </h4>

<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7122.370688383899!2d-65.30381029947083!3d-26.802226451800806!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x942242c6727c6d51%3A0x30188e1f0db587b0!2sCampus+Universitario+UNSTA!5e0!3m2!1ses!2sar!4v1552609030207" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>