@extends('frontend.layouts.app')
<?php
    $account = true;
?>
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <div class="blog-post-area">
                    <h2 class="title text-center">Update user</h2>
                    <div class="signup-form"><!--sign up form-->
                        <h2>New User Signup!</h2>
                        <form action="{{'/ecommerce/add-product'}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="name" placeholder="Product name" />
                            @error('name')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror

                            <input type="number" name="price" placeholder="Product price" />
                            @error('price')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror

                            <select id="" name="id_category">
                                <option disabled value="" selected>Please choose category</option>
                                @foreach($categories as $category)
                                <option value="{{$category['id']}}">{{$category['category']}}</option>
                                @endforeach
                            </select>
                            @error('id_category')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror

                            <select id="" name="id_brand">
                                <option disabled value="" selected>Please choose brand</option>
                                @foreach($brands as $brand)
                                <option value="{{$brand['id']}}">{{$brand['brand']}}</option>
                                @endforeach
                            </select>
                            @error('id_brand')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror

                            <select id="sale-option" name="status">
                                <option disabled value="" selected>Status</option>
                                <option value="0">New</option>
                                <option value="1">Sale</option>
                            </select>
                            <input type="number" id="sale-value" name="sale" placeholder="Sale..." style="display: none;">

                            @error('sale')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror

                            <input type="text" name="company" placeholder="Company profile">
                            @error('company')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror

                            <input type="file" name="image[]" placeholder="Product image" multiple>
                            @error('image')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror

                            <textarea name="detail" id="" placeholder="Detail"></textarea>

                            <button type="submit" class="btn btn-default">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Javascript -->
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#sale-option').change(function() {
            if ($(this).val() == "1") {
                $('#sale-value').show();
            } else {
                $('#sale-value').hide();
            }
        })
    })
</script>
@endsection