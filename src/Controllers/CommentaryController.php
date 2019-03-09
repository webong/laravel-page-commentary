<?php
namespace CreativityKills\Commentary\Controllers;

use Illuminate\Http\Request;
use Pusher\Laravel\Facades\Pusher;
use Illuminate\Support\Facades\Auth;
use CreativityKills\Commentary\Models\Comment;
use Illuminate\Routing\Controller as Controller;

class CommentaryController extends Controller {

    public function index(Request $request)
    {
        $comment = new Comment;

        if (isset($request->path)) {
            $comments = $comment->where('path', '=', $request->path)
                ->orderBy(config('commentary.order_by.by'), config('chatter.order_by.order'))
                ->get();
                return response()->json($comments);
        }else {
            return response()->json([]);
        }
    }

    public function store(Request $request)
    {
        $comment = Comment::create([
            'path' => $request->path,
            'username' => $request->username,
            'text' => $request->text,
        ]);

        // Pusher::trigger('commentary', 'comment-added', $comment, request()->header('X-Socket-Id'));

        return $comment;
    }
}

