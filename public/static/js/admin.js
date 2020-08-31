$(function(){
    var app = new Vue({
        el:'#app',
        data:{
            csrfToken: $('meta[name="csrf-token"]').attr('content'),
            handle_success(res) {
                $('.pic').val(res.pic);
                this.$message.success('图片上传成功')
            },
            beforeUpload(file) {
                var testmsg=file.name.substring(file.name.lastIndexOf('.')+1)
                const extension = testmsg === 'jpg'
                const extension2 = testmsg === 'png'
                // const isLt2M = file.size / 1024 / 1024 < 10
                if(!extension && !extension2) {
                    this.$message({
                        message: '上传文件只能是 jpg、png格式!',
                        type: 'warning'
                    });
                }
                return extension || extension2
            },
        },
    })
    var ad = new Vue({
        el:'.login',
        data:{
            ruleForm: {
                name: '',
                password:'',
            },
            rules: {
                name: [
                    { required: true, message: '请输入账号', trigger: 'blur' },
                ],
                password: [
                    { required: true, message: '请输入密码', trigger: 'blur' },
                ]
            }
        },
        methods: {
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        let data=this.ruleForm;
                        let formData=new FormData();
                        formData.append('name',data.name);
                        formData.append('password',data.password);
                        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                        $.ajax({
                            url:"/admin/login",
                            type:'post',
                            cache:false,
                            data: {
                                name:data.name,
                                password :data.password
                            },
                            dataType:'json',
                            success: function(msg){
                                if (msg.state == 200){
                                    ad.$message({
                                        message:'登录成功',
                                        type:'success'
                                    });
                                    window.location.href="index";
                                }else if (msg.state == 404){
                                    ad.$message({
                                        message:'账号不存在',
                                        type:'error'
                                    })
                                }else{
                                    ad.$message({
                                        message:'密码错误',
                                        type:'error'
                                    })
                                }
                            }
                        });
                    } else {
                        this.$message({
                            message:'账号或密码为空',
                            type:'error'
                        });
                        return false;
                    }
                });
            },
            resetForm(formName) {
                this.$refs[formName].resetFields();
            }
        }
    });


    $('.nav-profile .dropdown-toggle').click(function(){
        $('.dropdown-menu').fadeToggle('show');
    });
    $("#sele").click(function(){
        var values = $("#sele option:selected").val();
        $('#select_content').val(values);
    });
    $('.sidebar-toggler').click(function(){
        $('body').toggleClass('sidebar-folded');
    })

})
