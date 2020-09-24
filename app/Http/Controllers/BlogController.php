<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\Reply;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function getPosts() {
        $posts = Post::where('status', 1)->latest()->paginate(10);
        return view('blog.index', compact('posts'));
    }

    public function getPost($id) {
        $post = Post::where('id', $id)->first();
        return view('blog.details', compact('post'));
    }

    public function submitComment(Request $request) {
        $comment = Comment::create([
            'user_id' => Auth::User()->id,
            'post_id' => $request->post_id,
            'comment' => $request->comment
        ]);
        if($comment) {
            return redirect()->back();
        }
        return redirect()->back()->with('error', 'Network error');
    }

    public function submitReply(Request $request) {
        $reply = Reply::create([
            'user_id' => Auth::User()->id,
            'comment_id' => $request->comment_id,
            'reply' => $request->reply
        ]);
        if($reply) {
            return redirect()->back();
        }
        return redirect()->back()->with('error', 'Network error');
    }
}
