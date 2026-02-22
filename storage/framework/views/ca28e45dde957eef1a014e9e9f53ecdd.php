<?php
    $verificationUrl = route('certificate.verify', $cert->certificate_number);
    // Generate QR code as Base64 SVG
    $qrCode = base64_encode(SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')
        ->size(100)
        ->margin(0)
        ->generate($verificationUrl));
        
    $typeTitle = $cert->type === \App\Models\CertificateRequest::TYPE_GRADUATION 
        ? 'Certificate of Graduation' 
        : 'Certificate of Completion';
?>

<div class="cert-body">
    <table class="main-layout-table" cellpadding="0" cellspacing="0">
        <tr>
            <td class="outer-border-cell">
                <table class="inner-content-table" cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="content-cell">
                            
                            <!-- Header: Logo and Badges -->
                            <table class="header-table" width="100%">
                                <tr>
                                    <td align="left" valign="top">
                                        <div class="brand-logo">IGNISCODE LMS</div>
                                        <div class="authenticated-badge">AUTHENTICATED BY IGNISCODE LMS</div>
                                    </td>
                                    <td align="right" valign="top">
                                        <div class="official-label">Official Certificate</div>
                                    </td>
                                </tr>
                            </table>

                            <div class="spacer-top"></div>

                            <!-- Certificate Title -->
                            <h1 class="cert-title-h1"><?php echo e($typeTitle); ?></h1>
                            <p class="presented-desc">This is proudly presented to</p>
                            
                            <!-- Student Name -->
                            <h2 class="student-name-h2"><?php echo e($cert->student?->name ?? 'Oc Danger'); ?></h2>
                            <div class="name-underline-accent"></div>
                            
                            <!-- Description -->
                            <p class="cert-summary-text">
                                For successfully meeting all requirements and demonstrating exceptional proficiency in
                            </p>
                            <h3 class="course-title-h3"><?php echo e($cert->course?->title ?? 'Introduction to Web Development'); ?></h3>

                            <!-- Footer Section: Signatures & Verification -->
                            <table class="footer-layout-table" width="100%">
                                <tr>
                                    <!-- Signatures -->
                                    <td width="55%" valign="bottom">
                                        <table class="signatures-sub-table" width="100%">
                                            <tr>
                                                <td align="center">
                                                    <div class="sig-line-mark"></div>
                                                    <div class="sig-role-text">Training Director</div>
                                                </td>
                                                <td width="20"></td>
                                                <td align="center">
                                                    <div class="sig-line-mark"></div>
                                                    <div class="sig-role-text">Lead Instructor</div>
                                                    <div class="sig-instructor-name"><?php echo e($cert->trainer?->name ?? 'James B'); ?></div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    
                                    <!-- QR and Info -->
                                    <td width="45%" align="right" valign="bottom">
                                        <table class="info-qr-sub-table">
                                            <tr>
                                                <td align="left" class="meta-data-cell">
                                                    <div class="meta-item"><span class="meta-label">Certificate No:</span> <?php echo e($cert->certificate_number); ?></div>
                                                    <div class="meta-item"><span class="meta-label">Issued On:</span> <?php echo e($cert->issued_at?->format('F d, Y') ?? now()->format('F d, Y')); ?></div>
                                                </td>
                                                <td width="15"></td>
                                                <td align="center" class="qr-col-cell">
                                                    <div class="qr-code-frame">
                                                        <img src="data:image/svg+xml;base64,<?php echo e($qrCode); ?>" width="75" height="75">
                                                    </div>
                                                    <div class="qr-instruction">Scan to Verify</div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- Web-only UI components -->
    <?php if(!isset($is_pdf_render)): ?>
    <div class="web-actions-panel">
        <div class="web-buttons">
            <a href="<?php echo e(route('certificates.pdf.download', $cert->id)); ?>" class="web-btn primary">
                Download Official PDF
            </a>
            <a href="<?php echo e(route('certificates.pdf.preview', $cert->id)); ?>" target="_blank" class="web-btn outline">
                Full Screen Preview
            </a>
        </div>
        
        <div class="web-verification-card">
            <h4 class="v-card-title">Verification Information</h4>
            <p class="v-card-text">
                This digital certificate is an official record. 
                Authenticity can be verified at:<br>
                <span class="v-card-url"><?php echo e(route('certificate.verify', $cert->certificate_number)); ?></span>
            </p>
        </div>
    </div>
    <?php endif; ?>
</div>

