@extends('frontend.layouts.app')
@section('content')
<?php
$sidebar=false;
?>
<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>Update Your Account</h2>       
                    @if(session('user'))             
                    <form action="{{'/ecommerce/account/update/'.$user['id']}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="name" value="{{$user['name']}}" placeholder="{{$user['name']}}" />
                        @error('name')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror

                        <input type="email" name="email" value="{{$user['email']}}" placeholder="{{$user['email']}}" />
                        @error('email')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror

                        <input type="password" name="password" placeholder="Password" />
                        @error('password')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror

                        <input type="text" name="phone" value="{{$user['phone']}}" placeholder="{{$user['phone']}}">

                        <input type="text" name="address" value="{{$user['address']}}" placeholder="{{$user['address']}}">

                        <input type="file" name="avatar" placeholder="Avatar">
                        @error('avatar')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror

                        <button type="submit" name="submit" class="btn btn-default">Update</button>
                    </form>
                    @endif
                </div>
                <!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->
@endsection