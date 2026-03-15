<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;


class CommentController extends Controller
{
    public function store(CommentRequest $request, $item_id): RedirectResponse
    {
        Comment::create([
            'user_id' => Auth::id(),
            'item_id' => $item_id,
            'content' => $request->content,
        ]);

        return back()->with('message', 'コメントを投稿しました');
    }
}
