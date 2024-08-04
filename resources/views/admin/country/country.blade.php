@extends('admin.layouts.app')
@section('content')
<!-- Table Header -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Country</h4>
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
                                <th scope="col">Name</th>
                                <th scope="col">Create at</th>
                                <th scope="col">Update at</th>
                                <th scope="col" class="text-center" colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($countries as $country)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$country['name']}}</td>
                                <td>{{$country['created_at']}}</td>
                                <td>{{$country['updated_at']}}</td>
                                <td class="action-hover text-center">
                                    <a href="{{url('/country/edit/'.$country['id'])}}" class="btn btn-primary">Edit</a>
                                </td>
                                <td class="action-hover text-center">
                                    <form action="{{url('/delete-country/'.$country['id'])}}" method="POST">
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
            <a href="/add-a-country" style="margin-bottom: 12px;" class="btn btn-primary">Add a country</a>
        </div>
    </div>
</div>


@endsection