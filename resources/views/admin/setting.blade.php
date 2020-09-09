@extends('common.adminly')
@section('title')
    首页设置
@endsection
@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        @include('common.message')
                        <h6 class="card-title">首页四图设置</h6>
                        <el-form  label-width="80px" :model="formLabelAlign" enctype="multipart/form-data">
                            @csrf
                            <el-form-item label="图A文字">
                                <el-input v-model="formLabelAlign.nameA" name="nameA"></el-input>
                            </el-form-item>
                            <el-form-item label="图A链接">
                                <el-input v-model="formLabelAlign.picA" name="picA"></el-input>
                            </el-form-item>
                            <el-form-item label="图B文字">
                                <el-input v-model="formLabelAlign.nameB" name="nameB"></el-input>
                            </el-form-item>
                            <el-form-item label="图B链接">
                                <el-input v-model="formLabelAlign.picB" name="picB"></el-input>
                            </el-form-item>
                            <el-form-item label="图C文字">
                                <el-input v-model="formLabelAlign.nameC" name="nameC"></el-input>
                            </el-form-item>
                            <el-form-item label="图C链接">
                                <el-input v-model="formLabelAlign.picC" name="picC"></el-input>
                            </el-form-item>
                            <el-form-item label="图D文字">
                                <el-input v-model="formLabelAlign.nameD" name="nameD"></el-input>
                            </el-form-item>
                            <el-form-item label="图D链接">
                                <el-input v-model="formLabelAlign.picD" name="picD"></el-input>
                            </el-form-item>
                            <h6 class="card-title">首页轮播图设置</h6>
                            <el-upload
                                class="upload-demo"
                                drag
                                :headers = "{'X-CSRF-TOKEN':csrfToken}"
                                action="/admin/index_banner"
                                multiple
                                accep ='.jpg,.png'
                                :before-upload="beforeUpload"
                                :on-success="handle_success">
                                <i class="el-icon-upload"></i>
                                <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em></div>
                                <div class="el-upload__tip" slot="tip">只能上传jpg/png文件，且不超过500kb</div>
                            </el-upload>
                            <ul class="el-upload-list el-upload-list--picture">
                                @foreach($banner as $b)
                                <li tabindex="0" class="el-upload-list__item is-success"><img
                                        src="{{$b->pics}}"
                                        alt="" class="el-upload-list__item-thumbnail"><a
                                        class="el-upload-list__item-name">
                                    </a>
                                    <label class="el-upload-list__item-status-label">
                                        <i class="el-icon-upload-success el-icon-check"></i>
                                    </label>
                                    <a href="/admin/del_img/{{$b->id}}"><i class="el-icon-close"></i></a><i class="el-icon-close-tip">按 delete 键可删除</i>
                                </li>
                                @endforeach
                            </ul>
                            <el-button type="primary" @click="onSubmit">立即提交</el-button>
                        </el-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
