<?php $__env->startSection('content'); ?>
<div class="index">
    <nav class="index__nav">
        <div class="index__nav-inner">
            <a href="<?php echo e(route('item.index', ['keyword' => request('keyword')])); ?>" 
               class="index__nav-link <?php echo e(!request('tab') ? 'is-active' : ''); ?>">
                おすすめ
            </a>
            <a href="<?php echo e(route('item.index', ['tab' => 'mylist', 'keyword' => request('keyword')])); ?>" 
               class="index__nav-link <?php echo e(request('tab') === 'mylist' ? 'is-active' : ''); ?>">
                マイリスト
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/index.blade.php ENDPATH**/ ?>