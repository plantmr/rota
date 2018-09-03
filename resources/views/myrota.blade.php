@extends('templates.default')
@section('content')
	<div class="daybox col-sm-5">
		@include('templates.partials.topnavrota')
		@if(count($items) > 0)
			<div class="boxheader">
				<p>Week {{ $weeknumber }}</p>
			</div>
			<div class="col-sm-12">
				@if($items)
				@php($myVar = '')
					@foreach ($items as $item)	
					@if($myVar != $item->days->date)			
						<div class="hrow">{{ \Carbon\Carbon::parse($item->days->date)->format('l d F Y') }}</div>
					@endif	
							<div class="weekrow" onclick="window.location='{!! url('change/' . $item->id); !!}'">				
								<div class="arow">{{ $item->roles->role }}</div>
								<div class="brow">{{ $item->persons->first_name }} <span class="mobile">{{ $item->persons->last_name }}</span></div>
								{{-- <div class="arow">{{ $item->persons->last_name }}</div> --}}
								<div class="arow">{{ \Carbon\Carbon::parse($item->start_time)->format('H:s') }}</div>
								<div class="arow">{{ \Carbon\Carbon::parse($item->finish_time)->format('H:s') }}</div>
							</div>
						@php($myVar = $item->days->date)
					@endforeach
				@endif
			</div>						
		
		@else
			<div class="boxheader">
				<p>Week {{ $weeknumber }}</p>
			</div>
			No records found
		@endif
	</div>	
@endsection