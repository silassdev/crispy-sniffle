@component('mail::message')
# Application received, {{ $user->name ?? 'Trainer' }}

Thanks for applying to be a trainer at **{{ config('app.name') }}**. We received your application and will review it shortly.

**What happens next**
- An admin will review your profile.
- Once approved you will receive another email and gain full trainer access (create courses, add notes, manage Zoom recordings).

@component('mail::button', ['url' => url('/')])
Visit site
@endcomponent

If you need to update your profile while waiting, log in and complete your profile information.

Thanks for joining us,<br>
{{ config('app.name') }} Team
@endcomponent
