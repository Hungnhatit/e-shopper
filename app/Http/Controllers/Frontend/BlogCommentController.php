<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Http\Requests\Frontend\BlogCommentRequest;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogCommentController extends Controller
{
    public function postComment(BlogCommentRequest $request, $id)
    {

        if (!Auth::check()) {
            return redirect('/ecommerce/login');
        } else {
            $userId = Auth::user()->id;
            // Lấy thông tin user
            $user = User::where('id', $userId)->get()->toArray();
            $userAvatar = $user[0]['avatar'];
            $userName = $user[0]['name'];
    
            Comment::create([
                'cmt' => $request->comment,
                'id_blog' => $id,
                'id_user' => $userId,
                'avatar_user' => $userAvatar,
                'user_name' => $userName,
                'level' => 0
    
            ]);
        }
        return redirect()->back();
    }

    public function index($id)
    {
        $comments = Comment::all()->toArray();
        return view("{{'/ecommerce/blog-list/blog/'$id}}", compact('comments'));
    }

    public function replyComment(BlogCommentRequest $request, $id)
    {
        //Lấy id comment

        $blogId = $request->blog_id;
        $commentId= $request->comment_id;

        $userId = Auth::user()->id;
        $user = User::where('id', $userId)->get()->toArray();
        $userName = $user[0]['name'];
        $userAvatar = $user[0]['avatar'];

        Comment::create([
            'cmt' => $request->comment,
            'id_blog' => $blogId,
            'id_user' => $userId,
            'avatar_user' => $userAvatar,
            'user_name' => $userName,
            'level' => $commentId
        ]);
        return redirect()->back();
        
    }
}
