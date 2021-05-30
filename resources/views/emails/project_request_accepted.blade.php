@component('mail::message')
# Project Request Accepted

{{ $teacherFullName }} accepted your project request.<br>
Start working on the project.

@component('mail::button', ['url' => $url])
View Project
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
