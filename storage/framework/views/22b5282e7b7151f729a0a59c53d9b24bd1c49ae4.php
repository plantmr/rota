<?php $__env->startSection('content'); ?>
	<div class="daybox col-sm-5">
		<?php echo $__env->make('templates.partials.topnav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php if(isset($items)): ?>
		<div class="boxheader">
			<p>Week <?php echo e($items[0][0]->weeks->week_no); ?></p>
		</div>
		<div class="col-sm-12">
			<?php if($items): ?>
				<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>				
					<div class="hrow"><?php echo e(\Carbon\Carbon::parse($item[0]->days->date)->format('l d F Y')); ?></div>
					<?php $__currentLoopData = $item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
						<div class="weekrow" onclick="window.location='<?php echo url('change/' . $tm->id);; ?>'">				
							<div class="arow"><?php echo e($tm->roles->role); ?></div>
							<div class="brow"><?php echo e($tm->persons->first_name); ?> <?php echo e($tm->persons->last_name); ?></div>
							
							<div class="arow"><?php echo e(\Carbon\Carbon::parse($tm->start_time)->format('h:s')); ?></div>
							<div class="arow"><?php echo e(\Carbon\Carbon::parse($tm->finish_time)->format('h:s')); ?></div>
						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<?php endif; ?>
		</div>
		<?php else: ?>
		No records found
	</div>			
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>