<style>
    /* Premium Certificate Styles - Optimized for PDF Parity */
    .cert-body {
        font-family: 'DejaVu Sans', sans-serif;
        color: #1a1a2e;
        width: 100%;
        margin: 0;
        padding: 0;
    }

    .main-layout-table {
        width: 100%;
        height: 209mm; /* Surgical height constraint for DomPDF */
        border-collapse: collapse;
        background: #ffffff;
        table-layout: fixed;
    }

    .outer-border-cell {
        border: 10pt solid #4338ca; /* Indigo Border */
        padding: 5pt;
    }

    .inner-content-table {
        width: 100%;
        height: 100%;
        border: 1.5pt solid #b4945c; /* Gold Border */
        border-collapse: collapse;
        table-layout: fixed;
    }

    .content-cell {
        padding: 30pt 45pt;
        text-align: center;
        vertical-align: top;
    }

    /* Header */
    .brand-logo {
        font-size: 18pt;
        font-weight: bold;
        color: #4338ca;
        letter-spacing: 2pt;
        text-align: left;
    }

    .authenticated-badge {
        font-size: 7.5pt;
        font-weight: bold;
        color: #059669;
        background: #ecfdf5;
        padding: 4pt 8pt;
        border-radius: 99pt;
        margin-top: 6pt;
        display: inline-block;
        border: 1pt solid #d1fae5;
        text-transform: uppercase;
    }

    .official-label {
        font-size: 9pt;
        text-transform: uppercase;
        letter-spacing: 4pt;
        color: #9ca3af;
    }

    /* Content Typography */
    .cert-title-h1 {
        font-size: 38pt;
        margin: 0;
        color: #b4945c;
        text-transform: uppercase;
        letter-spacing: 3pt;
        font-weight: bold;
    }

    .presented-desc {
        font-style: italic;
        font-size: 14pt;
        color: #6b7280;
        margin: 15pt 0 6pt;
    }

    .student-name-h2 {
        font-size: 48pt;
        color: #111827;
        font-weight: bold;
        margin: 10pt 0;
        font-family: serif;
    }

    .name-underline-accent {
        width: 250pt;
        height: 2pt;
        background: #b4945c;
        margin: 8pt auto 20pt;
    }

    .cert-summary-text {
        font-size: 13pt;
        color: #4b5563;
        max-width: 600pt;
        margin: 0 auto 12pt;
        line-height: 1.5;
    }

    .course-title-h3 {
        font-size: 26pt;
        color: #4338ca;
        margin: 0 0 25pt;
        font-weight: bold;
    }

    /* Footer Signatures */
    .footer-layout-table {
        margin-top: 25pt;
    }

    .sig-line-mark {
        border-top: 1pt solid #d1d5db;
        margin-bottom: 8pt;
        width: 160pt;
        margin-left: auto;
        margin-right: auto;
    }

    .sig-role-text {
        font-size: 9pt;
        text-transform: uppercase;
        color: #6b7280;
        letter-spacing: 1.5pt;
    }

    .sig-instructor-name {
        font-weight: bold;
        font-size: 13pt;
        color: #111827;
        margin-top: 4pt;
    }

    /* Footer Meta & QR */
    .info-qr-sub-table {
        border-top: 1pt solid #f3f4f6;
        padding-top: 15pt;
        width: auto;
    }

    .meta-data-cell {
        text-align: left;
        white-space: nowrap;
    }

    .meta-item {
        font-size: 11pt;
        color: #1f2937;
        margin-bottom: 4pt;
    }

    .meta-label {
        font-weight: bold;
        color: #9ca3af;
        font-size: 9pt;
        text-transform: uppercase;
        margin-right: 5pt;
    }

    .qr-code-frame {
        border: 1pt solid #e5e7eb;
        padding: 4pt;
        background: #fff;
        display: inline-block;
    }

    .qr-instruction {
        font-size: 7pt;
        text-transform: uppercase;
        color: #9ca3af;
        margin-top: 4pt;
        font-weight: bold;
        text-align: center;
    }

    .spacer-top { height: 20pt; }

    /* Web-specific styles */
    .web-actions-panel {
        margin-top: 50px;
        text-align: center;
        padding: 0 20px 60px;
    }

    .web-buttons { margin-bottom: 40px; }

    .web-btn {
        display: inline-block;
        padding: 16px 36px;
        border-radius: 12px;
        font-weight: bold;
        text-decoration: none;
        margin: 0 12px;
        font-size: 15px;
        transition: all 0.3s ease;
    }

    .web-btn.primary {
        background: #4338ca;
        color: white;
        box-shadow: 0 10px 15px -3px rgba(67, 56, 202, 0.4);
    }

    .web-btn.outline {
        background: white;
        color: #374151;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .web-btn:hover { transform: translateY(-2px); }

    .web-verification-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        padding: 32px;
        max-width: 700px;
        margin: 0 auto;
    }

    .v-card-title {
        font-size: 16px;
        color: #1e293b;
        margin-bottom: 12px;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 1.5pt;
    }

    .v-card-text {
        font-size: 14px;
        color: #64748b;
        line-height: 1.7;
    }

    .v-card-url {
        font-family: monospace;
        color: #4338ca;
        font-weight: bold;
        font-size: 13px;
        display: inline-block;
        margin-top: 10px;
    }
</style>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/certificates/_certificate_content.blade.php ENDPATH**/ ?>