@extends('templates.default')
@section('content')
	<div class="daybox col-sm-8">
		<h1>Change Requested</h1>
		<p>You requested to swap with {{ $requests[1]->first_name }} for:</p>
		<p>{{ $requests[2]->roles->role }} {{ $requests[2]->persons->first_name }} {{ $requests[2]->persons->last_name }} {{ $requests[2]->start_time }} {{ $requests[2]->finish_time }}</p>
		<p>on {{ \Carbon\Carbon::parse($requests[2]->days->date)->format('l d F Y') }} </p>

		<p>We will email you a confirmation if {{ $requests[1]->first_name }} and your manager approves the swap, or we will email you if the swap is not approved.</p>
	</div>	
@endsection