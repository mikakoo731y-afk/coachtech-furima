<?php $__env->startSection('content'); ?>
<div class="sell">
    <h2 class="sell__title">商品の出品</h2>
    
    <form action="<?php echo e(route('item.store')); ?>" method="POST" enctype="multipart/form-data" class="sell__form">
        <?php echo csrf_field(); ?>

        
        <div class="sell__section">
            <h3 class="sell__section-title">商品画像</h3>
            <div class="sell__image-box">
                <label class="sell__image-label">
                    <input type="file" name="img_url" class="sell__image-input">
                    <span class="sell__image-btn">画像を選択する</span>
                </label>
            </div>
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

        
        <div class="sell__section">
            <h3 class="sell__section-title">商品の詳細</h3>
            
            <div class="sell__group">
                <label class="sell__label">カテゴリー</label>
                <div class="sell__category-grid">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label class="sell__category-item">
                            <input type="checkbox" name="categories[]" value="<?php echo e($category->id); ?>"
                                   <?php echo e(is_array(old('categories')) && in_array($category->id, old('categories')) ? 'checked' : ''); ?>>
                            <span class="sell__category-text"><?php echo e($category->content); ?></span>
                        </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php $__errorArgs = ['categories'];
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

            <div class="sell__group">
                <label for="condition_id" class="sell__label">商品の状態</label>
                <div class="sell__select-wrapper">
                    <select name="condition_id" id="condition_id" class="sell__select">
                        <option value="" disabled selected>選択してください</option>
                        <?php $__currentLoopData = $conditions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $condition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($condition->id); ?>" <?php echo e(old('condition_id') == $condition->id ? 'selected' : ''); ?>>
                                <?php echo e($condition->content); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <?php $__errorArgs = ['condition_id'];
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
        </div>

        
        <div class="sell__section">
            <h3 class="sell__section-title">商品名と説明</h3>
            
            <div class="sell__group">
                <label for="name" class="sell__label">商品名</label>
                <input type="text" name="name" id="name" class="sell__input" value="<?php echo e(old('name')); ?>">
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

            <div class="sell__group">
                <label for="brand_name" class="sell__label">ブランド名</label>
                <input type="text" name="brand_name" id="brand_name" class="sell__input" value="<?php echo e(old('brand_name')); ?>">
                <?php $__errorArgs = ['brand_name'];
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

            <div class="sell__group">
                <label for="description" class="sell__label">商品の説明</label>
                <textarea name="description" id="description" rows="5" class="sell__textarea"><?php echo e(old('description')); ?></textarea>
                <?php $__errorArgs = ['description'];
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
        </div>

        
        <div class="sell__section">
            <h3 class="sell__section-title">販売価格</h3>
            <div class="sell__group">
                <label for="price" class="sell__label">販売価格</label>
                <div class="sell__price-input">
                    <span class="sell__price-unit">¥</span>
                    <input type="number" name="price" id="price" class="sell__input" value="<?php echo e(old('price')); ?>">
                </div>
                <?php $__errorArgs = ['price'];
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
        </div>

        <button type="submit" class="sell__btn">出品する</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/sell.blade.php ENDPATH**/ ?>