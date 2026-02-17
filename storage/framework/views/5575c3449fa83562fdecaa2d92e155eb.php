<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Certificate - <?php echo e($cert->certificate_number ?? ''); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    @page { margin: 0; }
    * { margin: 0; padding: 0; box-sizing: border-box; }
    
    body { 
      font-family: 'DejaVu Sans', Arial, sans-serif; 
      color: #1a1a1a; 
      background: #ffffff;
    }
    
    .certificate-container {
      width: 100%;
      height: 100vh;
      padding: 40px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      position: relative;
    }
    
    .certificate-inner {
      width: 100%;
      height: 100%;
      background: #ffffff;
      border: 12px solid #f8f9fa;
      box-shadow: inset 0 0 0 3px #667eea;
      position: relative;
      padding: 50px 60px;
    }
    
    /* Decorative corners */
    .corner {
      position: absolute;
      width: 80px;
      height: 80px;
      border: 3px solid #667eea;
    }
    .corner-tl { top: 25px; left: 25px; border-right: none; border-bottom: none; }
    .corner-tr { top: 25px; right: 25px; border-left: none; border-bottom: none; }
    .corner-bl { bottom: 25px; left: 25px; border-right: none; border-top: none; }
    .corner-br { bottom: 25px; right: 25px; border-left: none; border-top: none; }
    
    /* Logo */
    .logo-container {
      position: absolute;
      top: 40px;
      right: 60px;
      width: 100px;
      height: 100px;
      background: #ffffff;
      border-radius: 50%;
      box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }
    
    .logo-container img {
      width: 80px;
      height: auto;
      max-height: 80px;
      object-fit: contain;
    }
    
    .logo-placeholder {
      font-size: 28px;
      font-weight: 700;
      color: #667eea;
      text-align: center;
      line-height: 1;
    }
    
    /* Header */
    .cert-header {
      text-align: center;
      margin-top: 60px;
      margin-bottom: 40px;
    }
    
    .cert-badge {
      display: inline-block;
      padding: 8px 20px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: #ffffff;
      border-radius: 20px;
      font-size: 11px;
      font-weight: 600;
      letter-spacing: 1px;
      text-transform: uppercase;
      margin-bottom: 15px;
    }
    
    .cert-title {
      font-size: 42px;
      font-weight: 700;
      color: #1a1a1a;
      letter-spacing: 2px;
      margin-bottom: 10px;
      text-transform: uppercase;
    }
    
    .cert-subtitle {
      font-size: 14px;
      color: #6b7280;
      font-style: italic;
    }
    
    /* Body */
    .cert-body {
      text-align: center;
      margin: 40px auto;
      max-width: 600px;
    }
    
    .presented-to {
      font-size: 13px;
      color: #6b7280;
      margin-bottom: 15px;
      font-style: italic;
    }
    
    .recipient-name {
      font-size: 36px;
      font-weight: 700;
      color: #667eea;
      margin-bottom: 25px;
      padding-bottom: 10px;
      border-bottom: 3px solid #667eea;
      display: inline-block;
    }
    
    .completion-text {
      font-size: 14px;
      color: #4b5563;
      line-height: 1.8;
      margin-bottom: 15px;
    }
    
    .course-title {
      font-size: 20px;
      font-weight: 600;
      color: #1a1a1a;
      margin: 15px 0;
    }
    
    .notes-section {
      margin-top: 25px;
      padding: 15px;
      background: #f9fafb;
      border-left: 4px solid #667eea;
      font-size: 12px;
      color: #4b5563;
      font-style: italic;
      text-align: left;
    }
    
    /* Footer */
    .cert-footer {
      position: absolute;
      bottom: 60px;
      left: 60px;
      right: 60px;
      display: flex;
      justify-content: space-between;
      align-items: flex-end;
    }
    
    .signature-block {
      text-align: center;
      flex: 1;
    }
    
    .signature-line {
      width: 180px;
      height: 2px;
      background: #667eea;
      margin: 0 auto 8px;
    }
    
    .signature-name {
      font-size: 14px;
      font-weight: 600;
      color: #1a1a1a;
      margin-bottom: 3px;
    }
    
    .signature-title {
      font-size: 11px;
      color: #6b7280;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    
    .cert-meta {
      text-align: center;
      flex: 1;
    }
    
    .cert-number {
      font-size: 10px;
      color: #9ca3af;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 3px;
    }
    
    .cert-id {
      font-size: 13px;
      font-weight: 600;
      color: #667eea;
    }
    
    .cert-date {
      font-size: 11px;
      color: #6b7280;
      margin-top: 3px;
    }
  </style>
</head>
<body>
  <div class="certificate-container">
    <div class="certificate-inner">
      <!-- Decorative Corners -->
      <div class="corner corner-tl"></div>
      <div class="corner corner-tr"></div>
      <div class="corner corner-bl"></div>
      <div class="corner corner-br"></div>
      
      <!-- Logo (Top Right) -->
      <div class="logo-container">
        <?php if(file_exists(public_path('img/igniscode.png'))): ?>
          <img src="<?php echo e(public_path('img/igniscode.png')); ?>" alt="Logo">
        <?php else: ?>
          <div class="logo-placeholder"><?php echo e(substr(config('app.name'), 0, 1)); ?></div>
        <?php endif; ?>
      </div>
      
      <!-- Header -->
      <div class="cert-header">
        <div class="cert-badge">Official Certificate</div>
        <h1 class="cert-title">Certificate of Achievement</h1>
        <p class="cert-subtitle"><?php echo e(config('app.name')); ?></p>
      </div>
      
      <!-- Body -->
      <div class="cert-body">
        <p class="presented-to">This certificate is proudly presented to</p>
        <div class="recipient-name"><?php echo e($cert->student->name); ?></div>
        
        <p class="completion-text">
          For successfully completing the course with excellence and dedication
        </p>
        
        <?php if($cert->course): ?>
          <div class="course-title"><?php echo e($cert->course->title); ?></div>
        <?php endif; ?>
        
        <?php if($cert->notes): ?>
          <div class="notes-section">
            <?php echo e($cert->notes); ?>

          </div>
        <?php endif; ?>
      </div>
      
      <!-- Footer -->
      <div class="cert-footer">
        <div class="signature-block">
          <div class="signature-line"></div>
          <div class="signature-name"><?php echo e($cert->trainer->name ?? 'Trainer'); ?></div>
          <div class="signature-title">Course Trainer</div>
        </div>
        
        <div class="cert-meta">
          <div class="cert-number">Certificate No.</div>
          <div class="cert-id"><?php echo e($cert->certificate_number ?? '—'); ?></div>
          <div class="cert-date"><?php echo e(optional($cert->issued_at)->format('F d, Y') ?? '—'); ?></div>
        </div>
        
        <div class="signature-block">
          <div class="signature-line"></div>
          <div class="signature-name"><?php echo e($cert->approver?->name ?? 'Administrator'); ?></div>
          <div class="signature-title">Approved By</div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/certificates/print.blade.php ENDPATH**/ ?>