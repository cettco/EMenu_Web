<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

    <?php include ('head.php'); ?>
    <?php
        session_start(); if(!isset($_SESSION[ 'accountid'])) { echo
           "<script>window.location.href='/orderonline/index.php/WebPage/login'</script>"; }
    ?>
    <script type="text/javascript">
    $(document).ready(function(){
        var url= "/orderonline/index.php/RestaurantManage/UnservedItem";
        $("#content").empty();
        $.get(url,function(data){
        $("#content").append(data);
        });
    });
    </script>
    <body>
        <?php include ( 'navbar.php'); ?>
        <div class="main-container" id="main-container">
            <script type="text/javascript">
                try {
                    ace.settings.check('main-container', 'fixed')
                } catch(e) {}
            </script>
            <div class="main-container-inner">
                <a class="menu-toggler" id="menu-toggler" href="#">
                    <span class="menu-text">
                    </span>
                </a>
                <?php include ( 'sidebar.php'); ?>
                <div class="main-content">
                    <div class="breadcrumbs" id="breadcrumbs">
                        <script type="text/javascript">
                            try {
                                ace.settings.check('breadcrumbs', 'fixed')
                            } catch(e) {}
                        </script>
                        <ul class="breadcrumb">
                            <li>
                                <i class="menu-text">
                                </i>
                                                订单
                            </li>
                            <li class="active">
                                            已点订单
                            </li>
                        </ul>
                        <!-- .breadcrumb -->
                    </div>
                    <div class="page-content">
                        <script src="/orderonline/public/js/socket.io.js"></script>

                        <script>
                                                var  socket = io.connect('http://m.tzwm.me:8000');
                                                socket.on('connection', function(data) {
                                                    var restaurantid = "";
                                                    restaurantid = <?php echo $_SESSION['restaurantid'] ;?>;
                                                    if(restaurantid==data.restaurantid)
                                                    {
                                                        var url= "/orderonline/index.php/RestaurantManage/UnservedItem";
                                                        $("#content").empty();
                                                        $.get(url,function(data){
                                                            $("#content").append(data);
                                                        });
                                                        
                                                        
                                                    }                                            
                                                    else{
                                alert('not');
                            }
                                                });    
                        </script>
                        <div class="row">
                            <div class="col-sm-8">
                                <div id="yw0" class="grid-view">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th id="yw0_c0">
                                                                    菜名
                                            </th>
                                            <th id="yw0_c1">
                                                                    数量
                                            </th>
                                            <th class="button-column" id="yw0_c2">
                                                                操作
                                            </th>
                                        </tr>
                                                    </thead>
                                        <tbody id="content">

                                        </tbody>
                                    </table>
                                    <div class="keys" style="display:none" title="/orderonline/public/shoptype/index.html">
                                        <span>
                                                        7766
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="orderAlert" style="position: fixed;z-index:999999;bottom:5px;right:5px;background:#e5e5e5;display: none;">
                            <div style="text-align: center;margin-top: 10px;font-size: 20px;color: red;">
                                <b>
                                                新订单来啦!
                                </b>
                                <a class="oaright" href="javascript:closeoa()">
                                                [关闭]
                                </a>
                            </div>
                            <div style="margin: 20px 30px 5px 30px;cursor: pointer;" onclick="tourl()">
                                            您好：有
                                <span class="label label-info" id="oanum">
                                </span>
                                            笔新订单来了！
                            </div>
                            <div style="margin: 5px 30px 5px 30px;cursor: pointer;" onclick="tourl()">
                                            截止目前，一共有
                                <span class="label label-info" id="oatnum">
                                </span>
                                            笔订单未处理
                            </div>
                            <div class="oaright" style="bottom: 10px;margin: 5px 30px 5px 30px;">
                                            时间：
                                <a id="oatime" style="text-decoration: none;">
                                </a>
                            </div>
                        </div>
                        <div style="position: fixed;top: -9999px;right: -9999px;display:none;" id="soundsw">
                        </div>
                    </div>
                    <!-- /.page-content -->
                </div>
                <!-- /.main-content -->
            </div>
            <!-- /.main-container-inner -->
            <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                <i class="icon-double-angle-up icon-only bigger-110">
                </i>
            </a>
        </div>
        <!-- /.main-container -->
        <?php include ('basicscripts.php'); ?>
        <script type="text/javascript" src="/orderonline/public/assets/2514499d/gridview/jquery.yiigridview.js">
        </script>
        <script type="text/javascript">
            /*<![CDATA[*/
            /*]]>*/
            
        </script>
    </body>

</html>
