<?php
    $verificationUrl = route('certificate.verify', $cert->certificate_number);
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<style>
@page { margin: 0; }

body {
    font-family: DejaVu Sans, sans-serif;
    margin: 0;
    padding: 0;
    background: #ffffff;
}

.wrapper {
    width: 100%;
    height: 100%;
    padding: 30px;
    box-sizing: border-box;
}

.certificate {
    border: 3px solid #4f46e5;
    border-radius: 4px;
    padding: 40px 50px;
    text-align: center;
    position: relative;
    height: calc(100% - 6px);
    box-sizing: border-box;
}

/* Decorative inner border */
.certificate::before {
    content: '';
    position: absolute;
    top: 8px;
    left: 8px;
    right: 8px;
    bottom: 8px;
    border: 1px solid #c7d2fe;
    border-radius: 2px;
}

.header-line {
    width: 80px;
    height: 3px;
    background: #4f46e5;
    margin: 0 auto 15px;
}

.subtitle {
    font-size: 11px;
    letter-spacing: 6px;
    text-transform: uppercase;
    color: #6b7280;
    margin-bottom: 5px;
}

.title {
    font-size: 30px;
    font-weight: bold;
    color: #1e1b4b;
    margin-bottom: 5px;
    letter-spacing: 1px;
}

.presented-to {
    font-size: 12px;
    color: #9ca3af;
    text-transform: uppercase;
    letter-spacing: 3px;
    margin: 20px 0 8px;
}

.name {
    font-size: 28px;
    color: #4f46e5;
    font-weight: bold;
    margin: 8px 0 20px;
    padding-bottom: 8px;
    border-bottom: 2px solid #e5e7eb;
    display: inline-block;
    min-width: 300px;
}

.description {
    font-size: 13px;
    color: #6b7280;
    margin-bottom: 5px;
}

.course-title {
    font-size: 18px;
    font-weight: bold;
    color: #1f2937;
    margin: 5px 0 25px;
}

.details-row {
    width: 100%;
    margin-top: 20px;
}

.details-row td {
    text-align: center;
    padding: 8px 20px;
    vertical-align: top;
}

.detail-label {
    font-size: 9px;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: #9ca3af;
    margin-bottom: 4px;
}

.detail-value {
    font-size: 12px;
    color: #374151;
    font-weight: bold;
}

.qr-section {
    position: absolute;
    bottom: 25px;
    right: 30px;
    text-align: center;
}

.qr-label {
    font-size: 8px;
    color: #9ca3af;
    margin-top: 4px;
    letter-spacing: 1px;
    text-transform: uppercase;
}
</style>
</head>

<body>
<div class="wrapper">
    <div class="certificate">

        <div class="header-line"></div>
        <div class="subtitle">Official Document</div>
        <div class="title">Certificate of Achievement</div>
        <div class="header-line" style="margin-top: 15px;"></div>

        <div class="presented-to">This is proudly presented to</div>

        <div class="name"><?php echo e($cert->student?->name ?? 'Student'); ?></div>

        <div class="description">For successfully completing the program</div>

        <div class="course-title"><?php echo e($cert->course?->title ?? ''); ?></div>

        <table class="details-row" style="margin: 0 auto; width: auto;">
            <tr>
                <td>
                    <div class="detail-label">Certificate No.</div>
                    <div class="detail-value"><?php echo e($cert->certificate_number); ?></div>
                </td>
                <td>
                    <div class="detail-label">Date Issued</div>
                    <div class="detail-value"><?php echo e(optional($cert->issued_at)->format('F d, Y')); ?></div>
                </td>
                <td>
                    <div class="detail-label">Instructor</div>
                    <div class="detail-value"><?php echo e($cert->trainer?->name ?? ''); ?></div>
                </td>
            </tr>
        </table>

        <div class="qr-section">
            <div style="border: 1px solid #e5e7eb; border-radius: 4px; padding: 8px; background: #f9fafb;">
                <div style="font-size: 8px; color: #6b7280; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">Verify Online</div>
                <div style="font-size: 9px; color: #4f46e5; max-width: 140px; word-break: break-all; font-weight: bold;">
                    <?php echo e($verificationUrl); ?>

                </div>
            </div>
        </div>

    </div>
</div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/certificates/print.blade.php ENDPATH**/ ?>