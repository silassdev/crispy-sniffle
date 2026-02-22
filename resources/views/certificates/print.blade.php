<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <style>
        @page {
            size: a4 landscape;
            margin: 0;
        }
        html, body {
            margin: 0;
            padding: 0;
            width: 297mm;
            height: 210mm;
            font-family: 'DejaVu Sans', sans-serif;
            overflow: hidden;
            background: #ffffff;
        }
        .pdf-shell {
            width: 297mm;
            height: 210mm;
            padding: 0;
            margin: 0;
            display: block;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <div class="pdf-shell">
        @include('certificates._certificate_content', ['cert' => $cert, 'is_pdf_render' => true])
    </div>
</body>
</html>
