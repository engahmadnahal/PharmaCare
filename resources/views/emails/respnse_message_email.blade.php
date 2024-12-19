@component('mail::message')
# Hello {{$user->name}}
Thank you for contacting us,
@component('mail::panel')
{{$response}}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent