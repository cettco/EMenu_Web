<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <?php include ('head.php'); ?>
    <?php
        session_start();
        if(!isset($_SESSION['accountid']))
        {
            echo "<script>window.location.href='/orderonline/index.php/WebPage/login'</script>";    
        }
    ?>

    <body>
        <?php
            include ('navbar.php');
        ?>

        <div class="main-container" id="main-container">
            <script type="text/javascript">
                try{ace.settings.check('main-container' , 'fixed')}catch(e){}
            </script>

            <div class="main-container-inner">
                <a class="menu-toggler" id="menu-toggler" href="#">
                    <span class="menu-text"></span>
                </a>

                <?php
                    include ('sidebar.php');
                ?>

                <div class="main-content">
                    <div class="breadcrumbs" id="breadcrumbs">
                        <script type="text/javascript">
                            try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
                        </script>

                        <ul class="breadcrumb">
                            <li><i class="icon-gear gear-icon"></i><a href="/orderonline/public/config/account.html">设置</a></li>
                            <li class="active">修改密码</li>
                        </ul><!-- .breadcrumb -->
                    </div>

                    <div class="page-content">

                        <div class="form">
                            <form class="well" id="account-form" action="/orderonline/index.php/SystemManage/ChangePwd?accountid=<?php echo $accountid;?>" method="post">
                                <p class="note">标有<span class="required" style="color:red;">*</span>的为必填选项</p>
                                <div class="alert alert-danger" id="account-form_es_" style="display:none"><p>请更正下列输入错误:</p>
                                    <ul>
                                        <li>dummy</li>
                                    </ul>
                                </div>		<br />
                                <div>
                                <label>当前密码 <span style="color:red;">*</span></label><br />
                                <input class="span3" name="oldpwd" id="ChangePasswordForm_oldpassword" type="password" /><br />
                                <label>新密码 <span style="color:red;">*</span></label><br />
                                <input class="span3" name="newpwd" id="ChangePasswordForm_newpassword1" type="password" /><br />
                                <label>确认密码<span style="color:red;">*</span></label><br />
                                <input class="span3" name="confirmpwd" id="ChangePasswordForm_newpassword2" type="password" /><br />
                                </div>
                                <div class="form-actions">
                                    <button class="btn btn-info" type="submit">
                                        <i class="icon-ok bigger-110"></i>
					保存
                                    </button>
                                </div>

                            </form>
                        </div>

                        <div id="orderAlert" style="position: fixed;z-index:999999;bottom:5px;right:5px;background:#e5e5e5;display: none;">
                            <div style="text-align: center;margin-top: 10px;font-size: 20px;color: red;"><b>新订单来啦!</b>
                                <a class="oaright" href="javascript:closeoa()">[关闭]</a></div>
                            <div style="margin: 20px 30px 5px 30px;cursor: pointer;" onclick="tourl()">您好：有<span class="label label-info" id="oanum"></span>笔新订单来了！</div>
                            <div style="margin: 5px 30px 5px 30px;cursor: pointer;" onclick="tourl()">截止目前，一共有<span class="label label-info" id="oatnum"></span>笔订单未处理</div>
                            <div class="oaright" style="bottom: 10px;margin: 5px 30px 5px 30px;">时间：<a id="oatime" style="text-decoration: none;"></a></div>
                        </div>
                        <div style="position: fixed;top: -9999px;right: -9999px;display:none;" id="soundsw">
                        </div>
                    </div><!-- /.page-content -->
                </div><!-- /.main-content -->
            </div><!-- /.main-container-inner -->
            <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                <i class="icon-double-angle-up icon-only bigger-110"></i>
            </a>
        </div><!-- /.main-container -->
        <?php include ('basicscripts.php'); ?>
    </body>
</html>