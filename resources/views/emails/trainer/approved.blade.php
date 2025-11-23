<!doctype html>
<html>
  <body style="font-family:system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;">
    <div style="max-width:640px;margin:0 auto;padding:24px;color:#111">
      <h2 style="margin:0 0 8px 0">Congratulations, {{ $trainer->name }}.</h2>
      <p style="color:#374151">Your trainer application has been approved by the team.</p>

      <p>
        You can now <a href="{{ url('/login') }}">login</a> with your account email ({{ $trainer->email }}).
        After login you may complete your public profile and start adding courses and content.
      </p>

      <p style="color:#6b7280;font-size:13px">If you did not request this, contact support.</p>

      <hr style="margin:18px 0;border:none;border-top:1px solid #eee" />
      <small style="color:#9ca3af">{{ config('app.name') }}</small>
    </div>
  </body>
</html>
