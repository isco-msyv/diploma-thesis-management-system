@component('mail::message')
# Project Rejected

{{ $teacherFullName }} rejected your project submission.<br>

@component('mail::button', ['url' => $url])
View Project
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
