<div class="daybox col-sm-12">
	<div class="navdiv">
		<div class="leftarrow">
			<a href="<?php echo e(url('show/' . $prev)); ?>"><span  class="fas fa-caret-left"></span> Prev</a>
		</div>

		<div class="centerdropdown">
			<span>
				<form action="<?php echo url('showform');; ?>" method="post" name="weeksub" id="weeksub">
					<label for="weekno">Week no: </label>
					<select name="weekno" id="weekno" onchange="document.getElementById('weeksub').submit();">
						<?php $__currentLoopData = $noweeks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wekno): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option val="<?php echo e($wekno->week_no); ?>" <?php if($weeknumber == $wekno->week_no): ?>
								selected="selected" 
							<?php endif; ?> ><?php echo e($wekno->week_no); ?></option>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
					</select>
					<?php echo csrf_field(); ?>
				</form>
			</span>
		</div>

		<div class="rightarrow">
			<a href="<?php echo e(url('show/' . $next)); ?>">Next <span class="fas fa-caret-right"></span></a>
		</div>
	</div>
	<div class="navdiv">
		<input type="radio" name="rota" aria-label="My rota" onclick="window.location.href='<?php echo url('myrota/' . $weeknumber);; ?>'"> My rota
		<input type="radio" name="rota" aria-label="Weekly rota" onclick="window.location.href='<?php echo url('show/' . $weeknumber);; ?>'" checked="checked"> Weekly rota
	</div>
</div>