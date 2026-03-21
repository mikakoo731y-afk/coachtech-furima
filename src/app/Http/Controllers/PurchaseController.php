<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Purchase;
use App\Http\Requests\PurchaseRequest;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class PurchaseController extends Controller
{
    public function show($item_id)
    {
        $item = Item::with('purchases')->findOrFail($item_id);

        if ($item->purchases->isNotEmpty()) {
            return redirect('/')->with('error', 'この商品は売り切れです');
        }

        $user = Auth::user();

        $address = session("shipping_address_{$item_id}") ?? [
            'postal_code' => $user->profile->postal_code ?? '',
            'address'     => $user->profile->address ?? '',
            'building'    => $user->profile->building ?? '',
        ];

        return view('purchase', compact('item', 'address'));
    }

    public function store(PurchaseRequest $request, $item_id)
    {
        $item = Item::findOrFail($item_id);

        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => [$request->payment_method === 'card' ? 'card' : 'konbini'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => ['name' => $item->name],
                    'unit_amount' => $item->price,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('purchase.success', ['item_id' => $item_id]),
            'cancel_url' => route('purchase.show', ['item_id' => $item_id]),

            'metadata' => [
                'user_id' => Auth::id(),
                'item_id' => $item_id,
                'shipping_address' => $request->shipping_address,
                'payment_method' => $request->payment_method,
            ],
        ]);

        Purchase::create([
            'user_id' => Auth::id(),
            'item_id' => $item_id,
            'payment_method' => $request->payment_method,
            'shipping_address' => $request->shipping_address,
        ]);

        session()->forget("shipping_address_{$item_id}");

        return redirect($session->url);
    }

    public function success($item_id)
    {
        return redirect('/')->with('message', '購入が完了しました');
    }
}
