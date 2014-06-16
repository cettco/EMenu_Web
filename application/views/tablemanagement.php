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
                            <li><i class="icon-desktop desktop-icon"></i><a href="/orderonline/public/shop/index.html">店铺</a></li>
                            <li class="active">店铺分类</li>
                        </ul><!-- .breadcrumb -->
                    </div>

                    <div class="page-content">

                        <script type="text/javascript">
                            function CreateNewShoptype()
                            {
                                window.location.href = '/orderonline/index.php/WebPage/tablecreate';
                            }
                        </script>

                        <div class="row">
                            <div class="col-sm-8">
                                <button class="btn btn-sm btn-success" onclick="CreateNewShoptype()">新建餐桌</button>

                                <div id="yw0" class="grid-view">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th id="yw0_c0"><a class="sort-link">餐桌编号</a></th>
                                            <th id="yw0_c1"><a class="sort-link asc">二维码数据</a></th>
                                            <th class="button-column" id="yw0_c2">操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <?php
                                            $restaurantid = $_SESSION['restaurantid'];
                                            $tablearr = $this->Management_Model->select_specialrow('restaurant_id',$restaurantid,'table');
                                            if(count($tablearr->result()))
                                            {
                                                for($i=0;$i<count($tablearr->result());$i++)
                                                {
                                                    echo "<tr>";
                                                    $tableid = $tablearr->result()[$i]->table_id;
                                                    $qrcodearr = $this->Management_Model->select_specialrow('table_id',$tableid,'qrcode');
                                                    $qrcodedata = $qrcodearr->result()[0]->qrcode_data;
                                                    $qrcodeid = $qrcodearr->result()[0]->qrcode_id;
                                                    echo "<td>".$tablearr->result()[$i]->table_no."</td>";
                                                    echo "<td width='150'>".$qrcodedata."</td>";
                                                    echo "<td width='100' class='center'><a title='修改' class='green' style='padding-right:8px;' 
                                                    href='/orderonline/index.php/WebPage/tableedit?tableid=".$tableid."'><i class='icon-pencil bigger-130'></i>
                                                    </a><a title='删除' class='red' style='padding-right:8px;' href='/orderonline/index.php/RestaurantManage/DeleteSeat?tableid=".$tableid."&qrcodeid=".$qrcodeid."'>
                                                    <i class='icon-trash bigger-130'></i></a></td></tr>";
                                                }
                                            }
                                            ?>
                                            </tr>
                                        </tbody>
                                    </table><div class="summary">第 1-1 条, 共<?php echo count($tablearr->result())?>条.</div><div class="keys" style="display:none" title="/orderonline/public/shoptype/index.html"><span>7766</span></div>
                                </div>
                            </div>
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
        <script type="text/javascript" src="/orderonline/public/assets/2514499d/gridview/jquery.yiigridview.js"></script>
        <script type="text/javascript">
            /*<![CDATA[*/
            /*]]>*/
        </script>
    </body>
</html>