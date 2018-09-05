<div class="daybox col-sm-12">
	<div class="navdiv">
		<div>
			{{ $noweeks[0]->year }}
		</div>
		<div class="leftarrow">
			<a href="{{ url('myrota/' . $prev) }}" @if($prev == 0)
				 class="disabled"
				 @endif><span  class="fas fa-caret-left"></span> Prev</a>
		</div>

		<div class="centerdropdown">
			<span>
				<form action="{!! url('showrotaform'); !!}" method="post" name="weeksub" id="weeksub">
					<label for="weekno">Week no: </label>
					<select name="weekno" id="weekno" onchange="document.getElementById('weeksub').submit();">
						@foreach ($noweeks as $wekno)
							<option value="{{ $wekno->id }}" @if ($weeknumber == $wekno->week_no)
								selected="selected" 
							@endif >{{ $wekno->week_no }}</option>
						@endforeach	
					</select>
					@csrf
				</form>
			</span>
		</div>

		<div class="rightarrow">
			<a href="{{ url('myrota/' . $next) }}">Next <span class="fas fa-caret-right"></span></a>
		</div>
	</div>
	<div class="navdiv">
		<input type="radio" name="rota" aria-label="My rota" onclick="window.location.href='{!! url('myrota/' . $weeknumber); !!}'" checked="checked"> My rota
		<input type="radio" name="rota" aria-label="Weekly rota" onclick="window.location.href='{!! url('show/' . $weeknumber); !!}'"> Weekly rota
	</div>
</div>