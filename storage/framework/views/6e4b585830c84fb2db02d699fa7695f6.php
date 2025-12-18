<?php $__env->startComponent('mail::message'); ?>
# Welcome, <?php echo new \Illuminate\Support\EncodedHtmlString($user->name ?? 'Learner'); ?> 👋

Thanks for joining **<?php echo new \Illuminate\Support\EncodedHtmlString(config('app.name')); ?>**. You can now start exploring courses and join the community.

<?php $__env->startComponent('mail::button', ['url' => url('/dashboard/student')]); ?>
Go to your dashboard
<?php echo $__env->renderComponent(); ?>

If you need help, reply to this email.

Thanks,<br>
<?php echo new \Illuminate\Support\EncodedHtmlString(config('app.name')); ?> Team
<?php echo $__env->renderComponent(); ?>
<?php /**PATH C:\xampp\htdocs\laravel-lms\resources\views/emails/welcome-student.blade.php ENDPATH**/ ?>