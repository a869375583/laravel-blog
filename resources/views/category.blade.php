@extends('common.layout')
@section('title')
    分类
@endsection
@section('content')
    <div class="main">
        <div class="mainbody">
            <div class="bloginfo">
                <div class="blog-box-title"><span>博客信息</span></div>
                <div class="blog-info-box">
                    <ul>
                        <li>
                            <a href="javascript:;">
                                <i class="fa fa-map-o"></i>
                                <span class="blog-info-text">访问数量</span>
                                <span class="blog-info-number">{{ $post->sum('see') }}</span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript:;">
                                <i class="fa fa-folder-o"></i>
                                <span class="blog-info-text">文章数量</span>
                                <span class="blog-info-number">{{ $post->total() }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="blog-article">
                <div class="blog-article-list">
                    @if ($postGet->total() != 0)
                        @foreach($postGet as $postof)
                        <div class="blog-article-preview">
                            <img src="{{ isset($postof->pic) ? $postof->pic : '/static/images/empty.png' }}" alt="" class="blog-article-preview-image">
                            <section class="blog-article-preview-info">
                                <div class="blog-article-preview-info-top">
                                    <time>{{ $postof->createTime }}</time>
                                    <h3><a href="{{ url('post',['id'=>$postof->id]) }}" title="{{ $postof->post_name }}">{{ $postof->post_name }}</a></h3>
                                </div>
                                <div class="blog-article-preview-info-bottom">
                                    <p>{!! Str::limit($postof->content,20)  !!} </p>

                                    <a href="{{ url('post',['id'=>$postof->id]) }}">阅读全文</a>
                                </div>
                            </section>
                            <section class="blog-article-preview-action">
                                <i class="fa fa-eye"></i>
                                <span>{{ !empty($postof->see) ? $postof->see : '0' }}</span>
                                <i class="fa fa-heart-o"></i>
                                <span>{{ !empty($postof->likeof) ? $postof->likeof : '0' }}</span>
                                <a href="{{ url('category',['id'=>$cate[$postof->cate_id-1]['id']]) }}"># {{ $cate[$postof->cate_id-1]['cate_name'] }}</a>
                            </section>
                        </div>
                        @endforeach
                    @else
                        @include('common.none')
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
