<?php $__env->startSection('content'); ?>
<div class="auth">
    <h2 class="auth__title">ログイン</h2>

    <form action="<?php echo e(route('login')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="auth__group">
            <label for="email" class="auth__label">メールアドレス</label>
            <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>" class="auth__input">
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="auth__error"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="auth__group">
            <label for="password" class="auth__label">パスワード</label>
            <input type="password" id="password" name="password" class="auth__input">
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="auth__error"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <?php if($errors->has('email') && !$errors->has('password')): ?>
        <?php endif; ?>

        <button type="submit" class="auth__btn">ログインする</button>
    </form>

    <div class="auth__footer">
        <a href="<?php echo e(route('register')); ?>" class="auth__link">会員登録はこちら</a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/auth/login.blade.php ENDPATH**/ ?>