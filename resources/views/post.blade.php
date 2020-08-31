@extends('common.layout')
@section('title')
    {{ $post->post_name }}
@endsection
@section('content')
    <div class="post" >
        <div class="post-main">
            <div class="mid">
                <div class="header">
                    <h1 class="title">{{ $post->post_name }}</h1>
                    <div class="meta">
                        <i class="fa fa-clock-o"></i>
                        <span>{{ $post->createTime }}</span>
                        <i class="fa fa-eye"></i>
                        <span>{{ !empty($post->see) ? $post->see : '0' }}</span>
                        <i class="fa fa-heart-o"></i>
                        <span>{{ !empty($post->likeof) ? $post->likeof : '0' }}</span>
                    </div>
                </div>
                <div class="content" id="Imgbox">
                    <p>{!! $post->content !!}</p>
                    <p></p>
                    <div class="post-love">
                        <button class="btn-love" type="button" data-id="{{ $post->id }}">
                            <i class="fa fa-heart-o"></i>
                            <span id="loveCount">{{ !empty($post->likeof) ? $post->likeof : '0' }}</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="blogside">
                <div class="blog-box">
                    <div class="blog-box-title"><span>热门</span></div>
                    <article class="blog-box-content">
                        @foreach($hot_post as $hot)
                        <section class="blog-box-item">
                            <img src="/static/images/avatar.jpg" >
                            <a href="{{ url('post',['id'=>$hot->id]) }}" title="{{ $hot->post_name }}">
                                <h3># {{ $hot->post_name }}</h3>
                            </a>
                            <p>{{ !empty($hot->see) ? $hot->see : '0' }}次围观</p>
                        </section>
                        @endforeach
                    </article>
                </div>
            </div>
        </div>
    </div>
    <!-- post mode end  -->
@endsection
