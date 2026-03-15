<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Requests\AddressRequest;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function edit($item_id)
    {
        $item = Item::findOrFail($item_id);
        $address = session("shipping_address_{$item_id}") ?? [
            'postal_code' => Auth::user()->profile->postal_code ?? '',
            'address'     => Auth::user()->profile->address ?? '',
            'building'    => Auth::user()->profile->building ?? '',
        ];

        return view('address', compact('item', 'address'));
    }

    public function update(AddressRequest $request, $item_id)
    {
        session(["shipping_address_{$item_id}" => [
            'postal_code' => $request->postal_code,
            'address'     => $request->address,
            'building'    => $request->building,
        ]]);

        return redirect()->route('purchase.show', ['item_id' => $item_id]);
    }
}
