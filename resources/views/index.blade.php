@extends('common.layout')
@section('title')
    首页
@endsection
@section('content')
    @include('common.message')
    <div class="main">


        <div class="mainbody">
            <el-carousel indicator-position="inside" :autoplay="false">
                @foreach($post as $postin)
                    <el-carousel-item>
                        <div class="banner-slot">
                            <a href="{{ url('post',['id' => $postin->id]) }}">
                                <h3>{{ $postin->post_name }}</h3>
                            </a>
                            <img src="{{ isset($postin->pic) ? $postin->pic : '/static/images/banner.jpg' }}" alt="">
                        </div>
                    </el-carousel-item>
                @endforeach
            </el-carousel>
            <el-row :gutter="20" class="bk-style">
                @foreach($post as $p)
                    <el-col :span="6">
                        <div class="grid-content bg-purple">
                            <div class="list-item custom-hover">
                                <div class="media media-16x9">
                                    <a class="media-content" href="{{ url('post',['id'=> $p->id]) }}"
                                       title="{{ $p->post_name }}"
                                       style="background-image: url('{{ isset($p->pic) ? $p->pic : '/static/images/empty.png' }}')">
                                        <span class="overlay"></span>
                                    </a>
                                </div>
                                <div class="list-content">
                                    <div class="list-body">
                                        <div class="d-none d-lg-block text-xs mb-1 list-cat-style list-cat-dot ">
                                            <i class="cat-dot"></i> <a
                                                href="{{ url('category',['id'=>$cate[$p->cate_id-1]['id']]) }}"
                                                class="text-muted" target="_blank">{{ $cate[$p->cate_id-1]['cate_name'] }}</a>
                                        </div>
                                        <a href="{{ url('post',['id'=> $p->id]) }}"
                                           title="{{ $p->post_name }}" class="list-title text-md h-2x">{{ $p->post_name }}</a>
                                    </div>
                                    <div class="list-footer d-flex align-items-center text-muted mt-1 mt-lg-2">
                                        <div class="text-xs">{{ $p->tranTime($p->createTime) }}</div>
                                        <div class="flex-fill"></div>
                                        <div class="text-xs text-nowrap bk-codes">
                                            <span class="d-none d-md-inline-block  mr-1 mr-md-2"><i class="text-md el-icon-view"></i><span class="d-inline-block align-middle">{{ !empty($p->see) ? $p->see : '0' }}</span></span>
                                            <span class="d-none d-md-inline-block "><i class="text-md fa fa-heart-o"></i><span class="d-inline-block align-middle">{{ !empty($p->likeof) ? $p->likeof : '0' }}</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </el-col>
                @endforeach
            </el-row>
    {{ $post->render() }}

@endsection
