<!doctype html>
<html>
<body>
   <p>Hello,</p>
  <p>You have been invited to join {{ config('app.name') }} as an administrator.</p>
  <p>Accept the invitation and set your password using this link:</p>
  <p><a href="{{ $acceptUrl }}">{{ $acceptUrl }}</a></p>
  <p>This link expires on {{ $expiresAt ? $expiresAt->toDayDateTimeString() : 'soon' }}.</p>
  <p>If you did not request this, ignore this email.</p>
  <p>— {{ config('app.name') }} Team</p>
</body>
</html>
