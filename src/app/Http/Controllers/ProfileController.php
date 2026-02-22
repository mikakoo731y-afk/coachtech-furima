<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        if ($request->page === 'buy') {
            // 購入した商品
            $items = Item::whereIn('id', Purchase::where('user_id', $user->id)->pluck('item_id'))->get();
        } else {
            // 出品した商品（デフォルト）
            $items = Item::where('user_id', $user->id)->get();
        }

        return view('mypage', compact('user', 'items'));
    }

    public function edit()
    {
        return view('profile');
    }

    public function update(ProfileRequest $request)
    {
        $user = Auth::user();
        $data = $request->only(['name', 'postal_code', 'address', 'building']);

        if ($request->hasFile('img_url')) {
            $data['img_url'] = $request->file('img_url')->store('profiles', 'public');
        }

        $user->profile()->updateOrCreate(['user_id' => $user->id], $data);

        return redirect('/mypage');
    }
}
