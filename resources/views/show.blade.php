@extends('templates.default')
@section('content')
	<div class="daybox col-sm-5">
		@include('templates.partials.topnav')
		@if(count($items[0]) > 0)
			<div class="boxheader">
				<p>Week {{ $weeknumber }}</p>
			</div>
			<div class="col-sm-12">
				@if($items)
					@foreach ($items as $item)				
						<div class="hrow">{{ \Carbon\Carbon::parse($item[0]->days->date)->format('l d F Y') }}</div>
						@foreach ($item as $tm)	
							<div class="weekrow link" onclick="window.location='{!! url('change/' . $tm->id); !!}'">				
								<div class="arow">{{ $tm->roles->role }}</div>
								<div class="brow">{{ $tm->persons->first_name }} <span class="mobile">{{ $tm->persons->last_name }}</span></div>
								{{-- <div class="arow">{{ $tm->persons->last_name }}</div> --}}
								<div class="arow">{{ \Carbon\Carbon::parse($tm->start_time)->format('H:s') }}</div>
								<div class="arow">{{ \Carbon\Carbon::parse($tm->finish_time)->format('H:s') }}</div>
							</div>
						@endforeach
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