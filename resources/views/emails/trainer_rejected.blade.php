<!doctype html>
<html>
  <body style="font-family:system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;">
    <div style="max-width:640px;margin:0 auto;padding:24px;color:#111">
      <h2 style="margin:0 0 8px 0">Application update for {{ $trainer->name }}</h2>

      <p style="color:#374151">
        We reviewed your trainer application and it cannot be approved at this time.
      </p>

      <p>
        Reason: your profile didn't meet our current requirements. You may contact support for more details or try again after updating your profile.
      </p>

      <p style="color:#6b7280;font-size:13px">If you believe this is a mistake, please reply to this message or contact support.</p>

      <hr style="margin:18px 0;border:none;border-top:1px solid #eee" />
      <small style="color:#9ca3af">{{ config('app.name') }}</small>
    </div>
  </body>
</html>
