@extends('common.layout')
@section('title')
    {{ $post->post_name }}
@endsection
@section('content')
    <div class="post" >
        <div class="post-main">
            <div class="mid">
                {{--top banner--}}
                <div class="list list-auto list-overlay mb-3">
                    <div class="media media-14x5">
                        <a class="media-content" style="background-image: url('{{ isset($post->pic) ? $post->pic : '/static/images/empty.png' }}');">
                            <span class="overlay"></span></a></div>
                    <div class="list-content">
                        <div class="list-body">
                            <div class="list-title text-light text-xl mb-3 ml-1 text-bold">
                                {{ $post->post_name }}
                            </div>
                        </div>
                    </div>
                </div>
                {{--top banner end --}}
                <div class="header">
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
                            <img src="{{ isset($hot->pic) ? $hot->pic : '/static/images/empty.png' }}" >
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
