@extends('common.adminly')
@section('title')
    系统设置
@endsection
@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">系统设置</h6>
                        <form action="" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label >网站标题</label>
                                <input type="text" class="form-control" name="System[title]" value="{{ $systems->title }}">
                            </div>
                            <div class="form-group">
                                <label >网站副标题</label>
                                <input type="text" class="form-control" name="System[web_title]"  value="{{ $systems->web_title }}">
                            </div>
                            <div class="form-group">
                                <label >关键词</label>
                                <input type="text" class="form-control"  name="System[keyword]" value="{{ $systems->keyword }}">
                            </div>
                            <div class="form-group">
                                <label >描述</label>
                                <input type="text" class="form-control" name="System[description]"  value="{{ $systems->description }}">
                            </div>
                            <div class="form-group">
                                <label >网站URL</label>
                                <input type="text" class="form-control" name="System[site]"  value="{{ $systems->site }}">
                            </div>
                            <div class="form-group">
                                <label >网站LOGO</label>
                                <input type="text" class="form-control" name="System[logo]"  value="{{ $systems->logo }}">
                                <input type="file" class="form-upload" name="source" id="file">
                            </div>
                            <div class="form-group">
                                <label >底部版权</label>
                                <input type="text" class="form-control"  name="System[copyright]" value="{{ $systems->copyright }}">
                            </div>
                            <button class="el-button el-button--primary" type="submit">提交修改</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
