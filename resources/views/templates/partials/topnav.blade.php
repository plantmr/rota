<div class="daybox col-sm-12">
	<div class="leftarrow">
		<a href="{!! url('show/' . $prev); !!}"><span  class="fas fa-caret-left"></span> Prev</a>
	</div>

	<div class="centerdropdown">
		<span>
			<form action="{!! url('showform'); !!}" method="post" name="weeksub" id="weeksub">
				<label for="weekno">Week no: </label>
				<select name="weekno" id="weekno" onchange="document.getElementById('weeksub').submit();">
					@foreach ($noweeks as $wekno)
						<option val="{{ $wekno->week_no }}" @if ($weeknumber == $wekno->week_no)
							selected="selected" 
						@endif >{{ $wekno->week_no }}</option>
					@endforeach	
				</select>
				@csrf
			</form>
		</span>
	</div>

	<div class="rightarrow">
		<a href="{!! url('show/' . $next); !!}">Next <span class="fas fa-caret-right"></span></a>
	</div>
</div>