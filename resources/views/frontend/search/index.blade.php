@extends('frontend.layouts.app')

@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 padding-right">
                <div class=" search_box">
                    <form action="/ecommerce/search-advance" class="search-container" method="POST">
                        @csrf
                        <input class="search-item" type="text" name="name" placeholder="Name">
                        <select class="search-item" name="price" id="" placeholder="Price">
                            <option disabled selected value="">Choose a price</option>
                            <option value="0-1000">0-1000</option>
                            <option value="1000-2000">1000-2000</option>
                        </select>
                        <select class="search-item" name="brand" id="" placeholder="Brand">
                            <option disabled selected value="">Choose a brand</option>
                            @foreach($brands as $brand)
                            <option value="{{$brand['id']}}">{{$brand['brand']}}</option>
                            @endforeach
                        </select>
                        <select class="search-item" name="category" id="" placeholder="Category">
                            <option disabled selected value="">Choose a category</option>
                            @foreach($cates as $cate)
                            <option value="{{$cate['id']}}">{{$cate['category']}}</option>
                            @endforeach
                        </select>

                        <select class="search-item" name="status" id="" placeholder="status">
                            <option disabled selected value="">Status</option>
                            <option value="0">New</option>
                            <option value="1">Sale</option>
                        </select>
                        <button type="submit" class="btn btn-primary search-item">Search</button>
                    </form>
                </div>
                <div class="features_items"><!--features_items-->
                    @if ($productsCount)
                    <h2 class="title text-center">{{$productsCount}} results</h2>
                    @else
                    <h2 class="title text-center">0 results</h2>
                    @endif

                    @foreach($products as $product)
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{asset('upload/product/'.json_decode($product['image'])[0])}}" alt="" />
                                    <h2>{{$product['price']}}$</h2>
                                    <p>{{$product['name']}}</p>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                                <div class="product-overlay">
                                    <div class="overlay-content">
                                        <h2>{{$product['price']}}$</h2>
                                        <p>{{$product['name']}}</p>
                                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </div>
                                </div>
                            </div>
                            <div class="choose">
                                <ul class="nav nav-pills nav-justified">
                                    <li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                    <li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div><!--features_items-->
                <ul class="pagination">
                    <li class="active"><a href="">1</a></li>
                    <li><a href="">2</a></li>
                    <li><a href="">3</a></li>
                    <li><a href="">&raquo;</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
       
    })
</script>
@endsection