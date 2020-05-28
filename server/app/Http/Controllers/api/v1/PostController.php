<?php

namespace App\Http\Controllers\api\v1;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Request $request) {

        if($request->id) {
            $posts = Post::with(['user','category'])
            ->where('user_id',$request->id)
            ->orderBy('posted_at','desc')
            ->limit(10)
            ->get();
        }else {
            $posts = Post::with(['user','category'])
            ->orderBy('posted_at','desc')
            ->limit(10)
            ->get();
        }
       
       return response()->json($posts, 200);
    }

    public function addPost(Request $request) {


        $request->validate([
            'title'=>'required|min:20|max:100',
            'subtitle'=>'required',
            'category_id'=>'required',
            'image'=>'required',
            'meta_desc'=>'required',
            'post_body'=>'required'
        ]);


        $file_data       = $request->input('image');
        //generating unique file name;
        $file_name = 'image_'.time().'.png';
        @list($type, $file_data) = explode(';', $file_data);
        @list(, $file_data)      = explode(',', $file_data);
        $imagePath = "";
        if($file_data!=""){

                \Storage::disk('public')->put($file_name,base64_decode($file_data));
                 $imagePath = asset("storage/$file_name");
      
        }


        try {
        $post = new Post([
            'title' => $request->post('title'),
            'user_id'=>Auth::user()->id,
            'subtitle'=>$request->post('subtitle'),
            'category_id'=>$request->post('category_id'),
            'image_large'=>$imagePath,
            'image_medium'=>$imagePath,
            'image_thumbnail'=>$imagePath,
            'meta_desc'=>$request->post('meta_desc'),
            'post_body'=>$request->post('post_body')
        ]);
        $post->save();
        $data = [
            'message' => 'Post created successfully',
            'error'=>0
        ];

        return response()->json($data, 200);

        } catch(Exception $e) {


            Log::error('Error occurred whiles creating a message', [
                'file' => $e->getFile(),
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'error' => 'Error creating post', 
            ], Response::HTTP_INTERNAL_SERVER_ERROR);

        }

    }
    public function singePost(Request $request) {

        $username = $request->username;
        $slug = $request->slug;

        $post = Post::with(['user'=>function( $query ) use ( $username ) {
            return $query->where('name', $username);
        },'comments' => function( $query ) {
            return $query->with('user')->orderBy("id" ,"desc");
        }])->where('slug' , $slug)->first();

        $data = [
            'post' => $post,
            'error'=>0
        ];

        return response()->json($data, 200);

    }
}
