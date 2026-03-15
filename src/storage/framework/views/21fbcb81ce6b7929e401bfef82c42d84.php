<?php $__env->startSection('content'); ?>
<div class="detail">
    <div class="detail__inner">
        <div class="detail__image">
            <img src="<?php echo e(asset('storage/' . $item->img_url)); ?>" alt="<?php echo e($item->name); ?>">
        </div>

        
        <div class="detail__content">
            <div class="detail__header">
                <h2 class="detail__name"><?php echo e($item->name); ?></h2>
                <p class="detail__brand"><?php echo e($item->brand_name); ?></p>
                <p class="detail__price">¥<?php echo e(number_format($item->price)); ?><span>（税込）</span></p>

                
                <div class="detail__stats">
                    <div class="detail__stat-item">
                        <?php if(auth()->guard()->check()): ?>
                            <form action="<?php echo e(route('like.store', ['item_id' => $item->id])); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="detail__icon-btn">
                                    <img src="<?php echo e($item->isLikedBy(Auth::user()) ? asset('storage/img/heart-pink.png') : asset('storage/img/heart-default.png')); ?>" alt="like">
                                </button>
                            </form>
                        <?php else: ?>
                            <img src="<?php echo e(asset('storage/img/heart-default.png')); ?>" alt="like">
                        <?php endif; ?>
                        <span class="detail__stat-count"><?php echo e($item->likes->count()); ?></span>
                    </div>
                    <div class="detail__stat-item">
                        <img src="<?php echo e(asset('storage/img/comment.png')); ?>" alt="comment">
                        <span class="detail__stat-count"><?php echo e($item->comments->count()); ?></span>
                    </div>
                </div>
            </div>

            <div class="detail__action">
                <a href="<?php echo e(route('purchase.show', ['item_id' => $item->id])); ?>" class="detail__btn-purchase">購入手続きへ</a>
            </div>

            <div class="detail__section">
                <h3 class="detail__section-title">商品説明</h3>
                <p class="detail__description"><?php echo e($item->description); ?></p>
            </div>

            <div class="detail__section">
                <h3 class="detail__section-title">商品の情報</h3>
                <div class="detail__info-row">
                    <span class="detail__info-label">カテゴリー</span>
                    <div class="detail__categories">
                        <?php $__currentLoopData = $item->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="detail__category-tag"><?php echo e($category->content); ?></span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="detail__info-row">
                    <span class="detail__info-label">商品の状態</span>
                    <span class="detail__condition"><?php echo e($item->condition->content); ?></span>
                </div>
            </div>

            
            <div class="detail__section">
                <h3 class="detail__section-title">コメント (<?php echo e($item->comments->count()); ?>)</h3>
                <div class="detail__comment-list">
                    <?php $__currentLoopData = $item->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="detail__comment-item">
                            <div class="detail__comment-user">
                                <?php if($comment->user->profile && $comment->user->profile->img_url): ?>
                                    <img src="<?php echo e(asset('storage/' . $comment->user->profile->img_url)); ?>" alt="user">
                                <?php else: ?>
                                    <div class="default-user-icon" style="background: #ccc; width: 40px; height: 40px; border-radius: 50%;"></div>
                                <?php endif; ?>
                                <strong><?php echo e($comment->user->name); ?></strong>
                            </div>
                            <p class="detail__comment-text"><?php echo e($comment->content); ?></p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <?php if(auth()->guard()->check()): ?>
                    <form action="<?php echo e(route('comment.store', ['item_id' => $item->id])); ?>" method="POST" class="detail__comment-form">
                        <?php echo csrf_field(); ?>
                        <label for="comment" class="detail__comment-label">商品へのコメント</label>
                        <textarea name="content" id="comment" class="detail__comment-textarea"></textarea>
                        <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="auth__error"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <button type="submit" class="detail__btn-comment">コメントを送信する</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/detail.blade.php ENDPATH**/ ?>