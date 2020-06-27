@component('mail::message')

# hi {{ $seeker['name'] }}

## we are {{ $company['name'] }} Company

Sorry We decide to reomve you from our job {{ $job['title'] }}

@component('mail::button', ['url' => $job['showUrl']])
Job Url
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent