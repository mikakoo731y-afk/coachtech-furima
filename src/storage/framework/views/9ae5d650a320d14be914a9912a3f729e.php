<?php $__env->startSection('content'); ?>
<div class="profile">
    <h2 class="profile__title">プロフィール設定</h2>

    <form action="<?php echo e(route('profile.update')); ?>" method="POST" enctype="multipart/form-data" class="profile__form">
        <?php echo csrf_field(); ?>

        
        <div class="profile__image-section">
            <div class="profile__image-box">
                
                <img src="<?php echo e(Auth::user()->profile && Auth::user()->profile->img_url ? asset('storage/' . Auth::user()->profile->img_url) : asset('img/default-user.png')); ?>" 
                     alt="ユーザー画像" class="profile__image-preview">
            </div>
            <label class="profile__image-label">
                <input type="file" name="img_url" class="profile__image-input">
                <span class="profile__image-btn">画像を選択する</span>
            </label>
            <?php $__errorArgs = ['img_url'];
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

        
        <div class="profile__group">
            <label for="name" class="profile__label">ユーザー名</label>
            <input type="text" id="name" name="name" value="<?php echo e(old('name', $user->name)); ?>" class="profile__input">
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

        
        <div class="profile__group">
            <label for="postal_code" class="profile__label">郵便番号</label>
            <input type="text" id="postal_code" name="postal_code" value="<?php echo e(old('postal_code', $profile->postal_code)); ?>" class="profile__input">
            <?php $__errorArgs = ['postal_code'];
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

        
        <div class="profile__group">
            <label for="address" class="profile__label">住所</label>
            <input type="text" id="address" name="address" value="<?php echo e(old('address', $profile->address)); ?>" class="profile__input">
            <?php $__errorArgs = ['address'];
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

        
        <div class="profile__group">
            <label for="building" class="profile__label">建物名</label>
            <input type="text" id="building" name="building" value="<?php echo e(old('building', $profile->building)); ?>" class="profile__input">
            <?php $__errorArgs = ['building'];
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

        <button type="submit" class="profile__btn">更新する</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/profile.blade.php ENDPATH**/ ?>