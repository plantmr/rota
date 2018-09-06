@component('mail::message')
# Request
{{ $requests[0]->first_name }} requested to swap with {{ $requests[1]->first_name }} for:

{{ $requests[2]->roles->role }} {{ $requests[1]->first_name }} {{ $requests[1]->last_name }} {{ $requests[2]->start_time }} {{ $requests[2]->finish_time }}

on {{ \Carbon\Carbon::parse($requests[2]->days->date)->format('l d F Y') }}

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

Rota Administration
@endcomponent
