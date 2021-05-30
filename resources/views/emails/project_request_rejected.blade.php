@component('mail::message')
# Project Request Rejected

{{ $teacherFullName }} rejected your project request.<br>
Choose another topic and apply again.

@component('mail::button', ['url' => $url])
Browse Topics
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
