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
        return view('address', compact('item'));
    }

    public function update(AddressRequest $request, $item_id)
    {
        $user = Auth::user();
        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'postal_code' => $request->postal_code,
                'address' => $request->address,
                'building' => $request->building,
            ]
        );

        return redirect("/purchase/{$item_id}");
    }
}
