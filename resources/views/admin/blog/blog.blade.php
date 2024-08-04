@extends('admin.layouts.app')
@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Blogs</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/home">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Basic Table</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Table Header</h4>
                    <h6 class="card-subtitle">Similar to tables, use the modifier classes .thead-light to make <code>&lt;thead&gt;</code>s appear light.</h6>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ID_Auth</th>
                                <th scope="col">Title</th>
                                <th scope="col">Image</th>
                                <th scope="col">Description</th>
                                <th scope="col">Content</th>
                                <th scope="col">Created at</th>
                                <th scope="col">Update at</th>
                                <th scope="col" class="text-center" colspan="3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($blogs as $blog)
                            <tr>
                                <td scope="row">{{$loop->iteration}}</td>
                                <td>{{$blog['id_auth']}}</td>
                                <td>
                                    <p class="truncate-3-lines">{{$blog['title']}}</p>
                                </td>
                                <td>{{$blog['image']}}</td>
                                <td>
                                    <p class="truncate-3-lines">{{$blog['description']}}</p>
                                </td>
                                <td>
                                    <p class="truncate-3-lines">{{$blog['content']}}</p>
                                </td>
                                <td>{{$blog['created_at']}}</td>
                                <td>{{$blog['updated_at']}}</td>
                                <td class="pd-16-8 action-hover text-center">
                                    <a href="{{url('/blog/detail/'.$blogs[0]['id'])}}" class="btn btn-primary">Detail</a>
                                </td>
                                <td class="pd-16-8 action-hover text-center">
                                    <a href="{{url('/blog/edit/'.$blogs[0]['id'])}}" class="btn btn-primary">Edit</a>
                                </td>
                                <td class="pd-16-8 action-hover text-center">
                                    <form action="{{url('/delete-blog/'.$blogs[0]['id'])}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" name="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <a href="/blog/create" style="margin-bottom: 12px;" class="btn btn-primary">Add a blog</a>
        </div>
    </div>
</div>
@endsection