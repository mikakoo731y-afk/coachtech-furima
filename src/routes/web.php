<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;

Route::get('/', [ItemController::class, 'index'])->name('item.index');

Route::get('/item/{item_id}', [ItemController::class, 'show'])->name('item.show');


Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/sell', [ItemController::class, 'create'])->name('item.create');
    Route::post('/sell', [ItemController::class, 'store'])->name('item.store');

    Route::get('/purchase/{item_id}', [PurchaseController::class, 'show'])->name('purchase.show');
    Route::post('/purchase/{item_id}', [PurchaseController::class, 'store'])->name('purchase.store');
    Route::get('/purchase/success/{item_id}', [PurchaseController::class, 'success'])->name('purchase.success');

    Route::get('/purchase/address/{item_id}', [AddressController::class, 'edit'])->name('address.edit');
    Route::post('/purchase/address/{item_id}', [AddressController::class, 'update'])->name('address.update');

    Route::get('/mypage', [ProfileController::class, 'index'])->name('mypage.index');

    Route::get('/mypage/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/mypage/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('/item/comment/{item_id}', [CommentController::class, 'store'])->name('comment.store');

    Route::post('/item/like/{item_id}', [LikeController::class, 'store'])->name('like.store');

});