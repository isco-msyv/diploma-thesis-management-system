@component('mail::message')
# Project Completed

Congratulations!

{{ $teacherFullName }} accepted your project submission.<br>

@component('mail::button', ['url' => $url])
View Project
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
