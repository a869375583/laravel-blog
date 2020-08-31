<!-- 成功提示框 -->
@if(Session::has('success'))
    <el-alert
        title="{{ Session::get('success') }}"
        type="success"
        center
        show-icon>
    </el-alert>
@endif
@if(Session::has('error'))
    <!-- 失败提示框 -->
    <el-alert
        title="{{ Session::get('error') }}"
        type="error"
        center
        show-icon>
    </el-alert>
@endif
