@component('mail::message')
# Request
{{ $requests[0]->first_name }} requested to cancel 
@component('mail::panel')
{{ $requests[2]->roles->role }} {{ $requests[0]->first_name }} {{ $requests[0]->last_name }} {{ $requests[2]->start_time }} {{ $requests[2]->finish_time }}
@endcomponent
on {{ \Carbon\Carbon::parse($requests[2]->days->date)->format('l d F Y') }}

Notes: {{ $requests[5] }}

Rota Administration
@endcomponent
