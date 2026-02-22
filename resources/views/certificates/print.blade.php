<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Certificate - {{ $cert->certificate_number }}</title>
    <style>
        @page {
            size: a4 landscape;
            margin: 0;
        }
        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            font-family: 'DejaVu Sans', sans-serif;
            overflow: hidden; /* Prevent extra pages */
        }
        .page-wrapper {
            width: 100%;
            height: 100%;
            padding: 0; /* Let the table handle padding */
            box-sizing: border-box;
            background: #ffffff;
        }
    </style>
</head>
<body>
    <div class="page-wrapper">
        @include('certificates._certificate_content', ['cert' => $cert])
    </div>
</body>
</html>
