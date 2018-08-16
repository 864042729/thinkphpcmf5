<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
        <title>自己研究的plupload上传视频等大文件</title>

        <link href="/Public/css/common.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="/Public/js/jquery.min.js"></script>
    </head>
    <body>
        <div class="demo clearfix" style="width:600px;margin:120px auto">
            <input type="file" id="upfile">
            <a onclick="showVideoUploadBox($('#btn_video'))" id="btn_video" class="item"><i class="icon_emot_photo_video icon_video"></i><span>视频</span></a>
        </div>
        <div class="FileArea"></div>
    </body>
    <script>
        var str = "";
        $("#upfile").on("change", function () {
            var obj = document.getElementById("upfile");
            var length = obj.files.length;
            for (var i = 0; i < length; i++) {
                $(".FileArea").html("");
                var temp = obj.files[i].name;
                console.log(obj.files[i]);
                cutting(obj.files[i].size);
                str += "<div>" + temp + "</div>";
            }
            $(".FileArea").append(str);
        });
        function cutting(size) {
            var count = (size/1024/1024/1);
            alert(parseInt(count));
//            for(var j=0;j<)
        }
    </script>
</html>