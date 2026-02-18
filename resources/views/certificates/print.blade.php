@php
    $verificationUrl = route('certificate.verify', $cert->certificate_number);
@endphp


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<style>
@page { margin: 0; }

body {
    font-family: DejaVu Sans, sans-serif;
}

.wrapper {
    width: 100%;
    height: 100%;
    padding: 40px;
}

.certificate {
    border: 8px solid #667eea;
    padding: 60px;
    text-align: center;
}

.title {
    font-size: 32px;
    font-weight: bold;
    margin-bottom: 20px;
}

.name {
    font-size: 28px;
    color: #667eea;
    margin: 20px 0;
}

.meta {
    margin-top: 40px;
    font-size: 12px;
}
</style>
</head>

<body>

<div class="wrapper">
    <div class="certificate">

    <div style="position:absolute; bottom:40px; right:40px; text-align:center;">
    {!! QrCode::size(100)->generate($verificationUrl) !!}
    <div style="font-size:10px; margin-top:5px;">
        Scan to Verify
    </div>
      </div>

        <div class="title">Certificate of Achievement</div>

        <p>This certificate is presented to</p>

        <div class="name">{{ $cert->student->name }}</div>

        <p>For successfully completing</p>

        <strong>{{ $cert->course->title ?? '' }}</strong>

        <div class="meta">
            Certificate No: {{ $cert->certificate_number }} <br>
            Date: {{ optional($cert->issued_at)->format('F d, Y') }}
        </div>

    </div>
</div>
</body>
</html>
