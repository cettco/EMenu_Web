<!DOCTYPE html>
<!-- saved from url=(0053)http://wbpreview.com/previews/WB0F56883/register.html -->
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>EMenu - 后台管理</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Responsive HTML template for Your company">
        <meta name="author" content="Oskar Żabik (oskar.zabik@gmail.com)">
        <!-- Le styles -->
        <link href="http://wbpreview.com/previews/WB0F56883/css/bootstrap.min.css" rel="stylesheet">
        <link href="http://wbpreview.com/previews/WB0F56883/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link rel="stylesheet" href="http://wbpreview.com/previews/WB0F56883/css/typica-login.css">
        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
                    <!--[if lt IE 9]>
                  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
                <![endif]-->
        <!-- Le favicon -->
        <link rel="shortcut icon" href="http://wbpreview.com/previews/WB0F56883/favicon.ico">
        <style type="text/css"></style>
        <script type="text/javascript" charset="UTF-8" src="/orderonline/public/login/logb02.js"></script>
        <script></script>
        <script id="hp_same_"></script>
        <script id="hp_done_"></script>
        <style>@-moz-keyframes nodeInserted{from{opacity:0.99;}to{opacity:1;}}@-webkit-keyframes nodeInserted{from{opacity:0.99;}to{opacity:1;}}@-o-keyframes nodeInserted{from{opacity:0.99;}to{opacity:1;}}@keyframes nodeInserted{from{opacity:0.99;}to{opacity:1;}}embed,object{animation-duration:.001s;-ms-animation-duration:.001s;-moz-animation-duration:.001s;-webkit-animation-duration:.001s;-o-animation-duration:.001s;animation-name:nodeInserted;-ms-animation-name:nodeInserted;-moz-animation-name:nodeInserted;-webkit-animation-name:nodeInserted;-o-animation-name:nodeInserted;}</style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="span6">

                    <div class="register-info-wraper">
                        <div id="register-info">

                            <h1>欢迎使用</h1>
                            <h2>EMenu电子点餐系统<h2>
                                    <ul dir="rtl">
                                        <li>方便快捷</li>
                                        <li>无需等待</li>
                                        <li>服务至上</li>
                                        <li>Let's EMenu</li>
                                    </ul>

                        </div>
                    </div>
                </div>
                <div class="span6">
                    <div id="register-wraper">
                        <form enctype="multipart/form-data" action="/orderonline/index.php/SystemManage/UserRegister" method="post">
                            <legend>Register to <span class="blue">EMenu</span></legend>

                            <div class="body">
                                                                    <!--
                                    
                                                                <div class="control-group control-inline">
                                                                    <label for="name">姓</label>
                                                                    <input name="name" class="input-medium" type="text">
                                                                </div>
                                    
                                                                <div class="control-group control-inline">
                                                                    <label for="surname">名</label>
                                                                    <input name="surname" class="input-medium" type="text">
                                                                </div>
                                                                -->
                                <!-- username -->
                                <label>用户名</label>
                                <input class="input-huge" name="username" type="text">
                                <!-- email -->
                                <label>E-mail（邮箱）</label>
                                <input class="input-huge" name="email" type="text">
                                <!-- password -->
                                <label>密码</label>
                                <input class="input-huge" name="password" type="password">
                                <!-- question -->
                                <label>验证问题</label>
                                <select name="question" style="width:332px;text-align:center">
                                    <option value="小学老师名字">小学老师名字</option>
                                    <option value="父亲名字">父亲名字</option>
                                    <option value="母亲名字">母亲名字</option>
                                    <option value="媳妇名字">媳妇名字</option>
                                </select>
                                <!-- answer -->
                                <label>答案</label>
                                <input class="input-huge" name="answer" type="text">
                                <!-- restrurant -->
                                <label>餐馆名</label>
                                <input class="input-huge" name="restaurantname" type="text">
                                <!-- address -->
                                <label>地址</label>
                                <input class="input-huge" name="address" type="text">
                                <!-- discription -->
                                <label>餐厅描述</label>
                                <input class="input-huge" name="description" type="text">
                                <!-- type -->
                                <label>餐厅类型</label>
                                <select name="type" style="width:332px">
                                    <option value="鸡公煲">鸡公煲</option>
                                    <option value="火锅">火锅</option>
                                    <option value="海鲜馆">海鲜馆</option>
                                    <option value="烧烤">烧烤</option>
                                </select>
                                <label>电话号码</label>
                                <input class="input-huge" name="phone" type="text">
                                <div class="alert alert-block alert-success">
                                                   图片最大允许上传500K,支持jpg、png、jpeg格式的图片,为了达到最佳效果，建议上传360*200的图片
                                </div>
                                <div style="">
                                    <input type="file" class="btn-success btn" name="pic">上传图片</input>
                                </div>
                            </div>
       		        </br>
                            <div class="footer">
                                <label class="checkbox inline">
                                    <input type="checkbox" id="inlineCheckbox1" value="option1"> I agree to something I will never read
                                </label>
                                <button type="submit" class="btn btn-success">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <footer class="white navbar-fixed-bottom">
     Alread have an account? <a href="/orderonline/index.php/WebPage/login" class="btn btn-black">Sign in</a>
        </footer>

                    <!-- Le javascript
                ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="/orderonline/public/login/jquery.js"></script>
        <script src="/orderonline/public/login/bootstrap.js"></script>
        <script src="/orderonline/public/login/backstretch.min.js"></script>
        <script src="/orderonline/public/login/typica-login.js"></script>

        <div class="backstretch" style="left: 0px; top: 0px; overflow: hidden; margin: 0px; padding: 0px; height: 919px; width: 1920px; z-index: -999999; position: fixed;"><img src="/orderonline/public/login/bg1.png" style="position: absolute; margin: 0px; padding: 0px; border: none; width: 1920px; height: 1079.4729136163983px; max-width: none; z-index: -999999; left: 0px; top: -80.23645680819914px;"></div>
        <embed id="embed_npwlo" type="application/npwlo" height="0">
    </body>
</html>