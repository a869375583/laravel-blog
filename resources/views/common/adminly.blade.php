<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - 管理中心</title>
    <link href="https://lib.baomitu.com/element-ui/2.13.2/theme-chalk/index.css" rel="stylesheet">
    <script src="https://lib.baomitu.com/vue/2.6.11/vue.min.js"></script>
    <script src="https://lib.baomitu.com/element-ui/2.13.2/index.js"></script>
    <script src="{{ asset('/static/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/static/js/admin.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('/static/css/admin.css') }}">
</head>

<body>
<div class="main-wrapper" id="app">
    <nav class="sidebar">
        <div class="sidebar-header">
            <a href="#" class="sidebar-brand">
                BLOG
                <span>

                UI

            </span>
            </a>
            <div class="sidebar-toggler not-active">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div class="sidebar-body ps">
            <ul class="nav">
                <li class="nav-item nav-category">

                    主要

                </li>
                <li class="nav-item  {{ Request::getPathInfo() == '/admin/index'? 'active' : '' }}">
                    <a href="{{ url('admin/index') }}" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box link-icon">
                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                            <line x1="12" y1="22.08" x2="12" y2="12"></line>
                        </svg>
                        <span class="link-title">

                        仪表板

                    </span>
                    </a>
                </li>
                <li class="nav-item nav-category">

                    设置

                </li>
                <li class="nav-item {{ Request::getPathInfo() == '/admin/system'? 'active' : '' }}">
                    <a href="{{ url('admin/system') }}" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-anchor link-icon">
                            <circle cx="12" cy="5" r="3"></circle>
                            <line x1="12" y1="22" x2="12" y2="8"></line>
                            <path d="M5 12H2a10 10 0 0 0 20 0h-3"></path>
                        </svg>
                        <span class="link-title">

                        系统设置

                    </span>
                    </a>
                </li>
                <li class="nav-item {{ Request::getPathInfo() == '/admin/post' ? 'active' : '' }}">
                    <a href="{{ url('admin/post') }}" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square link-icon">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                        </svg>
                        <span class="link-title">

                        文章管理

                    </span>
                    </a>
                </li>
                <li class="nav-item {{ Request::getPathInfo() == '/admin/cate' ? 'active' : '' }}">
                    <a href="{{ url('admin/cate') }}" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar link-icon">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        <span class="link-title">

                        分类管理

                    </span>
                    </a>
                </li>
                <li class="nav-item nav-category">

                    管理员设置

                </li>
                <li class="nav-item {{ Request::getPathInfo() == '/admin/password' ? 'active' : '' }}">
                    <a href="{{ url('admin/password') }}" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-unlock link-icon">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 9.9-1"></path>
                        </svg>
                        <span class="link-title">

                        密码修改

                    </span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
<!-- partial -->

    <div class="page-wrapper">

        <!-- partial:partials/_navbar.html -->
        <nav class="navbar">
            <a href="#" class="sidebar-toggler">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </a>
            <div class="navbar-content">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown nav-profile">
                        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="/static/images/avatar.jpg" alt="个人资料">
                        </a>
                        <div class="dropdown-menu" aria-labelledby="profileDropdown">
                            <div class="dropdown-header d-flex flex-column align-items-center">
                                <div class="figure mb-3">
                                    <img src="/static/images/avatar.jpg" alt="">
                                </div>
                                <div class="info text-center">
                                    <p class="name font-weight-bold mb-0">Administrator</p>
                                    <p class="email text-muted mb-3">后台管理中心</p>
                                </div>
                            </div>
                            <div class="dropdown-body">
                                <ul class="profile-nav p-0 pt-3">
                                    <li class="nav-item">
                                        <a href="{{ url('admin/password') }}" class="nav-link">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="12" cy="7" r="4"></circle>
                                            </svg>
                                            <span>修改密码</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/post') }}" class="nav-link">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg>
                                            <span>文章管理</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/un') }}" class="nav-link">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out">
                                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                                <polyline points="16 17 21 12 16 7"></polyline>
                                                <line x1="21" y1="12" x2="9" y2="12"></line>
                                            </svg>
                                            <span>退出登录</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    <!-- partial -->
        @yield('content')
        <!-- partial:partials/_footer.html -->
        <footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between">
            <p class="text-muted text-center text-md-left">
                版权所有©2020
                <a href="#" target="_blank">
                    Blog
                </a>
                版权所有
            </p>
        </footer>
    <!-- partial -->
    </div>
</div>

</body>

</html>
