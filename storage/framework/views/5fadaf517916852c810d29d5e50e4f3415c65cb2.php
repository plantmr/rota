<?php $__env->startSection('content'); ?>
	<div class="daybox col-sm-5">
		<?php echo $__env->make('templates.partials.topnavrota', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php if(count($items) > 0): ?>
			<div class="boxheader">
				<p>Week <?php echo e($weeknumber); ?></p>
			</div>
			<div class="col-sm-12">
				<?php if($items): ?>
				<?php ($myVar = ''); ?>
					<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
					<?php if($myVar != $item->days->date): ?>			
						<div class="hrow"><?php echo e(\Carbon\Carbon::parse($item->days->date)->format('l d F Y')); ?></div>
					<?php endif; ?>	
							<div class="weekrow link" onclick="window.location='<?php echo url('change/' . $item->id);; ?>'">				
								<div class="arow"><?php echo e($item->roles->role); ?></div>
								<div class="brow"><?php echo e($item->persons->first_name); ?> <span class="mobile"><?php echo e($item->persons->last_name); ?></span></div>
								
								<div class="arow"><?php echo e(\Carbon\Carbon::parse($item->start_time)->format('H:s')); ?></div>
								<div class="arow"><?php echo e(\Carbon\Carbon::parse($item->finish_time)->format('H:s')); ?></div>
							</div>
						<?php ($myVar = $item->days->date); ?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>
			</div>						
		
		<?php else: ?>
			<div class="boxheader">
				<p>Week <?php echo e($weeknumber); ?></p>
			</div>
			No records found
		<?php endif; ?>
	</div>	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>