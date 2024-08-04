@extends('frontend.layouts.app')
@section('content')
<section id="form"><!--form-->
    <div class="container">
        <div class="row">        
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>New User Signup!</h2>
                    <form action="/ecommerce/register" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="name" placeholder="Name" />
                        @error('name')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror

                        <input type="email" name="email" placeholder="Email Address" />
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

                        <input type="text" name="phone" placeholder="Phone number">

                        <input type="text" name="address" placeholder="Address">

                        <input type="file" name="avatar" placeholder="Avatar">
                        @error('avatar')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror

                        <button type="submit" name="submit" class="btn btn-default">Register</button>
                    </form>
                </div>
                <!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->
@endsection