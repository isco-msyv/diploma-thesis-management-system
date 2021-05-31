@component('mail::message')
# Project Submitted

{{ $studentFullName }} submitted the project.

Project title: {{ $projectTitle }}

@component('mail::button', ['url' => $url])
View Project
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
