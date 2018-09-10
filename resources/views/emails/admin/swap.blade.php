@component('mail::message')
# Request
{{ $requests[0]->first_name }} requested to swap with you for:

{{ $requests[2]->roles->role }} {{ $requests[0]->first_name }} {{ $requests[0]->last_name }} {{ $requests[2]->start_time }} {{ $requests[2]->finish_time }}

on {{ \Carbon\Carbon::parse($requests[2]->days->date)->format('l d F Y') }}

@component('mail::button', ['url' => route('swap.agree',[
		'act_token' => $requests[3]
	])])
Agree
@endcomponent

@component('mail::button', ['url' => route('swap.decline',[
		'act_token' => $requests[3],
		
	])])
Decline
@endcomponent

Rota Administration
@endcomponent
