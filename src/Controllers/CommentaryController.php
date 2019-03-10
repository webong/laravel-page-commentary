<?php
namespace CreativityKills\Commentary\Controllers;

use Illuminate\Http\Request;
use Pusher\Laravel\Facades\Pusher;
use Illuminate\Support\Facades\Auth;
use CreativityKills\Commentary\Models\Page;
use CreativityKills\Commentary\Models\Comment;
use Illuminate\Routing\Controller as Controller;
use CreativityKills\Commentary\Events\CommentAdded;

class CommentaryController extends Controller {

    public function index(Request $request)
    {
        if (isset($request->path)) {
            $page = Page::firstorCreate(['path' => $request->path]);

            $comments = $page->comments()
                ->orderBy(config('commentary.order_by.by'), config('chatter.order_by.order'))
                ->get();

            return response()->json([
                'page' => $page,
                'comments' => $comments
            ]);
        }else {
            return response()->json([]);
        }
    }

    public function store(Request $request)
    {
        $page = Page::firstorCreate(['path' => $request->path]);

        $comment = $page->comments()->create([
            'username' => $request->username,
            'text' => $request->text,
        ]);

        Pusher::trigger('page-'.$page->id, 'new-comment', $comment);
    
        return $comment;
    }
}

