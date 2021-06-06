@component('mail::message')
# You have a new message

{{ $senderFullName }} sent you a message.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
