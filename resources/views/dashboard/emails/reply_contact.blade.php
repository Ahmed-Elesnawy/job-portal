@component('mail::message')


# Hello <b> {{ $contact['name'] }} </b>

We reply on you message that talk about <b> {{ $contact['subject'] }} </b> <br>


{{ $reply['reply'] }}



Thanks,<br>

{{ config('app.name') }}

@endcomponent