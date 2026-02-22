<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Purchase;
use App\Http\Requests\PurchaseRequest;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    // 購入画面
    public function show($item_id)
    {
        $item = Item::findOrFail($item_id);
        return view('purchase', compact('item'));
    }

    // 購入確定
    public function store(PurchaseRequest $request, $item_id)
    {
        Purchase::create([
            'user_id' => Auth::id(),
            'item_id' => $item_id,
            'payment_method' => $request->payment_method,
            'shipping_address' => Auth::user()->profile->address ?? '未設定',
        ]);

        return redirect('/');
    }
}