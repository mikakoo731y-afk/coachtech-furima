<?php $__env->startSection('content'); ?>
<div class="purchase">
    <form action="<?php echo e(route('purchase.store', ['item_id' => $item->id])); ?>" method="POST" class="purchase__form">
        <?php echo csrf_field(); ?>
        <div class="purchase__main">
            
            <div class="purchase__item">
                <div class="purchase__item-img">
                    <img src="<?php echo e(asset('storage/' . $item->img_url)); ?>" alt="<?php echo e($item->name); ?>">
                </div>
                <div class="purchase__item-info">
                    <h2 class="purchase__item-name"><?php echo e($item->name); ?></h2>
                    <p class="purchase__item-price">¥<?php echo e(number_format($item->price)); ?></p>
                </div>
            </div>

            
            <div class="purchase__section">
                <h3 class="purchase__section-title">支払い方法</h3>
                <div class="purchase__select-wrapper">
                    <select name="payment_method" id="payment_select" class="purchase__select">
                        <option value="" disabled selected>選択してください</option>
                        <option value="konbini">コンビニ払い</option>
                        <option value="card">カード支払い</option>
                    </select>
                </div>
                <?php $__errorArgs = ['payment_method'];
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

            
            <div class="purchase__section">
                <div class="purchase__section-header">
                    <h3 class="purchase__section-title">配送先</h3>
                    <a href="<?php echo e(route('address.edit', ['item_id' => $item->id])); ?>" class="purchase__link">変更する</a>
                </div>
                <div class="purchase__address">
                    <p>〒 <?php echo e($address['postal_code']); ?></p>
                    <p><?php echo e($address['address']); ?><?php echo e($address['building']); ?></p>
                    <input type="hidden" name="shipping_address" value="〒<?php echo e($address['postal_code']); ?> <?php echo e($address['address']); ?><?php echo e($address['building']); ?>">
                </div>
            </div>
        </div>

        <aside class="purchase__sidebar">
            <div class="purchase__summary">
                <table class="purchase__table">
                    <tr>
                        <th>商品代金</th>
                        <td>¥<?php echo e(number_format($item->price)); ?></td>
                    </tr>
                    <tr>
                        <th>支払い方法</th>
                        <td id="payment_display">未選択</td>
                    </tr>
                </table>
            </div>
            <button type="submit" class="purchase__btn">購入する</button>
        </aside>
    </form>
</div>

<script>
    
    document.getElementById('payment_select').addEventListener('change', function() {
        const selectedText = this.options[this.selectedIndex].text;
        document.getElementById('payment_display').textContent = selectedText;
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/resources/views/purchase.blade.php ENDPATH**/ ?>