$(function(){
    var app = new Vue({
        el:'#app',
        data:{
            username:'',
            password:'',
            passwordt:''
        },
    })
    setTimeout(() => {
        app.loading = false;
    }, 500);
    $('.ava').click(function(){
        $('.userof').fadeToggle(300);
    });
    $('.cate_list').click(function(){
        $('.topcate').fadeToggle(300);
    });
    $('.websearch button').click(function(){
        $('.pop-tips').slideToggle(500);
    })
    $('.pop-tips-close').click(function(){
        $('.pop-tips').css('display','none');
    })
    //代码高亮自定义
    $("code").each(function(){
        $(this).html("<ul><li>" + $(this).html().replace(/\n/g,"\n</li><li>") +"\n</li></ul>");
    });
    $('pre').each(function(i,block){
        hljs.highlightBlock(block);
    });
    $('pre code').each(function(){
        var lineser = $("span").length;
        var $numbering = $('<ul/>').addClass('pre-numbering');
        $(this)
            .addClass('has-numbering')
            .parent()
            .append($numbering);
        for(var j=1;j<=lineser;j++){
            $numbering.append($('<li/>').text(j));
        }
    });
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $('.btn-love').click(function() {
        var id = $(this).data("id");
        console.log(id);
        $.ajax({
            url: '/post/'+id,
            type: 'post',
            data: {
                id: id
            },
            dataType:'json',
            success:function(data) {
                if (data.status == '200') {
                    app.$message({
                        message:data.message,
                        type:'success'
                    })
                    $('#loveCount,.meta span:last-child').html(data.like);
                } else if (data.status=='nologin'){
                    app.$message({
                        message:data.message,
                        type:'warning'
                    })
                }else {
                    app.$message({
                        message:data.message,
                        type:'error'
                    })
                }

            }
        });
    });
})



