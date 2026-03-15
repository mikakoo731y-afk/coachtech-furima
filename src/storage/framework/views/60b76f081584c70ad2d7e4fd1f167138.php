<?php $__env->startSection('content'); ?>
<div class="auth">
    <h2 class="auth__title">会員登録</h2>

    <form action="<?php echo e(route('register')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="auth__group">
            <label for="name" class="auth__label">ユーザー名</label>
            <input type="text" id="name" name="name" value="<?php echo e(old('name')); ?>" class="auth__input">
            <?php $__errorArgs = ['name'];
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

        <div class="auth__group">
            <label for="password_confirmation" class="auth__label">確認用パスワード</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="auth__input">
        </div>

        <button type="submit" class="auth__btn">登録する</button>
    </form>

    <div class="auth__footer">
        <a href="<?php echo e(route('login')); ?>" class="auth__link">ログインはこちら</a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/auth/register.blade.php ENDPATH**/ ?>