<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

// 商品一覧画面（トップ画面）
Route::get('/', [ItemController::class, 'index'])->name('item.index');

// 商品詳細画面
Route::get('/item/{item_id}', [ItemController::class, 'show'])->name('item.show');


/*

|--------------------------------------------------------------------------
| 保護されたルート (ログイン・メール認証必須)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // 商品出品画面
    Route::get('/sell', [ItemController::class, 'create'])->name('item.create');
    Route::post('/sell', [ItemController::class, 'store'])->name('item.store');

    // 商品購入画面
    Route::get('/purchase/{item_id}', [PurchaseController::class, 'show'])->name('purchase.show');
    Route::post('/purchase/{item_id}', [PurchaseController::class, 'store'])->name('purchase.store');

    // 送付先住所変更画面
    Route::get('/purchase/address/{item_id}', [AddressController::class, 'edit'])->name('address.edit');
    Route::post('/purchase/address/{item_id}', [AddressController::class, 'update'])->name('address.update');

    // プロフィール画面 (出品した商品 / 購入した商品)
    Route::get('/mypage', [ProfileController::class, 'index'])->name('mypage.index');

    // プロフィール編集画面
    Route::get('/mypage/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/mypage/profile', [ProfileController::class, 'update'])->name('profile.update');

    // コメント送信機能 (ItemController または独立したCommentController)
    Route::post('/item/comment/{item_id}', [ItemController::class, 'comment'])->name('comment.store');

    // いいね機能
    Route::post('/item/like/{item_id}', [ItemController::class, 'like'])->name('like.store');
});