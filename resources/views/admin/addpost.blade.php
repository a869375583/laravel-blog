@extends('common.adminly')
@section('title')
    新增文章
@endsection

@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        @include('common.message')
                        <h6 class="card-title">新增文章</h6>
                        <form action="" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label >文章名称</label>
                                <input type="text" class="form-control" name="post_name" placeholder="请输入文章标题">
                            </div>
                            <div class="form-group">
                                <input type="hidden" id="select_content" value="1" name="select_content" />
                                <label >分类</label>
                                <select class="form-control" id="sele">
                                    @foreach($cates as $cate)
                                    <option value="{{ $cate->id }}">{{ $cate->cate_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label >文章封面</label>
                                <el-upload
                                    class="upload-demo"
                                    drag
                                    :headers = "{'X-CSRF-TOKEN':csrfToken}"
                                    action="/admin/add_post"
                                    multiple
                                    accep ='.jpg,.png'
                                    :before-upload="beforeUpload"
                                    :on-success="handle_success"
                                    style="width: 100%">
                                    <i class="el-icon-upload"></i>
                                    <div class="el-upload__text">只能上传jpg/png文件，将文件拖到此处，或<em>点击上传</em></div>
                                </el-upload>
                                <input type="hidden" value="" class="pic" name="pict">
                            </div>
                            <div class="form-group">
                                <label >下载地址（选填）</label>
                                <input type="text" class="form-control" name="download" placeholder="如有下载，请填写">
                            </div>
                            <div class="form-group">
                                <label >下载文件名称（选填）</label>
                                <input type="text" class="form-control" name="dwname" placeholder="如有下载，请填写">
                            </div>
                            <div class="form-group">
                                <label >下载文件描述（选填）</label>
                                <input type="text" class="form-control" name="dwdes" placeholder="如有下载，请填写">
                            </div>
                            <div class="form-group">
                                <label >内容</label>
                                <div id="div1" >
                                </div>
                                <input id="text1" style="float:left;" name="content" type="hidden">
                            </div>
                            <button id="btn" class="btn btn-primary" type="submit">提交修改</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('static/js/wangEditor.min.js') }}"></script>
    <script src="{{ asset('static/js/editor.js') }}"></script>
@endsection
