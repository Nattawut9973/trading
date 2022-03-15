@extends('layouts.main_frontend')
@section('title', 'Post Content')
@section('header','Content')
@section('contents')
    @include('frontend.patials.breadcumb')
    <br><br>
    <section class="blog-content-area section-padding-0-100">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Blog Posts Area -->
                <div class="col-12">
                    <!-- Post Details Area -->
                    <div class="single-post-details-area">
                        <div class="post-content">

                            <div class="text-center mb-50">
                                <p class="post-date">{{ date('M d,Y',strtotime($post->created_at)) }}</p>
                                <h2 class="post-title">{{ $post->title }}</h2>
                            </div>

                            <!-- Post Thumbnail -->
                            <div class="post-thumbnail mb-50">
                                {{--<img src="{{ asset('storage/app/public/uploads/posts/title/'.$post->title_image) }}" alt="">--}}
                            </div>

                            <!-- Post Text -->
                            <div class="post-text">
                                <!-- Share -->
                                <div class="post-share">
                                    <span>Share</span>
                                    <a href="#" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                    <a href="#" class="twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                    <a href="#" class="google-plus"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                                    <a href="#" class="instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                </div>
                                <blockquote class="shortcodes">
                                    <div class="blockquote-text">
                                        <h5>{{ $post->content }}</h5>
                                        <h6>Trading Simulation - <span><a href=""> admin website</a></span></h6>
                                    </div>
                                </blockquote>

                                <p>{{ $post->description }}</p>

                                {{--<div class="row">--}}
                                    {{--<div class="col-12 col-md-6">--}}
                                        {{--<img class="mb-30" src="nikki/img/blog-img/4.jpg" alt="">--}}
                                    {{--</div>--}}
                                    {{--<div class="col-12 col-md-6">--}}
                                        {{--<img class="mb-30" src="img/blog-img/3.jpg" alt="">--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                <!-- List -->
                                <a href="{{ url('posts') }}" class="btn btn-outline-info">Back</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.patials.letter')
@endsection