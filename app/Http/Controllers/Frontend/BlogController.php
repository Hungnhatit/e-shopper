<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all()->toArray();
        return view('frontend.blog.blog_list', compact('blogs'));
    }

    public function detail($id)
    {
        $blog = Blog::findOrFail($id);
        $comments = DB::table('comment')->where('id_blog',$id)->get();
        $commentCount = $comments->count();
        
        // Panigation
        $next = Blog::where('id', '>', $blog->id)->orderBy('id', 'asc')->first();
        $prev = Blog::where('id', '<', $blog->id)->orderBy('id', 'desc')->first();
        
        return view('frontend.blog.blog', compact('blog', 'next', 'prev', 'comments', 'commentCount'));


    }
}
