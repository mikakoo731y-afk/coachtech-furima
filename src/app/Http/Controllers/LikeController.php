<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store($item_id)
    {
        $user_id = Auth::id();

        if (!$user_id) {
            return redirect()->route('login');
        }

        $like = Like::where('user_id', $user_id)
                    ->where('item_id', $item_id)
                    ->first();

        if ($like) {
            $like->delete();
        } else {
            Like::create([
                'user_id' => $user_id,
                'item_id' => $item_id,
            ]);
        }

        return back();
    }
}
