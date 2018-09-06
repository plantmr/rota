@extends('templates.default')
@section('content')
	<div class="daybox col-sm-8">
		<h1>Change Requested</h1>
		<p>You requested to swap with {{ $requests[1]->first_name }} for:</p>
		<p>{{ $requests[2]->roles->role }} {{ $requests[1]->first_name }} {{ $requests[1]->last_name }} {{ $requests[2]->start_time }} {{ $requests[2]->finish_time }}</p>
		<p>on {{ \Carbon\Carbon::parse($requests[2]->days->date)->format('l d F Y') }} </p>

		<p>We will email you a confirmation if {{ $requests[1]->first_name }} and the administrator approve the swap, or will inform you if the swap is not approved.</p>
	</div>	
@endsection