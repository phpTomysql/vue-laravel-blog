<?php

namespace App\Http\Controllers\api\v1;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{

    public function store(Request $request) {

        try {
            $post = Post::where('id', '=', $request->post_id)->first();
            $post->addComment([
                'content' => $request->content,
                'parent_id' => $request->get('parent_id', null)
                ]);
            return response()->json($post->getThreadedComments());
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage());
        }


    }
}
