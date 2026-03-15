<?php $__env->startSection('content'); ?>
<div class="auth">
    <h2 class="auth__title">メール認証が必要です</h2>
    
    <div class="auth__group">
        <p>ご登録いただいたメールアドレスに認証用リンクを送信しました。</p>
        <p>メール内のリンクをクリックして、会員登録を完了させてください。</p>
    </div>

    
    <?php if(session('status') == 'verification-link-sent'): ?>
        <div class="auth__group">
            <p style="color: green; font-weight: bold;">
                新しい認証リンクを送信しました！
            </p>
        </div>
    <?php endif; ?>

    
    <form method="POST" action="<?php echo e(route('verification.send')); ?>">
        <?php echo csrf_field(); ?>
        <button type="submit" class="auth__btn">認証メールを再送する</button>
    </form>

    <div class="auth__footer">
        <p>※認証が完了している場合は、再度ログインをお試しください。</p>
        <a href="<?php echo e(route('login')); ?>" class="auth__link">ログイン画面へ戻る</a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/auth/verify-email.blade.php ENDPATH**/ ?>