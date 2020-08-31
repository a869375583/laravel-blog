@extends('common.adminly')
@section('title')
    分类管理
@endsection

@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        @include('common.message')
                        <h6 class="card-title">分类列表</h6>
                        <p class="card-write"><a href="{{ url('admin/add_cate') }}" class="el-button el-button--primary"> 新增分类</a></p>
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        分类名称
                                    </th>
                                    <th>
                                        分类别名
                                    </th>
                                    <th>
                                        操作
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cates as $cate)
                                <tr>
                                    <td>
                                        {{ $cate->id }}
                                    </td>
                                    <td>
                                        {{ $cate->cate_name }}
                                    </td>
                                    <td>
                                        {{ $cate->cate_othername }}
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/c_cate',['id'=>$cate->id]) }}" class="el-button el-button--primary">编辑分类</a>
                                        <a href="{{ url('admin/d_cate',['id'=>$cate->id]) }}" class="el-button el-button--primary">删除分类</a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="message-pages">
                                {{ $cates->render() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
