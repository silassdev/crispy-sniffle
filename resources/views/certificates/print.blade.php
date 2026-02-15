<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Certificate - {{ $cert->certificate_number ?? '' }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    /* Minimal, print-friendly styles for Dompdf */
    body { font-family: DejaVu Sans, Arial, sans-serif; color: #222; margin: 0; padding: 0; }
    .page { width: 100%; padding: 40px 60px; box-sizing: border-box; }
    .card { border: 10px solid #2b6cb0; padding: 30px; border-radius: 10px; }
    .header { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; }
    .logo { width: 120px; height: auto; }
    .title { text-align:center; margin-top: 10px; margin-bottom:20px; }
    .cert-title { font-size: 32px; letter-spacing: 1px; color: #1a202c; margin: 6px 0; }
    .recipient { font-size: 28px; font-weight:700; margin: 10px 0; }
    .meta { font-size: 12px; color: #555; margin-top: 8px; }
    .body-text { font-size: 14px; line-height: 1.5; margin-top: 18px; color:#333; }
    .footer { margin-top: 40px; display:flex; justify-content:space-between; align-items:center; }
    .sig { text-align:center; width:220px; }
    .sig .name { font-weight:700; margin-top:6px; }
    .small { font-size:11px; color:#666; margin-top:8px; }
    .badge { display:inline-block; padding:6px 10px; background:#edf2ff; color:#2c5282; border-radius:6px; font-size:12px; }
    .center { text-align:center; }
  </style>
</head>
<body>
  <div class="page">
    <div class="card">
      <div class="header">
        <!-- left: optional organization logo -->
        <div>
          @if(file_exists(public_path('images/logo.png')))
            <img src="{{ public_path('images/logo.png') }}" alt="Logo" class="logo">
          @else
            <div style="font-weight:700; font-size:18px;">{{ config('app.name') }}</div>
          @endif
        </div>

        <!-- right: small meta -->
        <div style="text-align:right">
          <div class="badge">Certificate #: {{ $cert->certificate_number ?? '—' }}</div>
          <div class="small">Issued: {{ optional($cert->issued_at)->format('F j, Y') ?? '—' }}</div>
        </div>
      </div>

      <div class="title center">
        <div class="cert-title">Certificate of Achievement</div>
        <div class="small">This certificate is presented to</div>
        <div class="recipient">{{ $cert->student->name }}</div>
        <div class="small">For</div>
        <div style="font-weight:600; margin-top:6px;">{{ $cert->type ? ucwords(str_replace('_',' ',$cert->type)) : '—' }}</div>
      </div>

      <div class="body-text center">
        @if($cert->course)
          <div>For successful completion of the course:</div>
          <div style="font-weight:600; margin-top:8px;">{{ $cert->course->title }}</div>
        @else
          <div>For outstanding achievement and successful completion.</div>
        @endif

        @if($cert->notes)
          <div style="margin-top:18px; font-size:13px; color:#444; max-width:70%; margin-left:auto; margin-right:auto;">
            <em>{{ $cert->notes }}</em>
          </div>
        @endif
      </div>

      <div class="footer">
        <div class="sig">
          <!-- placeholder signature (replace with an image if you have) -->
          <div style="height:48px;"></div>
          <div class="name">{{ $cert->trainer->name ?? 'Trainer' }}</div>
          <div class="small">Trainer</div>
        </div>

        <div style="text-align:center;">
          <div style="font-size:11px;color:#666;">Certificate ID</div>
          <div style="font-weight:700;margin-top:6px;">{{ $cert->certificate_number ?? '—' }}</div>
        </div>

        <div class="sig">
          <div style="height:48px;"></div>
          <div class="name">{{ $cert->approver?->name ?? 'Admin' }}</div>
          <div class="small">Approved By</div>
        </div>
      </div>

      <div class="center small" style="margin-top:30px; color:#999;">
        {{ config('app.name') }} • {{ config('app.url') }}
      </div>
    </div>
  </div>
</body>
</html>
