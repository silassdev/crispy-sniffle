<?php $__env->startComponent('mail::message'); ?>
# Application received, <?php echo new \Illuminate\Support\EncodedHtmlString($user->name ?? 'Trainer'); ?>


Thanks for applying to be a trainer at **<?php echo new \Illuminate\Support\EncodedHtmlString(config('app.name')); ?>**. We received your application and will review it shortly.

**What happens next**
- An admin will review your profile.
- Once approved you will receive another email and gain full trainer access (create courses, add notes, manage Zoom recordings).

<?php $__env->startComponent('mail::button', ['url' => url('/')]); ?>
Visit site
<?php echo $__env->renderComponent(); ?>

If you need to update your profile while waiting, log in and complete your profile information.

Thanks for joining us,<br>
<?php echo new \Illuminate\Support\EncodedHtmlString(config('app.name')); ?> Team
<?php echo $__env->renderComponent(); ?>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/emails/trainer-application-received.blade.php ENDPATH**/ ?>