@component('mail::message')
# Welcome {{ $data['admin']->name }}

You need to reset your Password By this mail {{ $data['admin']['email'] }}

@component('mail::button', ['url' => 'admin/reset/password/'.$data['token']])
Reset Password 
@endcomponent
or 
you can copy this <br>
{{ aurl('reset/password/'.$data['token']) }} <br/>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
