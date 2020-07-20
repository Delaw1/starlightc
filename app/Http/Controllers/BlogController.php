<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
    public function getPosts() {
        $posts = Post::all();
        return view('blog.index', compact('posts'));
    }
}
