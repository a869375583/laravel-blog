$(function () {
// editor start
    var E = window.wangEditor;
    var editor = new E('#div1');
    var $text1 = $('#text1')

    //第一步是先获取服务器传过来的图文信息值
    var info1 = document.getElementById("text1").value;
    //把图文信息的值通过innerHTML赋值给编辑器
    document.getElementById("div1").innerHTML=info1;


    editor.customConfig.uploadImgHeaders = {
        'X-CSRF-TOKEN': $('input[name="_token"]').val()
    }
    editor.customConfig.uploadImgServer = '/posts/image/upload';
    editor.customConfig.uploadFileName = 'images';
    editor.customConfig.showLinkImg = false;
    //开启wangEditor的错误提示，有利于我们更快的找到出错的地方
    editor.customConfig.debug=true;
    editor.customConfig.uploadFileName = 'wangEditorH5File';
    editor.customConfig.uploadImgHooks = {
        customInsert: function (insertImg, result, editor) {
            var url = result.data;
            //上传图片回填富文本编辑器
            insertImg(url);
        }
    };
    editor.create();

    document.getElementById('btn').addEventListener('click', function () {
        var res = editor.txt.html();
        var title = $("input[name=title]").val();

        var info = editor.txt.html();
        document.getElementById("text1").value=info;

    }, false);
    // editor end
})
