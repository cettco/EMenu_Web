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
                try {
                    ace.settings.check('main-container', 'fixed')
                } catch(e) {}
            </script>
            <div class="main-container-inner">
                <a class="menu-toggler" id="menu-toggler" href="#">
                    <span class="menu-text">
                    </span>
                </a>
                <?php
                    include ('sidebar.php');
                ?>
                <div class="main-content">
                    <div class="breadcrumbs" id="breadcrumbs">
                        <script type="text/javascript">
                            try {
                                ace.settings.check('breadcrumbs', 'fixed')
                            } catch(e) {}
                        </script>
                        <ul class="breadcrumb">
                            <li>
                                <i class="icon-shopping-cart">
                                </i>
                                    餐桌
                            </li>
                            <li class="active">
                                催单
                            </li>
                        </ul>
                        <!-- .breadcrumb -->
                    </div>
                    <div class="page-content">
                        <div class="row">
                            <div class="col-sm-8">
                                <div id="yw0" class="grid-view">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th id="yw0_c0">
                                                id
                                    </th>
                                    <th id="yw0_c1">
                                                时间
                                    </th>
                                    <th id="yw0_c3">
                                                状态
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $orderid = $_SESSION['orderid'];
                                        $hurryarr = $this->Management_Model->select_specialrow('order_id',$orderid,'hurry');
                                        for($i=0;$i<count($hurryarr->result());$i++)
                                        {
                                        
                                            echo "<tr class='odd'>";
                                            echo "<td>".$hurryarr->result()[0]->hurry_id."</td>";
                                            echo "<td>".$hurryarr->result()[0]->time."</td>";
                                            if($hurryarr->result()[0]->newhurry==0)
                                            {
                                                echo "<td>new</td></tr>";
                                                $hurry = array(
                                                    'newhurry'=>1
                                                );
                                                $this->Management_Model->update_row($hurryarr->result()[0]->hurry_id,$hurry,'hurry');
                                            }
                                            else
                                            {
                                                echo "<td>old</td>";
                                            }
                                        
                                        }
                                    ?>
                                </tbody>
                            </table>
                            </div>
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
    </body>

</html>