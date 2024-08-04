@extends('frontend.layouts.app')
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <div class="blog-post-area">
                    <h2 class="title text-center">Latest From our Blog</h2>

                    <!-- Start Blogspot -->
                    @foreach($blogs as $blog)
                    <div class="single-blog-post">
                        <h3>{{$blog['title']}}</h3>
                        <div class="post-meta">
                            <ul>
                                <li><i class="fa fa-user"></i> Mac Doe</li>
                                <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                                <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                            </ul>
                            <span>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                            </span>
                        </div>
                        <a href="">
                            <img src="{{asset('upload/blog/'.$blog['image'])}}" alt="">
                        </a>
                        <p>{{$blog['description']}}</p>
                        <a class="btn btn-primary" href="{{"/ecommerce/blog-list/blog/".$blog['id']}}">Read More</a>
                    </div>
                    @endforeach
                    <!-- End blogspot -->

                    <div class="pagination-area">
                        <ul class="pagination">
                            <!-- <li><a href="" class="active">1</a></li>
                            <li><a href="">2</a></li>
                            <li><a href="">3</a></li>
                            <li><a href=""><i class="fa fa-angle-double-right"></i></a></li> -->
                           
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection