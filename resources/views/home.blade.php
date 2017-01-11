<!doctype html>
<html lang="zh-cn">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>L53</title>
    <meta name="author" content="李潇喃：www.muzisheji.com" />
    <!-- IE最新兼容 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- 国产浏览器高速/微信开发不要用 -->
     <meta name="renderer" content="webkit">
     
    <!-- 移动设备禁止缩放 -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- No Baidu Siteapp-->
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="stylesheet" href="{{ $sites['url'] }}{{ $sites['static']}}common/meditor/css/editormd.min.css" />
    <script src="{{ $sites['url'] }}{{ $sites['static']}}common/js/jquery.min.js"></script>
    <script src="{{ $sites['url'] }}{{ $sites['static']}}common/meditor/editormd.js"></script>
</head>

<body>
    <style>
        html {
            height:100%;
        }
        body {
            height:50%;
        }
    </style>
    <div id="editormd">
        <textarea style="display:none;">### Hello Editor.md !</textarea>
    </div>
    <script type="text/javascript">
        $(function() {
            var editor = editormd("editormd", {
                emoji : true,
                path : "{{ $sites['url'] }}{{ $sites['static']}}common/meditor/lib/",
                imageUpload    : true,
                imageFormats   : ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
                imageUploadURL : "./php/upload.php",
            });

        });
    </script>
</body>

</html>
