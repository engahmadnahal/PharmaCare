@component('mail::message')
# Welcome {{$store->name}}
Thanks for your cooperation and support,
@component('mail::panel')
To access CMS your password is {{$password}} <br>
click on below button to login
@endcomponent

@component('mail::button', ['url' => 'https://qaren.mr-dev.tech/en/cms/store/login'])
Go To CMS
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent