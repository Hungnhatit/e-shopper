@extends('frontend.layouts.app')
@section('content')
<?php
$sidebar = false;
$slide = false;
?>
<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Login to your account</h2>                    
                    <form action="/ecommerce/login" method="post">
                        @csrf
                        <input type="email" name="email" placeholder="Email Address" />
                        @error('email')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror

                        <input type="password" name="password" placeholder="Name" />
                        @error('password')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                        <span>
                            <input type="checkbox" name="remember_me" class="checkbox">
                            Keep me signed in
                        </span>
                        <button type="submit" class="btn btn-default">Login</button>
                    </form>
                </div><!--/login form-->
            </div>         
        </div>
    </div>
</section><!--/form-->
@endsection