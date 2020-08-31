@extends('common.adminly')
@section('title')
    首页
@endsection
@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-12 col-xl-12 stretch-card">
                <div class="row flex-grow">
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <h6 class="card-title mb-0">用户数量</h6>
                                </div>
                                <div class="row">
                                    <div class="col-6 col-md-12 col-xl-5">
                                        <h3 class="mb-2">{{ $usernum->total() }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <h6 class="card-title mb-0">文章数量</h6>
                                </div>
                                <div class="row">
                                    <div class="col-6 col-md-12 col-xl-5">
                                        <h3 class="mb-2">{{ $postnum->total() }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <h6 class="card-title mb-0">分类数量</h6>
                                </div>
                                <div class="row">
                                    <div class="col-6 col-md-12 col-xl-5">
                                        <h3 class="mb-2">{{ $catenum->total() }}</h3>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- row -->
        <div class="row">
            <div class="col-lg-5 col-xl-4 grid-margin grid-margin-xl-0 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <h6 class="card-title mb-0">最新用户</h6>
                        </div>
                        @foreach($user as $userinfo)
                        <div class="d-flex flex-column">
                            <a href="#" class="d-flex align-items-center border-bottom pb-3">
                                <div class="mr-3">
                                    <img src="/static/images/avatar.jpg" class="rounded-circle wd-35" alt="用户">
                                </div>
                                <div class="w-100">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="text-body mb-2">{{ $userinfo->username }}</h6>
                                    </div>
                                    <p class="text-muted tx-13">ID：{{ $userinfo->id }}</p>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-xl-8 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline mb-2">
                            <h6 class="card-title mb-0">最新文章</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                <tr>
                                    <th class="pt-0">ID</th>
                                    <th class="pt-0">文章名称</th>
                                    <th class="pt-0">发布时间</th>
                                    <th class="pt-0">状态</th>
                                    <th class="pt-0">浏览量</th>
                                    <th class="pt-0">喜欢</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($post as $postinfo)
                                <tr>
                                    <td>{{ $postinfo->id }}</td>
                                    <td>{{ $postinfo->post_name }}</td>
                                    <td>{{ $postinfo->createTime }}</td>
                                    <td><span class="badge badge-danger">已发布</span></td>
                                    <td>{{ $postinfo->see == '' ? '0' : $postinfo->see }}</td>
                                    <td>{{ $postinfo->likeof == '' ? '0' : $postinfo->likeof }}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- row -->

    </div>
@endsection
