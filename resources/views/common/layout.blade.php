<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keyword" content="{{$sys->keyword}}">
    <meta name="description" content="{{$sys->description}}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://lib.baomitu.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://lib.baomitu.com/element-ui/2.13.2/theme-chalk/index.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('static/css/public.css') }}">
    <link rel="stylesheet" href="{{ asset('static/css/index.css') }}">
    <script src="https://lib.baomitu.com/vue/2.6.11/vue.min.js"></script>
    <script src="https://lib.baomitu.com/element-ui/2.13.2/index.js"></script>
    <script src="{{ asset('static/js/jquery.min.js') }}"></script>
    <script src="{{ asset('static/js/index.js') }}"></script>
    <script src="http://cdn.bootcss.com/highlight.js/8.0/highlight.min.js"></script>
</head>

<body>
<!-- header mode  -->
<div id="app">
    <header>
        <div class="top">
            <div class="topLogo">
                <a href="/"><img src="{{ $sys->logo }}" alt=""></a>
            </div>
            <button class="cate_list"><i class="fa fa-list"></i></button>
            <div class="topcate">
                <ul>
                    @foreach($cate as $cates)
                    <li><a href="{{ url('category',['id'=>$cates->id]) }}" class="{{ Request::getPathInfo() == '/category/'.$cates->id ? 'active':'' }}">{{ $cates->cate_name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="regin">
                @if(Session::has('username'))
                <a href="javascript:;" class="ava"><img src="{{ asset('static/images/avatar.jpg') }}" alt=""></a>
                <div class="userof">
                    <a href="{{ url('member/un') }}">退出</a>
                </div>
                @else
                <a href="{{ url('member/login') }}" class="btn-login">登录</a>
                <a href="{{ url('member/register') }}" class="btn-reg">注册</a>
                @endif
            </div>
        </div>
    </header>
    <!-- header mode end  -->

    <!-- main mode  -->
    @yield('content')
    <!-- main mode end  -->
    <!-- search dialog  -->
    <div class="pop-tips search text-light" style="display: none;">
        <div class="overlay"></div>
        <div class="pop-tips-body">
            <div class="pop-tips-content">
                <div class="bg-effect  wallpaper-one"></div> <span class="overlay"></span>
                <div class="search-popup-cover pa-5">
                    <form action="search.php" method="get" name="searchform">
                        <input autofocus="autofocus" name="s" type="text" placeholder="请输入关键词搜索..." class="form-control form-transparent">
                    </form>
                </div>
            </div>
            <div class="pop-tips-close"><svg t="1553064665406" class="icon w-32" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="3368" xmlns:xlink="http://www.w3.org/1999/xlink" width="200" height="200">
                    <defs></defs>
                    <path d="M512 12C235.9 12 12 235.9 12 512s223.9 500 500 500 500-223.9 500-500S788.1 12 512 12z m166.3 609.7c15.6 15.6 15.6 40.9 0 56.6-7.8 7.8-18 11.7-28.3 11.7s-20.5-3.9-28.3-11.7L512 568.6 402.3 678.3c-7.8 7.8-18 11.7-28.3 11.7s-20.5-3.9-28.3-11.7c-15.6-15.6-15.6-40.9 0-56.6L455.4 512 345.7 402.3c-15.6-15.6-15.6-40.9 0-56.6 15.6-15.6 40.9-15.6 56.6 0L512 455.4l109.7-109.7c15.6-15.6 40.9-15.6 56.6 0 15.6 15.6 15.6 40.9 0 56.6L568.6 512l109.7 109.7z" p-id="3369"></path>
                </svg></div>
        </div>
    </div>
    <!-- search dialog end  -->
    <!-- footer ok -->
    <footer>
        <p>Copyright © 2020 {{$sys->title}} All Rights Reserved</p>
        <span>备案号：</span>
        <a target="_blank" href="http://www.beian.miit.gov.cn/"><span>{{$sys->copyright}}</span></a>
    </footer>
</div>
<!-- footer over end  -->
</body>

</html>
