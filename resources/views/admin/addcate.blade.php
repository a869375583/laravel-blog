@extends('common.adminly')
@section('title')
    新增分类
@endsection
@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        @include('common.message')
                        <h6 class="card-title">新增分类</h6>
                        <form action="" method="post">
                            @csrf
                            <div class="form-group">
                                <label >分类名称</label>
                                <input type="text" class="form-control" name="cate_name" placeholder="请输入分类名称">
                            </div>
                            <div class="form-group">
                                <label >分类别名</label>
                                <input type="text" class="form-control" name="cate_othername" placeholder="请输入分类别名">
                            </div>
                            <button class="btn btn-primary" type="submit">提交新增</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
