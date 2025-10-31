@component('mail::message')
# Welcome, {{ $user->name ?? 'Learner' }} 👋

Thanks for joining **{{ config('app.name') }}**. You can now start exploring courses and join the community.

@component('mail::button', ['url' => url('/dashboard/student')])
Go to your dashboard
@endcomponent

If you need help, reply to this email.

Thanks,<br>
{{ config('app.name') }} Team
@endcomponent
