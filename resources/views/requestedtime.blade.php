@extends('templates.default')
@section('content')
	<div class="daybox col-sm-8">
		<h1>Change Requested</h1>
		<p>You requested to change times:</p>
		<p>{{ $requests[2]->roles->role }} {{ $requests[0]->first_name }} {{ $requests[0]->last_name }} {{ $requests[2]->start_time }} {{ $requests[2]->finish_time }}</p>
		<p>on {{ \Carbon\Carbon::parse($requests[2]->days->date)->format('l d F Y') }} </p>
		<p>from {{ $requests[6] }} to {{ $requests[7] }}</p>
		<p>We will email you a decision to say if your request is approved or declined.</p>
	</div>	
@endsection