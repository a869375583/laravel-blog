@extends('common.adminly')
@section('title')
    修改密码
@endsection

@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        @include('common.message')
                        <h6 class="card-title">修改密码</h6>
                        <form action="" method="post">
                            @csrf
                            <div class="form-group">
                                <label >旧密码</label>
                                <input type="password" class="form-control" name="old_password" placeholder="请输入旧密码">
                            </div>
                            <div class="form-group">
                                <label >新密码</label>
                                <input type="password" class="form-control" name="new_password" placeholder="请输入新密码">
                            </div>
                            <div class="form-group">
                                <label >二次密码</label>
                                <input type="password" class="form-control" name="news_password" placeholder="请二次输入密码">
                            </div>
                            <button class="btn btn-primary" type="submit">提交修改</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
