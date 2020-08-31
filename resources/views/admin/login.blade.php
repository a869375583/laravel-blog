<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Blog后台管理</title>
    <link href="https://lib.baomitu.com/element-ui/2.13.2/theme-chalk/index.css" rel="stylesheet">
    <script src="https://lib.baomitu.com/vue/2.6.11/vue.min.js"></script>
    <script src="https://lib.baomitu.com/element-ui/2.13.2/index.js"></script>
    <link rel="stylesheet" href="{{ asset('static/css/admin_login.css') }}">
    <script src="{{ asset('static/js/jquery.min.js') }}"></script>
    <script src="{{ asset('static/js/admin.js') }}"></script>
</head>

<body>
<div class="login">
    <h1>管理员登录</h1>
    @include('common.message')
    <div class="formcode">
        <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="demo-ruleForm" action="index.php" method="post">
            @csrf
            <el-form-item label="用户名称" prop="name">
                <el-input v-model="ruleForm.name"></el-input>
            </el-form-item>
            <el-form-item label="用户密码" prop="password">
                <el-input  type="password" v-model="ruleForm.password"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="submitForm('ruleForm')">立即登录</el-button>
                <el-button @click="resetForm('ruleForm')">重置</el-button>
            </el-form-item>
        </el-form>
    </div>
</div>
</body>

</html>
