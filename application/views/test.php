<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>CDI_wechat_platform_test</title>
    </head>

    <body>
        <div id="content">tzwm</div>
    </body>

    <script src="/orderonline/public/js/socket.io.js"></script>

    <script>
        var  socket = io.connect('http://qianglee.com:8000');
        socket.on('connection', function(data) {
            document.getElementById('content').innerHTML = data.name;
        });    
    </script>

</html>