<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Purchase;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $page = $request->query('page');

        if ($page === 'buy') {
            $items = Item::whereHas('purchases', function($q) use($user) {
                $q->where('user_id', $user->id);
            })->latest()->get();
        } else {
            $items = Item::where('user_id', $user->id)->latest()->get();
        }

        return view('mypage', compact('user', 'items', 'page'));
    }

    public function edit()
    {
        $user = Auth::user();
        $profile = $user->profile ?? new Profile();
        return view('profile', compact('user', 'profile'));
    }

    public function update(ProfileRequest $request)
    {
        $user = Auth::user();

        $user->update(['name' => $request->name]);

        $data = [
            'name'        => $request->name,
            'postal_code' => $request->postal_code,
            'address'     => $request->address,
            'building'    => $request->building,
        ];

        if ($request->hasFile('img_url')) {
            $path = $request->file('img_url')->store('profiles', 'public');
            $data['img_url'] = $path;
        }

        $user->profile()->updateOrCreate(['user_id' => $user->id], $data);

        return redirect()->route('mypage.index')->with('message', 'プロフィールを更新しました');
    }
}