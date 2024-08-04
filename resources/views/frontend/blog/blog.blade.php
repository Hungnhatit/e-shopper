@extends('frontend.layouts.app')
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <div class="blog-post-area">
                    <h2 class="title text-center">Latest From our Blog</h2>
                    <div class="single-blog-post">

                        <h3>{{$blog['title']}}</h3>
                        <div class="post-meta">
                            <ul>
                                <li><i class="fa fa-user"></i> Mac Doe</li>
                                <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                                <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                            </ul>
                            <!-- <span>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-half-o"></i>
								</span> -->
                        </div>
                        <a href="">
                            <img src="{{asset('upload/blog/'.$blog['image'])}}" alt="">
                        </a>
                        {!! $blog['content'] !!}
                        </p>
                        <div class="pager-area">
                            <ul class="pager pull-right">
                                @if($prev)
                                <li>
                                    <a href="{{'/ecommerce/blog-list/blog/'.$prev->id}}">Prev</a>
                                </li>
                                @else
                                <li>
                                    <a disabled href="">Prev</a>
                                </li>
                                @endif

                                @if($next)
                                <li><a href="{{'/ecommerce/blog-list/blog/'.$next->id}}">Next</a></li>
                                @else
                                <li><a href="">Next</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div><!--/blog-post-area-->

                <div class="rating-area">
                    @if(Session::has('hasRated'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <strong>{{ session('hasRated') }}</strong>
                    </div>
                    @endif
                    <ul class="ratings">

                        <li class="rate-this">Rate this item:</li>
                        <div class="rate">
                            <div class="vote">
                                <div class="star_1 ratings_stars"><input value="1" type="hidden"></div>
                                <div class="star_2 ratings_stars"><input value="2" type="hidden"></div>
                                <div class="star_3 ratings_stars"><input value="3" type="hidden"></div>
                                <div class="star_4 ratings_stars"><input value="4" type="hidden"></div>
                                <div class="star_5 ratings_stars"><input value="5" type="hidden"></div>
                                <span class="rate-np">4.5</span>
                            </div>
                        </div>
                        <li class="color">(6 votes)</li>
                    </ul>
                    <ul class="tag">
                        <li>TAG:</li>
                        <li><a class="color" href="">Pink <span>/</span></a></li>
                        <li><a class="color" href="">T-Shirt <span>/</span></a></li>
                        <li><a class="color" href="">Girls</a></li>
                    </ul>
                </div><!--/rating-area-->

                <div class="socials-share">
                    <a href=""><img src="images/blog/socials.png" alt=""></a>
                </div><!--/socials-share-->

                <!-- <div class="media commnets">
						<a class="pull-left" href="#">
							<img class="media-object" src="images/blog/man-one.jpg" alt="">
						</a>
						<div class="media-body">
							<h4 class="media-heading">Annie Davis</h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
							<div class="blog-socials">
								<ul>
									<li><a href=""><i class="fa fa-facebook"></i></a></li>
									<li><a href=""><i class="fa fa-twitter"></i></a></li>
									<li><a href=""><i class="fa fa-dribbble"></i></a></li>
									<li><a href=""><i class="fa fa-google-plus"></i></a></li>
								</ul>
								<a class="btn btn-primary" href="">Other Posts</a>
							</div>
						</div>
					</div> --><!--Comments-->
                <div class="response-area">
                    <h2>{{$commentCount}} RESPONSES</h2>
                    <ul class="media-list">
                        @foreach($comments as $comment)

                     
                        <li class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="images/blog/man-two.jpg" alt="">
                            </a>
                            <!-- Comment cha -->
                            <div class="media-body">
                                <ul class="sinlge-post-meta">
                                    <li><i class="fa fa-user"></i>{{$comment->user_name}}</li>

                                    <li><i class="fa fa-clock-o"></i> {{$comment->created_at}}</li>
                                    <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                                </ul>
                                <p>{{$comment->cmt}}</p>

                                <button class="btn btn-primary reply-btn"><i class="fa fa-reply"></i>Replay</button>

                                <form action="{{'/blog-comment/reply-comment/'.$comment->id_comment}}" method="POST" style="display: none;" class="reply-form">
                                    @csrf
                                    <div class="text-area">
                                        @if(session('user'))
                                        <div class="blank-arrow">
                                            <label>{{Auth()->user()->name}}</label>
                                        </div>
                                        @endif
                                        <textarea type="text" name="comment" rows="11"></textarea>
                                        <input hidden type="text" name="comment_id" value="{{$comment->id_comment}}">
                                        <input hidden type="text" name="blog_id" value="{{$blog['id']}}">
                                        @error('comment')
                                        <div class="alert alert-danger">
                                            {{$message}}
                                        </div>
                                        @enderror
                                        <button type="submit" class="btn btn-primary" href=""> Comment</button>
                                    </div>
                                </form>
                            </div>
                            <!-- End comment cha -->
                        </li>

                        @foreach($comments as $subComment)
                        @if ($comment->id_comment==$subComment->level)
                        <!-- Start comment con -->
                        <li class="media second-media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="images/blog/man-three.jpg" alt="">
                            </a>
                            <div class="media-body">
                                <ul class="sinlge-post-meta">
                                    <li><i class="fa fa-user"></i>{{$comment->user_name}}</li>
                                    <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                                    <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                                </ul>
                                <p>{{$subComment->cmt}}</p>
                                <a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a>
                            </div>
                        </li>
                        @endif
                        @endforeach


                        @endforeach
                        <!-- End comment con -->
                    </ul>

                </div><!--/Response-area-->
                <div class="replay-box">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2>Leave a replay</h2>

                            <!-- Start comment -->
                            <form action="{{'/blog-comment/'.$blog['id']}}" method="POST">
                                @csrf
                                <div class="text-area">
                                    @if(session('user'))
                                    <div class="blank-arrow">
                                        <label>{{Auth()->user()->name}}</label>
                                    </div>
                                    @endif
                                    <span>*</span>
                                    <textarea type="text" name="comment" rows="11"></textarea>
                                    @if(session('user'))
                                    @error('comment')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                    @enderror
                                    @endif
                                    <button type="submit" class="btn btn-primary btn-comment" href=""> Comment</button>
                                </div>
                            </form>
                            <!-- End comment -->
                        </div>
                    </div>
                </div><!--/Reply Box-->
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    if (screen.width <= 736) {
        document.getElementById("viewport").setAttribute("content", "width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no");
    }
</script>
<title>Ohana</title>
<link type="text/css" rel="stylesheet" href="{{asset('/frontend/rate/css/rate.css')}}">
<script src="{{asset('/frontend/rate/js/jquery-1.9.1.min.js')}}"></script>
<script>
    $(document).ready(function() {
        //vote
        $('.ratings_stars').hover(
            // Handles the mouseover
            function() {
                $(this).prevAll().andSelf().addClass('ratings_hover');
                // $(this).nextAll().removeClass('ratings_vote'); 
            },
            function() {
                $(this).prevAll().andSelf().removeClass('ratings_hover');
                // set_votes($(this).parent());
            }
        );

        // Ghi điểm rating
        $('.ratings_stars').click(function() {
            var Values = $(this).find("input").val();
            var blogId = '{{$blog->id}}';
            var userId = '{{auth()->id()}}';

            $.ajax({
                url: "{{route('blog.rate')}}",
                method: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    id_blog: blogId,
                    id_user: userId,
                    rate: Values
                },
                success: function(res) {
                    console.log(res);
                },
                error: function(xhr) {
                    console.log('Error:', xhr); // Log lỗi nếu có
                }
            })

            if ($(this).hasClass('ratings_over')) {
                $('.ratings_stars').removeClass('ratings_over');
                $(this).prevAll().andSelf().addClass('ratings_over');
            } else {
                $(this).prevAll().andSelf().addClass('ratings_over');
            }
        });

        $('.btn-comment').click(function() {
            var userId = '{{auth()->id()}}';
            if (!userId) {
                alert('Vui lòng đăng nhập để thực hiện chức năng này!');
                return;
            }
        })

        // Xử lý click vào replay
        $('.reply-btn').click(function() {
            var commentContainer = $(this).closest('.media-body');
            commentContainer.find('.reply-form').toggle();
        })
    });
</script>



@endsection