<?php $__env->startSection('content'); ?>
<script type="text/javascript">
	function clickswap()
	{
		document.getElementById('personlist').style.display='block';
		document.getElementById('starttime').style.display='none';
		document.getElementById('endtime').style.display='none';
	}

	function clicktime()
	{
		document.getElementById('personlist').style.display='none';
		document.getElementById('starttime').style.display='block';
		document.getElementById('endtime').style.display='block';
	}

	function cancelshift()
	{
		document.getElementById('personlist').style.display='none';
		document.getElementById('starttime').style.display='none';
		document.getElementById('endtime').style.display='none';
	}
</script>
	<div class="daybox col-sm-8">
		<h1>Change Request</h1>
		<div class="weekrow">				
			<div class="arow"><?php echo e($items->roles->role); ?></div>
			<div class="brow"><?php echo e($items->persons->first_name); ?> <span class="mobile"><?php echo e($items->persons->last_name); ?></span></div>
			
			<div class="arow"><?php echo e(\Carbon\Carbon::parse($items->start_time)->format('H:s')); ?></div>
			<div class="arow"><?php echo e(\Carbon\Carbon::parse($items->finish_time)->format('H:s')); ?></div>
		</div>
	</div>	
		<div class="daybox col-sm-8">
		<form action="<?php echo e(url('change/request/form')); ?>" method="post">
			<p>Request to:</p>
			<div class="form-check col-sm-5">
			    <input type="radio" class="form-check-input" name="request" value="<?php if(Auth::user()->id == $items->persons->id): ?>
			    	swap 
			    <?php else: ?>
			    	swapthis 
			    <?php endif; ?>
			    "  swap"  
			    <?php if(Auth::user()->id != $items->persons->id): ?>
			    	checked="checked"
			    <?php else: ?>
			    	checked="checked" onclick="clickswap()"
				<?php endif; ?>
			    >
			    <label class="form-check-label" for="swap">Swap with 
			    <?php if(Auth::user()->id == $items->persons->id): ?>
			    	another 
			    <?php else: ?>
			    	this 
			    <?php endif; ?>
				colleague</label>
			</div>
			 <?php if(Auth::user()->id == $items->persons->id): ?>
				<div class="form-check col-sm-5">
				    <input type="radio" class="form-check-input" name="request" value="cancel" onclick="cancelshift()">
				    <label class="form-check-label" for="cancel">Cancel the shift</label>
				</div>
				<div class="form-check col-sm-5">
				    <input type="radio" class="form-check-input" name="request" value="times" onclick="clicktime()">
				    <label class="form-check-label" for="times">Change the times</label>
				</div>
			<?php endif; ?>



			<?php if(Auth::user()->id == $items->persons->id): ?>
				<div class="form-group col-sm-5" id="personlist">
				    <label for="persons">Choose colleague</label>
				    <select class="form-control" id=persons" name="persons">		    	
				    	<?php if($role->persons->count()): ?>
							<?php $__currentLoopData = $role->persons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $person): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if($person->id != $items->persons->id): ?>
									<option value="<?php echo e($person->id); ?>"><?php echo e($person->first_name); ?> <?php echo e($person->last_name); ?></option>
								<?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php endif; ?>					 
			    	</select>
			  	</div>
			<?php else: ?>
				<input type="hidden" value="<?php echo e($items->persons_id); ?>" name="swapthis">
		  	<?php endif; ?>

		  	<div class="form-group col-sm-5" id="starttime">
			    <label for="persons">Start time</label>
			    <select class="form-control" id=start" name="start">		    				    	
					<?php $__currentLoopData = $hours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						
						<option value="<?php echo e($hour); ?>" <?php if($hour . ':00' == $items->start_time): ?>
							selected="selected"
							<?php endif; ?>
						><?php echo e($hour); ?></option>
					
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>								 
		    	</select>
			</div>

			<div class="form-group col-sm-5" id="endtime">
			    <label for="persons">End time</label>
			    <select class="form-control" id=end" name="end">		    	
			    	
					<?php $__currentLoopData = $hours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						
						<option value="<?php echo e($hour); ?>" <?php if($hour . ':00' == $items->finish_time): ?>
							selected="selected"
							<?php endif; ?>
						><?php echo e($hour); ?></option>
					
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								 
		    	</select>
			</div>

		  	<div class="form-group col-sm-5">
			    <label for="notes">Notes</label>
	    		<textarea class="form-control" id="notes" name="notes rows="3"></textarea>
		  	</div>
		 
		  <button type="submit" class="btn btn-primary">Request</button>
		  <?php echo csrf_field(); ?>
		  
		</form>
		
	</div>	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>