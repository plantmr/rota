@component('mail::message')
# Request
{{ $requests[0]->first_name }} requested to swap with you for:
@component('mail::panel')
{{ $requests[2]->roles->role }}  @if($requests[4] == 1){{ $requests[0]->first_name }} {{ $requests[0]->last_name }} @endif @if($requests[4] == 2){{ $requests[1]->first_name }} {{ $requests[1]->last_name }} @endif {{ $requests[2]->start_time }} {{ $requests[2]->finish_time }}
@endcomponent
on {{ \Carbon\Carbon::parse($requests[2]->days->date)->format('l d F Y') }}

@component('mail::button', ['url' => route('swap.agree',[
		'act_token' => $requests[3],
		'id' =>  $requests[2]->id
	])])
Agree
@endcomponent

@component('mail::button', ['url' => route('swap.decline',[
		'act_token' => $requests[3],
		'id' =>  $requests[2]->id
		
	])])
Decline
@endcomponent

Rota Administration
@endcomponent
