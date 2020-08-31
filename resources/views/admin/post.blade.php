@extends('common.adminly')
@section('title')
    文章管理
@endsection
@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        @include('common.message')
                        <h6 class="card-title">文章列表</h6>
                        <p class="card-write"><a href="{{ url('admin/add_post') }}" class="el-button el-button--primary"> 新增文章</a></p>
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        文章名称
                                    </th>
                                    <th>
                                        封面图
                                    </th>
                                    <th>
                                        分类
                                    </th>
                                    <th>
                                        创建时间
                                    </th>
                                    <th>
                                        操作
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($post as $postinfo)
                                <tr>
                                    <td>
                                        {{ $postinfo->id }}
                                    </td>
                                    <td>
                                        {{ $postinfo->post_name }}
                                    </td>
                                    <td>
                                        <img src="{{ !empty($postinfo->pic) ? $postinfo->pic : '/static/images/empty.png' }}" alt="" class="blog-img">
                                    </td>
                                    <td>
                                        {{ $cate[$postinfo->cate_id-1]['cate_name'] }}
                                    </td>
                                    <td>
                                        {{ $postinfo->createTime }}
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/c_post',['id'=> $postinfo->id]) }}" class="el-button el-button--primary">编辑文章</a>
                                        <a href="{{ url('admin/d_post',['id'=> $postinfo->id]) }}" class="el-button el-button--primary">删除文章</a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="message-pages">
                                {{ $post->render() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
