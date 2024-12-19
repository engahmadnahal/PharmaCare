@component('mail::message')
# Hi , Welcome to the Qaren System

Your verification code .

# Code : {{$code}}


Thanks,<br>
{{ config('app.name') }}
@endcomponent
