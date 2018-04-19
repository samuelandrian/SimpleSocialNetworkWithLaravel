<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;



class PostController extends Controller
{
	public function postCreatePost(Request $request)
	{
		$this->validate($request,[
			'body' => 'required|max:1000'


		]);



		$post = new Post();
		$post->body = $request['body'];//akan menyimpan kedalam database tabel kolom body textarea pada dashboard.php yang memiliki atribut name="body"
		//$request->user()->posts()->save($post);//accessing user function (liihat model post) yang akan menakses function post (lihat model user) lalu akan menyimpan post data yang sudah masuk

		if($request->user()->posts()->save($post))
		{
			$message = 'Post Succesfully created';
		}

		return redirect()->route('dashboard')->with(['message'=>$message]);
	}

	public function getDashboard()
	{
		//$post = Post::all();
		$post = Post::orderBy('created_at','desc')->get();
		return view('dashboard',[
			'posts' =>$post

		]);
	}
	public function getDeletePost($post_id)
	{
		$post = Post::where('id',$post_id)->first();//mendapatkan eleman pertama didalam tabel post dimana user id = $post_id
		if(Auth::user()!=$post->user)
		{
			return redirect()->back();
		}
		$post->delete();
		return redirect()->route('dashboard')->with(['message' => 'succesfull deleted']);
	}


	public function postEditPost(Request $request)
	{
		$this->validate($request, [
			'body' => 'required'
		]);
		$post = Post::find($request['postId']);
		$post->body = $request['body'];
		$post->update();
		return response()->json(['new_body' => $post->body],200);
	}
	public function postLikePost(Request $request)
	{
        $post_id = $request['postId'];
        $is_like = $request['isLike'] == 'true';
        $update = false;
        $post = Post::find($post_id);
        if (!$post) {
            return null;
        }
        $user = Auth::user();
        $like = $user->likes()->where('post_id', $post_id)->first();
        if ($like) 
        {
            $already_like = $like->like;
            $update = true;
            if ($already_like == $is_like) 
            {
                $like->delete();
                return null;
            }
        } 
        else 
        {
            $like = new Like();
        }
        $like->like = $is_like;
        $like->user_id = $user->id;
        $like->post_id = $post->id;
        if ($update) {
            $like->update();
        } else 
        {
            $like->save();
        }
        return null;
    }
}