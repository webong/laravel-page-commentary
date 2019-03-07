<?php
namespace CreativityKills\Commentary\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as Controller;

class CommentaryController {

    public function index($page)
    {
        $pagination_results = config('commentary.paginate_number');
        $comment = config('commentary.comment_class');

        if (isset($page)) {
            $comments = $comment->where('page', '=', $page)
                ->orderBy(config('commentary.order_by.by'), config('chatter.order_by.order'));
            $comments = $comments->get();
        }else {
            return response()->json([]);
        }
    }

    public function store(Request $request, $page)
    {
        $this->validate([
            'body' => 'required|min:10',
        ]);

        $comment = config('commentary.comment_class');

        $comment->create([
            'user_id' => Auth::user()->id,
            'page' => $page,
            'body' => strip_tags($request->text),
        ]);
    }

    public function subscribe($page)
    {

    }

    public function unsubscribe($page)
    {

    }
}

