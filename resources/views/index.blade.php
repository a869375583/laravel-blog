@extends('common.layout')
@section('title')
    首页
@endsection
@section('content')
    @include('common.message')
    <div class="main">


        <div class="mainbody">
            <el-carousel indicator-position="inside" :autoplay="false" height="400px">
                @foreach($banner as $bn)
                <el-carousel-item>
                    <div class="banner-slot">
                        <img src="{{$bn->pics}}" alt="">
                    </div>
                </el-carousel-item>
                @endforeach
            </el-carousel>
            {{--four pic--}}
            <div class="index-special row mb-6">
                <div class="col-3"><a href="{{$indexof->pic_A}}">
                        <div class="macwk-card bg-gradient-green hover-shadow-6 py-3 text-center"
                        >

                            <div class="macwk-card__collapsible-content vs-con-loading__container">
                                <div class="macwk-card__body"><h6 class="mb-0 text-white"><i
                                            class="el-icon-goods fs-22 mr-3 v-m-3"></i> <span>{{$indexof->name_A}}</span></h6></div>
                            </div>
                        </div>
                    </a></div>
                <div class="col-3"><a href="{{$indexof->pic_B}}" class="">
                        <div class="macwk-card bg-gradient-orange hover-shadow-6 py-3 text-center"
                        >
                            <div class="macwk-card__collapsible-content vs-con-loading__container">
                                <div class="macwk-card__body"><h6 class="mb-0 text-white"><i
                                            class="el-icon-shopping-bag-1 fs-22 mr-3 v-m-3"></i> <span>{{$indexof->name_B}}</span>
                                    </h6></div>
                            </div>
                        </div>
                    </a></div>
                <div class="col-3"><a href="{{$indexof->pic_C}}" class="">
                        <div class="macwk-card bg-gradient-blue hover-shadow-6 py-3 text-center"
                        >

                            <div class="macwk-card__collapsible-content vs-con-loading__container">
                                <div class="macwk-card__body"><h6 class="mb-0 text-white"><i
                                            class="el-icon-date fs-22 mr-3 v-m-3"></i> <span>{{$indexof->name_C}}</span></h6></div>
                            </div>
                        </div>
                    </a></div>
                <div class="col-3"><a href="{{$indexof->pic_D}}" class="">
                        <div class="macwk-card bg-gradient-purple hover-shadow-6 py-3 text-center"
                        >

                            <div class="macwk-card__collapsible-content vs-con-loading__container">
                                <div class="macwk-card__body"><h6 class="mb-0 text-white"><i
                                            class="el-icon-takeaway-box fs-22 mr-3 v-m-3"></i> <span>{{$indexof->name_D}}</span></h6>
                                </div>
                            </div>
                        </div>
                    </a></div>
            </div>
            {{--four pic end --}}
            <el-row :gutter="20" class="bk-style">
                <div class="d-flex app-content-header mb-6">
                    <div class="main-title"><h4 class="i-con-h-a mb-0">
                            <i class="mr-1 text-muted i-con i-con-calendar v-m-4"><i></i></i> <span>最新文章</span></h4>
                    </div>
                </div>
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
                                                class="text-muted"
                                                target="_blank">{{ $cate[$p->cate_id-1]['cate_name'] }}</a>
                                        </div>
                                        <a href="{{ url('post',['id'=> $p->id]) }}"
                                           title="{{ $p->post_name }}"
                                           class="list-title text-md h-2x">{{ $p->post_name }}</a>
                                    </div>
                                    <div class="list-footer d-flex align-items-center text-muted mt-1 mt-lg-2">
                                        <div class="text-xs">{{ $p->tranTime($p->createTime) }}</div>
                                        <div class="flex-fill"></div>
                                        <div class="text-xs text-nowrap bk-codes">
                                            <span class="d-none d-md-inline-block  mr-1 mr-md-2"><i
                                                    class="text-md el-icon-view"></i><span
                                                    class="d-inline-block align-middle">{{ !empty($p->see) ? $p->see : '0' }}</span></span>
                                            <span class="d-none d-md-inline-block "><i
                                                    class="text-md fa fa-heart-o"></i><span
                                                    class="d-inline-block align-middle">{{ !empty($p->likeof) ? $p->likeof : '0' }}</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </el-col>
                @endforeach
            </el-row>

@endsection
