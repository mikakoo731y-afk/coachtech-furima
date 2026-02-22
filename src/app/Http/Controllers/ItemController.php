<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\Condition;
use Illuminate\Http\Request;
use App\Http\Requests\ExhibitionRequest;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::query();
        // マイリストタブの処理
        if ($request->tab === 'mylist' && Auth::check()) {
            $query->whereHas('likes', function($q) {
                $q->where('user_id', Auth::id());
            });
        }

        $items = $query->latest()->get();
        return view('index', compact('items'));
    }

    // 商品詳細
    public function show($item_id)
    {
        $item = Item::with(['condition', 'categories', 'comments.user'])->findOrFail($item_id);
        return view('detail', compact('item'));
    }

    // 出品画面表示
    public function create()
    {
        $categories = Category::all();
        $conditions = Condition::all();
        return view('sell', compact('categories', 'conditions'));
    }

    // 出品処理
    public function store(ExhibitionRequest $request)
    {
        $path = $request->file('img_url')->store('items', 'public');

        $item = Item::create([
            'user_id' => Auth::id(),
            'condition_id' => $request->condition_id,
            'name' => $request->name,
            'brand_name' => $request->brand_name,
            'price' => $request->price,
            'description' => $request->description,
            'img_url' => $path,
        ]);

        $item->categories()->attach($request->categories);

        return redirect('/');
    }
}
