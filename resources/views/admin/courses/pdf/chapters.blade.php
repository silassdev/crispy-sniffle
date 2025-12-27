<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Chapters - {{ $course->title }}</title>
  <style>
    body { font-family: DejaVu Sans, Arial, sans-serif; color:#222; padding:20px; }
    .chapter { page-break-after: always; margin-bottom: 24px; }
    .title { font-size:20px; font-weight:700; margin-bottom:6px; }
    .meta { font-size:12px; color:#666; margin-bottom:12px; }
    .content { font-size:13px; line-height:1.5; color:#333; }
    hr { border:none; border-top:1px solid #eee; margin:16px 0; }
  </style>
</head>
<body>
  <h1 style="font-size:22px;">Course: {{ $course->title }}</h1>
  <div style="font-size:12px;color:#666;margin-bottom:18px;">Trainer: {{ optional($course->trainer)->name ?? '—' }}</div>

  @foreach($chapters as $ch)
    <div class="chapter" id="chapter-{{ $ch->order }}">
      <div class="title">#{{ $ch->order }} — {{ $ch->title }}</div>
      @if($ch->description)
        <div class="meta">{{ $ch->description }}</div>
      @endif
      <div class="content">{!! \Illuminate\Support\Str::markdown($ch->content ?? '') !!}</div>
      <hr />
    </div>
  @endforeach
</body>
</html>
