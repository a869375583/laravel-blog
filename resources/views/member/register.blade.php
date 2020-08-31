@extends('common.layout')
@section('title')
    注册页面
@endsection
@section('content')
    <div class="be-content pren">
        <div class="ioc_text">
            <img src="/static/images/logo.png" alt="">
            <span class="tipof">请注册您的用户</span>
            @include('common.message')
        </div>
        <div>
            <form action="" method="post">
                @csrf
                <div class="br-content">
                    <div class="input-group mb-4 bootint">
                        <el-input placeholder="用户名" v-model="username"  name="User[username]">
                            <template slot="prepend"><i class="el-icon-user"></i></template>
                        </el-input>
                    </div>
                    <div class="input-group mb-4 bootint">
                        <el-input placeholder="密码" v-model="password"  show-password name="User[password]">
                            <template slot="prepend"><i class="el-icon-lock"></i></template>
                        </el-input>
                    </div>
                    <div class="input-group mb-4 bootint">
                        <el-input placeholder="二次密码" v-model="passwordt"  show-password name="User[passwordt]">
                            <template slot="prepend"><i class="el-icon-lock"></i></template>
                        </el-input>
                    </div>
                    <div style="padding-top: 10px">
                        <input type="submit" class="btn" value="立即注册">
                    </div>
                    <div class="be-con">
                        <span>Copyright © 2019 - 2020 <a href="{{ url('member/login') }}">用户登录</a></span>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
