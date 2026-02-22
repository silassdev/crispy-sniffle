

<?php $__env->startSection('title', 'Certificate Verification — ' . $cert->certificate_number); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-slate-100 py-12 px-4 flex flex-col items-center">
    
    <!-- Certificate Container - Fixed Aspect Ratio -->
    <div class="certificate-web-outer shadow-2xl rounded-lg overflow-hidden bg-white mb-10">
        <div class="certificate-web-inner">
            <?php echo $__env->make('certificates._certificate_content', ['cert' => $cert], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
    </div>

    <!-- Actions Bar -->
    <div class="flex flex-wrap justify-center gap-4 mb-10">
        <a href="<?php echo e(route('certificates.pdf.download', $cert->id)); ?>" 
           class="flex items-center gap-2 px-8 py-4 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition-all shadow-xl hover:-translate-y-1">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17v3a2 2 0 002 2h14a2 2 0 002-2v-3"/></svg>
            Download Official PDF
        </a>
        <a href="<?php echo e(route('certificates.pdf.preview', $cert->id)); ?>" target="_blank"
           class="flex items-center gap-2 px-8 py-4 bg-white text-slate-700 font-bold rounded-xl hover:bg-slate-50 transition-all shadow-lg border border-slate-200 hover:-translate-y-1">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            Full Screen Preview
        </a>
    </div>

    <!-- Verification Card -->
    <div class="w-full max-w-3xl bg-white p-8 rounded-2xl border border-slate-200 shadow-sm text-center">
        <h4 class="text-slate-800 font-bold mb-2">Verification Information</h4>
        <p class="text-sm text-slate-500 mb-6">
            This digital certificate is an official record issued by IGNISCODE LMS. 
            The authenticity can be verified by anyone using the details below.
        </p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-left">
            <div class="p-4 bg-slate-50 rounded-lg border border-slate-100">
                <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Status</span>
                <span class="text-green-600 font-bold flex items-center gap-2">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    Verified & Active
                </span>
            </div>
            <div class="p-4 bg-slate-50 rounded-lg border border-slate-100">
                <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Authenticity URL</span>
                <span class="text-indigo-600 font-mono text-xs break-all"><?php echo e(route('certificate.verify', $cert->certificate_number)); ?></span>
            </div>
        </div>
    </div>
</div>

<style>
    /* Fixed aspect ratio container for the certificate to match A4 Landscape */
    .certificate-web-outer {
        width: 1000px;
        height: 707px; /* A4 Landscape Ratio (297/210 * 1000) */
        position: relative;
    }
    
    .certificate-web-inner {
        width: 100%;
        height: 100%;
    }

    /* Scaling for smaller screens */
    @media (max-width: 1024px) {
        .certificate-web-outer {
            width: 100%;
            height: auto;
            aspect-ratio: 297/210;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/certificates/public.blade.php ENDPATH**/ ?>