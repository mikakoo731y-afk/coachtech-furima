<?php $__env->startSection('content'); ?>
<div class="mypage">
    
    <div class="mypage__profile">
        <div class="mypage__profile-inner">
            <div class="mypage__image">
                <img src="<?php echo e(Auth::user()->profile && Auth::user()->profile->img_url ? asset('storage/' . Auth::user()->profile->img_url) : asset('img/default-user.png')); ?>" alt="ユーザー画像">
            </div>
            <h2 class="mypage__name"><?php echo e(Auth::user()->profile->name ?? Auth::user()->name); ?></h2>
            <a href="<?php echo e(route('profile.edit')); ?>" class="mypage__edit-btn">プロフィールを編集</a>
        </div>
    </div>

    <nav class="index__nav">
        <div class="index__nav-inner">
            <a href="<?php echo e(route('mypage.index', ['page' => 'sell'])); ?>" 
               class="index__nav-link <?php echo e(request('page') !== 'buy' ? 'is-active' : ''); ?>">
                出品した商品
            </a>
            <a href="<?php echo e(route('mypage.index', ['page' => 'buy'])); ?>" 
               class="index__nav-link <?php echo e(request('page') === 'buy' ? 'is-active' : ''); ?>">
                購入した商品
            </a>
        </div>
    </nav>

    
    <div class="index__item-grid">
        <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="item-card">
                <a href="<?php echo e(route('item.show', ['item_id' => $item->id])); ?>">
                    <div class="item-card__image-wrapper">
                        <img src="<?php echo e(asset('storage/' . $item->img_url)); ?>" alt="<?php echo e($item->name); ?>">
                        <?php if($item->purchases->isNotEmpty()): ?>
                            <div class="item-card__sold">
                                <span>Sold</span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="item-card__content">
                        <p class="item-card__name"><?php echo e($item->name); ?></p>
                    </div>
                </a>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="index__empty">
                <p>表示する商品がありません。</p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/mypage.blade.php ENDPATH**/ ?>