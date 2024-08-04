<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $blogs = Blog::where('id_auth', $userId)->get()->toArray();
        return view('admin.blog.blog', compact('blogs'));
     
    }

    public function create()
    {
        return view('admin.blog.add');
    }

    public function store(BlogRequest $request)
    {
        $data = $request->all();
        $data['id_auth'] = Auth::id();
        $file = $request->image;
        if (!empty($file)) {
            $data['image'] = $file->getClientOriginalName();
        }

        if (Blog::create($data)) {
            if (!empty($file)) {
                $file->move('upload/blog', $file->getClientOriginalName());
            }
            return redirect('/blog')->with('success', 'Created successfully!');
        } else {
            return redirect()->back()->withErrors('Có lỗi xảy ra.');
        }
    }

    public function edit($id)
    {
        $blog = Blog::where('id', $id)->get()->toArray();
        return view('admin.blog.edit', compact('blog'));
    }

    public function update(BlogRequest $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $data = $request->all();
        $file = $request->image;

        if (!empty($file)) {
            $data['image'] = $file->getClientOriginalName();
        }

        if ($blog->update($data)) {
            if (!empty($file)) {
                $file->move('upload/blog', $file->getClientOriginalName());
            }
            return redirect('blog')->with('success', __('Updated blog successfully!'));
        } else {
            return redirect()->back()->withErrors('An error has occurred. Please check and try again!');
        }
        // dd($data);
    }

    public function destroy($id)
    {
        $blog = Blog::where('id', $id)->delete();
        return redirect('blog')->with('success', 'Thành công');
        // dd($id);
    }
}
