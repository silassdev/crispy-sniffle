@php
    $verificationUrl = route('certificate.verify', $cert->certificate_number);
    // Generate QR code as Base64 SVG
    $qrCode = base64_encode(SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')
        ->size(100)
        ->margin(0)
        ->generate($verificationUrl));
        
    $typeTitle = $cert->type === \App\Models\CertificateRequest::TYPE_GRADUATION 
        ? 'Certificate of Graduation' 
        : 'Certificate of Completion';
@endphp

<div class="cert-body">
    <table class="main-table" cellpadding="0" cellspacing="0">
        <!-- Outer Border Row -->
        <tr>
            <td class="outer-border">
                <table class="inner-table" cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="cert-padding">
                            
                            <!-- Header: Logo and Badges -->
                            <table class="header-table" width="100%">
                                <tr>
                                    <td align="left">
                                        <div class="logo-txt">IGNISCODE LMS</div>
                                        <div class="authenticated-badge">AUTHENTICATED BY IGNISCODE LMS</div>
                                    </td>
                                    <td align="right" valign="top">
                                        <div class="official-label">Official Certificate</div>
                                    </td>
                                </tr>
                            </table>

                            <!-- Title Section -->
                            <div class="spacer-sm"></div>
                            <h1 class="cert-title text-gold">{{ $typeTitle }}</h1>
                            <p class="presented-to">This is proudly presented to</p>
                            
                            <!-- Name Section -->
                            <div class="student-name">{{ $cert->student?->name ?? 'Student Name' }}</div>
                            <div class="name-divider"></div>
                            
                            <!-- Description -->
                            <p class="cert-description">
                                For successfully meeting all requirements and demonstrating exceptional proficiency in
                            </p>
                            <h3 class="course-name">{{ $cert->course?->title ?? 'Course Program' }}</h3>

                            <!-- Bottom Section: Signatures and Footer Details -->
                            <table class="bottom-layout-table" width="100%">
                                <tr>
                                    <!-- Signatures Column -->
                                    <td width="60%" valign="bottom">
                                        <table class="sig-table" width="100%">
                                            <tr>
                                                <td class="sig-column">
                                                    <div class="sig-line"></div>
                                                    <div class="sig-label">Training Director</div>
                                                </td>
                                                <td width="10%"></td>
                                                <td class="sig-column">
                                                    <div class="sig-line"></div>
                                                    <div class="sig-label">Lead Instructor</div>
                                                    <div class="sig-name">{{ $cert->trainer?->name ?? 'James B' }}</div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    
                                    <!-- QR and Footer Info Column -->
                                    <td width="40%" align="right" valign="bottom">
                                        <table class="footer-info-table">
                                            <tr>
                                                <td align="left" class="footer-details-cell">
                                                    <div class="f-item"><span class="f-label">Certificate No:</span> {{ $cert->certificate_number }}</div>
                                                    <div class="f-item"><span class="f-label">Issued On:</span> {{ $cert->issued_at?->format('F d, Y') ?? now()->format('F d, Y') }}</div>
                                                </td>
                                                <td width="15"></td>
                                                <td class="qr-cell">
                                                    <div class="qr-box">
                                                        <img src="data:image/svg+xml;base64,{{ $qrCode }}" width="80" height="80">
                                                    </div>
                                                    <div class="qr-verify-txt">Scan to Verify</div>
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
</div>

<style>
    /* Table-based Premium Layout - Highly compatible with DomPDF */
    .cert-body {
        width: 100%;
        height: 100%;
        background: #fff;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .main-table {
        width: 100%;
        height: 100%;
        border-collapse: collapse;
    }

    .outer-border {
        border: 15px solid #4f46e5; /* Indigo */
        padding: 5px;
    }

    .inner-table {
        width: 100%;
        height: 100%;
        border: 2px solid #c5a059; /* Gold */
        border-collapse: collapse;
    }

    .cert-padding {
        padding: 30px 45px;
        text-align: center;
        vertical-align: top;
    }

    /* Header */
    .logo-txt {
        font-size: 20px;
        font-weight: bold;
        color: #4f46e5;
        letter-spacing: 2px;
        text-align: left;
    }

    .authenticated-badge {
        font-size: 9px;
        font-weight: bold;
        color: #10b981; /* Green */
        background: #ecfdf5;
        padding: 4px 8px;
        border-radius: 99px;
        margin-top: 5px;
        display: inline-block;
        border: 1px solid #d1fae5;
    }

    .official-label {
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 4px;
        color: #6b7280;
    }

    /* Typography */
    .cert-title {
        font-size: 42px;
        margin: 0;
        padding: 0;
        color: #c5a059;
        text-transform: uppercase;
        letter-spacing: 3px;
        font-weight: bold;
    }

    .presented-to {
        font-style: italic;
        font-size: 16px;
        color: #6b7280;
        margin: 15px 0 5px;
    }

    .student-name {
        font-size: 52px;
        color: #1a1a1a;
        font-weight: bold;
        margin: 10px 0;
        font-family: serif;
    }

    .name-divider {
        width: 250px;
        height: 2px;
        background: #c5a059;
        margin: 10px auto 20px;
    }

    .cert-description {
        font-size: 15px;
        color: #6b7280;
        max-width: 650px;
        margin: 0 auto 10px;
        line-height: 1.5;
    }

    .course-name {
        font-size: 28px;
        color: #4f46e5;
        margin: 0 0 20px;
        font-weight: bold;
    }

    /* Signatures and Footer */
    .bottom-layout-table {
        margin-top: 10px;
    }

    .sig-column {
        text-align: center;
        padding-bottom: 10px;
    }

    .sig-line {
        border-top: 1px solid #d1d5db;
        margin-bottom: 8px;
    }

    .sig-label {
        font-size: 10px;
        text-transform: uppercase;
        color: #6b7280;
        letter-spacing: 1px;
    }

    .sig-name {
        font-weight: bold;
        font-size: 14px;
        color: #1a1a1a;
        margin-top: 3px;
    }

    .footer-info-table {
        border-top: 1px solid #f3f4f6;
        padding-top: 15px;
        width: auto;
    }

    .footer-details-cell {
        text-align: left;
        white-space: nowrap;
    }

    .f-item {
        font-size: 12px;
        color: #1a1a1a;
        margin-bottom: 4px;
    }

    .f-label {
        font-weight: bold;
        color: #6b7280;
        font-size: 10px;
        text-transform: uppercase;
        margin-right: 5px;
    }

    .qr-box {
        border: 1px solid #e5e7eb;
        padding: 4px;
        background: #fff;
    }

    .qr-verify-txt {
        font-size: 8px;
        text-transform: uppercase;
        color: #6b7280;
        margin-top: 4px;
        font-weight: bold;
    }

    .spacer-sm { height: 15px; }
</style>
