@extends('layouts.main_frontend')
@section('title', 'Post')
@section('header','News & Article')
@section('contents')
    @include('frontend.patials.breadcumb')
    <div class="blog-area section-padding-100">
        <div class="container">
            <div class="cryptos-blog-posts">
                <div class="blog-section-heading mb-50">
                    <h3>Recent News</h3>
                </div>
                @if($posts->isEmpty())
                    <h1>ยังไม่มีข่าวสาร</h1>
                @endif
                @foreach($posts as $key => $post)
                    <div class="col-12">
                        <div class="single-blog-area blog-style-2 mb-100">
                            <!-- Thumbnail -->
                            <div class="blog-thumbnail">
                                    <img src="echo" alt="">
                            </div>
                            <!-- Content -->

                            <div class="blog-content">
                                <a href="{{ route('content',[$post]) }}" class="post-title">{!! $post->title !!}</a>
                                <div class="meta-data">
                                    <a href="#">Trading news</a> |
                                    <a href="#">{!! date_format($post->created_at,'D d/m/Y') !!}</a>
                                </div>
                                <p>{{ $post->content }}</p>
                                <a href="{{ route('content',[$post]) }}" class="btn cryptos-btn mt-50">Read More</a>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @include('frontend.patials.letter')
@endsection

