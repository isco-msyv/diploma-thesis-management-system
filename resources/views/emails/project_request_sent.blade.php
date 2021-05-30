@component('mail::message')
# Project Request

{{ $studentFullName }} sent a project request.

Project title: {{ $projectTitle }}

@component('mail::button', ['url' => $url])
View Request
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
