<!doctype html>
<html>
<body>
  <p>Hello,</p>
  <p>You have been invited to join <strong>{{ config('app.name') }}</strong> as an Administrator.</p>
  <p>Click the link below to accept the invitation and set your password (link expires at {{ $expires_at }}):</p>
  <p><a href="{{ $acceptUrl }}">{{ $acceptUrl }}</a></p>
  <p>If you didn't expect this email, ignore it.</p>
  <p>— {{ config('app.name') }} Team</p>
</body>
</html>
