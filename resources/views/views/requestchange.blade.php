@extends('templates.default')
@section('content')
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

	function goBack() {
    window.history.go(-1);
}
</script>
<div class="daybox col-sm-8">
	<h1>Change Request</h1>
	<div class="weekrow"><h3>{{ \Carbon\Carbon::parse($items->days->date)->format('l d F Y') }}</h3></div>	
	<div class="weekrow">	
		<h5>			
			<div class="arow">{{ $items->roles->role }}</div>
			<div class="brow">{{ $items->persons->first_name }} <span class="mobile">{{ $items->persons->last_name }}</span></div>
			{{-- <div class="arow">{{ $tm->persons->last_name }}</div> --}}
			<div class="arow">{{ \Carbon\Carbon::parse($items->start_time)->format('H:s') }}</div>
			<div class="arow">{{ \Carbon\Carbon::parse($items->finish_time)->format('H:s') }}</div>
		</h5>
	</div>
</div>	
<div class="daybox col-sm-8">
	<form action="{{ url('change/request/form') }}" method="post">
		<p>Request to:</p>
		<div class="form-check col-sm-5">



			<input type="radio" class="form-check-input" name="requested" value=@if(Auth::user()->id == $items->persons->id)
			"swap"
			@else
			"swapthis" 
			@endif
			@if(Auth::user()->id != $items->persons->id)
			checked="checked"
			@else
			checked="checked" onclick="clickswap()"
			@endif
			>
			<label class="form-check-label" for="swap">Swap with 
				@if(Auth::user()->id == $items->persons->id)
				another 
				@else
				this 
				@endif
			colleague</label>
		</div>
		@if(Auth::user()->id == $items->persons->id)
		<div class="form-check col-sm-5">
			<input type="radio" class="form-check-input" name="requested" value="cancel" onclick="cancelshift()">
			<label class="form-check-label" for="cancel">Cancel the shift</label>
		</div>
		<div class="form-check col-sm-5">
			<input type="radio" class="form-check-input" name="requested" value="times" onclick="clicktime()">
			<label class="form-check-label" for="times">Change the times</label>
		</div>
		@endif

		@if(Auth::user()->id == $items->persons->id)
		<div class="form-group col-sm-5" id="personlist">
			<label for="persons">Choose colleague</label>
			<select class="form-control" id=persons" name="persons">		    	
				@if($role->persons->count())
				@foreach($role->persons as $person)
				@if($person->id != $items->persons->id)
				<option value="{{ $person->id }}">{{ $person->first_name }} {{ $person->last_name }}</option>
				@endif
				@endforeach
				@endif					 
			</select>
		</div>
		@else
		<input type="hidden" value="{{ $items->persons_id }}" name="swapthis">
		@endif

		<div class="form-group col-sm-5" id="starttime">
			<label for="persons">Start time</label>
			<select class="form-control" id=start" name="start">		    				    	
				@foreach($hours as $hour)

				<option value="{{ $hour }}" @if($hour . ':00' == $items->start_time)
					selected="selected"
					@endif
					>{{ $hour }}</option>
					
					@endforeach								 
				</select>
			</div>

			<div class="form-group col-sm-5" id="endtime">
				<label for="persons">End time</label>
				<select class="form-control" id=end" name="end">		    	

					@foreach($hours as $hour)

					<option value="{{ $hour }}" @if($hour . ':00' == $items->finish_time)
						selected="selected"
						@endif
						>{{ $hour }}</option>

						@endforeach

					</select>
				</div>

				<div class="form-group col-sm-5">
					<label for="notes">Notes</label>
					<textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
				</div>
				<input type="hidden" value="{{ $items->id }}" name="itemid">
				<button type="submit" class="btn btn-primary">Request</button>
				<button type="button" class="btn btn-primary" onclick="goBack()">Cancel</button>
				@csrf

			</form>

		</div>	
		@endsection