<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\User;

class BlogController extends Controller
{
    public function index()
    {
      // Trả về các blogs
        $blogs = User::all()->toArray();
        return response()->json($blogs);
    }
}
