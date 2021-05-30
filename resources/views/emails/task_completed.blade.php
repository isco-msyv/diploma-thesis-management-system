@component('mail::message')
# Task Completed

{{ $studentFullName }} completed the task.

Project title: {{ $projectTitle }}

Task description: {{ $taskDescription }}

@component('mail::button', ['url' => $url])
View Project
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
