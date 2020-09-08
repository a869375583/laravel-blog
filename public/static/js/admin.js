$(function(){
    var app = new Vue({
        el:'#app',
        data:{
            csrfToken: $('meta[name="csrf-token"]').attr('content'),
            formLabelAlign: {
                nameA: '',
                nameB: '',
                nameC: '',
                nameD: '',
                picA:'',
                picB:'',
                picC:'',
                picD:'',
            },
            handle_success(res) {
                $('.pic').val(res.pic);
                this.$message.success('图片上传成功')
            },
            beforeUpload(file) {
                var testmsg=file.name.substring(file.name.lastIndexOf('.')+1)
                const extension = testmsg === 'jpg'
                const extension2 = testmsg === 'png'
                if(!extension && !extension2) {
                    this.$message({
                        message: '上传文件只能是 jpg、png格式!',
                        type: 'warning'
                    });
                }
                return extension || extension2
            },
        },
        mounted(){
            axios.post('/admin/setting_data',{})
            .then(function (response) {
                let data=app.formLabelAlign;
                data.nameA = response.data.name_A;
                data.nameB = response.data.name_B;
                data.nameC = response.data.name_C;
                data.nameD = response.data.name_D;
                data.picA = response.data.pic_A;
                data.picB = response.data.pic_B;
                data.picC = response.data.pic_C;
                data.picD = response.data.pic_D;
            })
        },
        methods:{
            onSubmit(){
                let data=this.formLabelAlign;
                let nameA = data.nameA;
                let nameB = data.nameB;
                let nameC = data.nameC;
                let nameD = data.nameD;
                let picA = data.picA;
                let picB = data.picB;
                let picC = data.picC;
                let picD = data.picD;
                axios.post('', {
                    name_A:nameA,
                    name_B:nameB,
                    name_C:nameC,
                    name_D:nameD,
                    pic_A:picA,
                    pic_B:picB,
                    pic_C:picC,
                    pic_D:picD,
                })
                .then(function (response) {
                    if (response.status == 200){
                        app.$message({
                            message:'修改成功',
                            type:'success'
                        });
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
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
