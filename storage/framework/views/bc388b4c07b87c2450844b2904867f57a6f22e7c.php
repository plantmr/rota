<?php $__env->startSection('content'); ?>
<div class="daybox col-sm-4">
	<div class="boxheader">
		<p>Week 24 <span class="rightalign">21/06/2018</span></p>
	</div>

	<div class="col-sm-12">
		<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="arow"><?php echo e($item->roles->role); ?></div>
			<div class="arow"><?php echo e($item->persons->first_name); ?></div>
			<div class="arow"><?php echo e(\Carbon\Carbon::parse($item->start_time)->format('h:s')); ?></div>
			<div class="arow"><?php echo e(\Carbon\Carbon::parse($item->finish_time)->format('h:s')); ?></div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div>
</div>	
<?php $__env->stopSection(); ?>

<p>Week <?php echo e($item->weeks->week_no); ?> <span class="rightalign"><?php echo e(\Carbon\Carbon::parse($item->days->date)->format('l, d, F, Y')); ?></span></p>


<?php echo $__env->make('templates.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>