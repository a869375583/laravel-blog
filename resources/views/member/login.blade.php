@extends('common.layout')
@section('title')
    登录页面
@endsection
@section('content')
    <!-- login mode  -->
    <div class="be-content pren">
        <div class="ioc_text">
            <img src="{{ asset('static/images/logo.png') }}" alt="">
            <span class="tipof">请登录您的用户</span>
            @include('common.message')
        </div>
        <div>
            <form action="" method="post">
                @csrf
                <div class="br-content">
                    <div class="input-group mb-4 bootint">
                        <el-input placeholder="请输入账号" v-model="username"  name="User[username]">
                            <template slot="prepend"><i class="el-icon-user"></i></template>
                        </el-input>
                    </div>
                    <div class="input-group mb-4 bootint">
                        <el-input placeholder="请输入密码" v-model="password"  show-password name="User[password]">
                            <template slot="prepend"><i class="el-icon-lock"></i></template>
                        </el-input>
                    </div>
                    <div style="padding-top: 10px">
                        <input type="submit" class="btn btn-login" value="登录">
                    </div>
                    <div class="be-con">
                        <span>Copyright © 2019 - 2020 <a href="{{ url('member/register') }}">用户注册</a></span>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- login mode end  -->
@endsection
