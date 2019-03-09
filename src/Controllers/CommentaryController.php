<?php
namespace CreativityKills\Commentary\Controllers;

use Illuminate\Http\Request;
use Pusher\Laravel\Facades\Pusher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as Controller;

class CommentaryController extends Controller {

    public function index()
    {
        $pagination_results = config('commentary.paginate_number');
        $comment = config('commentary.comment_class');

        if (isset($request->path)) {
            $comments = $comment->where('page', '=', $request->path)
                ->orderBy(config('commentary.order_by.by'), config('chatter.order_by.order'))
                ->get();
        }else {
            return response()->json([]);
        }
    }

    public function store(Request $request)
    {
        $comment = config('commentary.comment_class');

        $comment = $comment->create([
            'page' => $request->path,
            'username' => $request->name,
            'text' => $request->text,
        ]);

        Pusher::trigger('commentary', 'comment-added', $comment, request()->header('X-Socket-Id'));

        return $comment;
    }

    public function subscribe($page)
    {

    }

    public function unsubscribe($page)
    {

    }
}

