@extends('common.adminly')
@section('title')
    编辑文章
@endsection

@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">编辑文章</h6>
                        @include('common.message')
                        <form action="" method="post">
                            @csrf
                            <div class="form-group">
                                <label >文章名称</label>
                                <input type="text" class="form-control" name="post_name" value="{{ $post->post_name }}">
                            </div>
                            <div class="form-group">
                                <input type="hidden" id="select_content" value="{{ $post->cate_id }}" name="select_content" />
                                <label >分类</label>
                                <select class="form-control" id="sele">
                                    @foreach($cates as $cat)
                                    <option {{ $cat->id == $post->cate_id ? 'selected' : '' }}
                                        value="{{ $cat->id }}">{{ $cat->cate_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label >内容</label>
                                <div id="div1" >
                                    <p>{{ $post->content }}</p>
                                </div>
                                <input id="text1" style="float:left;" name="content" type="hidden" value="{{$post->content}}" >
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
