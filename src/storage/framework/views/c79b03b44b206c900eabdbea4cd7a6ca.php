<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COACHTECH</title>
    <link rel="icon" href="data:,">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <h1 class="header__logo">
                <a href="<?php echo e(route('item.index')); ?>">
                    <img src="<?php echo e(asset('storage/img/logo.png')); ?>" alt="COACHTECH">
                </a>
            </h1>

            <?php if(!Route::is('login') && !Route::is('register') && !Route::is('verification.notice')): ?>
                
                <div class="header__search">
                    <form action="<?php echo e(route('item.index')); ?>" method="GET">
                        <?php if(request('tab')): ?>
                            <input type="hidden" name="tab" value="<?php echo e(request('tab')); ?>">
                        <?php endif; ?>
                        <input type="text" name="keyword" placeholder="なにをお探しですか？" value="<?php echo e(request('keyword')); ?>" class="header__search-input">
                    </form>
                </div>

                
                <nav class="header__nav">
                    <ul class="header__nav-list">
                        <?php if(auth()->guard()->check()): ?>
                            <li class="header__nav-item">
                                <form action="<?php echo e(route('logout')); ?>" method="POST" class="header__logout-form">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="header__nav-link">ログアウト</button>
                                </form>
                            </li>
                            <li class="header__nav-item">
                                <a href="<?php echo e(route('mypage.index')); ?>" class="header__nav-link">マイページ</a>
                            </li>
                        <?php else: ?>
                            <li class="header__nav-item">
                                <a href="<?php echo e(route('login')); ?>" class="header__nav-link">ログイン</a>
                            </li>
                            <li class="header__nav-item">
                                <a href="<?php echo e(route('register')); ?>" class="header__nav-link">会員登録</a>
                            </li>
                        <?php endif; ?>
                        <li class="header__nav-item">
                            <a href="<?php echo e(route('item.create')); ?>" class="header__nav-btn">出品</a>
                        </li>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>
    </header>

    <main class="main">
        <?php echo $__env->yieldContent('content'); ?>
    </main>
</body>
</html>
<?php /**PATH /var/www/resources/views/layouts/app.blade.php ENDPATH**/ ?>