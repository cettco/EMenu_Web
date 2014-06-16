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
                                <i class="icon-desktop desktop-icon">
                                </i>
                                <a href="/orderonline/index.php/WebPage/mainpage">
                                    首页
                                </a>
                            </li>
                            <li class="active">
                                餐桌菜单
                            </li>
                        </ul>
                        <!-- .breadcrumb -->
                    </div>
                    <div class="page-content">
                        <script type="text/javascript">
                            function CreateNewShoptype() {
                                window.location.href = '/shoptype/create.html';
                            }
                        </script>
                        <div cleaa="row">
                            <?php
                                $tableid = $_GET['tableid'];
                                $tablearr = $this->Management_Model->select_row($tableid,'table');
                                
                                $orderid = $tablearr->result()[0]->order_id;
                                $_SESSION['orderid'] = $orderid;
                                $orderarr = $this->Management_Model->select_row($orderid,'order');
                                if(count($orderarr->result()))
                                {
                                    echo "<table class='table table-striped table-bordered table-hover'>
                                    <thead><tr><th>订单号</th>
                                        <th>订单状态</th>
                                        <th>总价</th>
                                        <th>上次操作时间</th>
                                        <th>催单</th></tr>
                                    </thead><tbody>";
                                    echo "<tr class='odd'>";
                                    echo "<td>".$orderarr->result()[0]->order_id."</td>";
                                    echo "<td>".$orderarr->result()[0]->order_status."</td>";
                                    echo "<td>".$orderarr->result()[0]->bill."</td>";
                                    echo "<td>".$orderarr->result()[0]->last_updated."</td>";
                                    $hurryarr = $this->Management_Model->select_hurry($orderid);
                                    if(count($hurryarr->result()))
                                    {
                                        echo "<td style='vertical-align:middle; text-align:center;''><span class='STYLE1'>
                                        [</span><a href='/orderonline/index.php/WebPage/reminder'>查看(".count($hurryarr->result()).")</a><span class='STYLE1'>]</span></td></tr></tbody></table>";
                                    }
                                    else
                                    {
                                        echo "<td style='vertical-align:middle; text-align:center;''><span class='STYLE1'>
                                    [</span><a href='/orderonline/index.php/WebPage/reminder'>查看</a><span class='STYLE1'>]</span></td></tr></tbody></table>";
                                    }
                                }
                                else
                                {
                                    echo "当前没有订单";
                                }
                            ?>

                        </div>
                        <div class="row">
                        <div class="col-sm-10">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th id="yw0_c0">
                                                菜名
                                    </th>
                                    <th id="yw0_c1">
                                                数量
                                    </th>
                                    <th id="yw0_c2">
                                                价格
                                    </th>
                                    <th id="yw0_c3">
                                                状态
                                    <th class="button-column" id="yw0_c3">
                                            操作
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $tableid = $_GET['tableid'];
                                        $tablearr = $this->Management_Model->select_row($tableid,'table');
                                        $orderid = $tablearr->result()[0]->order_id;
                                        $orderitemarr = $this->Management_Model->select_specialrow('order_id',$orderid,'orderitem');
                                        for($i=0;$i<count($orderitemarr->result());$i++)
                                        {
                                            $itemid = $orderitemarr->result()[$i]->item_id;
                                            $itemarr = $this->Management_Model->select_row($itemid,'item');
                                            $price = $itemarr->result()[0]->price;
                                            $quantity = $orderitemarr->result()[$i]->quantity;
                                            $totalprice = $price*$quantity;
                                            $orderitemid = $orderitemarr->result()[$i]->orderitem_id;
                                            echo "<tr class='odd'>";
                                            echo "<td>".$itemarr->result()[0]->name."</td>";
                                            echo "<td>".$quantity."</td>";
                                            echo "<td>".$totalprice."</td>";
                                            echo "<td>".$orderitemarr->result()[$i]->item_status."</td>";
                                            if($orderitemarr->result()[$i]->item_status=="cooking")
                                            {
                                                echo "<td width='100' class='center'><a title='完成' class='green' style='padding-right:8px;'
                                                 href='/orderonline/index.php/RestaurantOrder/ServedItem?orderitemid=".$orderitemid."'><i class='icon-pencil bigger-130'></i>
                                                </a>";
                                            }
                                            else
                                            {
                                                echo "<td></td></tr>";
                                            }
                                            // echo "<a title='删除'' class='red' style='padding-right:8px;'' href='/orderonline/public/shoptype/delete/7766.html'>
                                            // <i class='icon-trash bigger-130'></i></a></td></tr>";
                                        }
                                    ?>
                                                                            <!-- <tr class="odd">
                                                                                <td>
                                                                                    hhh
                                                                                </td>
                                                                                <td width="150">
                                                                                    0
                                                                                </td>
                                                                                <td>
                                                                                    100
                                                                                </td>
                                                                                <td>
                                                                                    dd
                                                                                </td>
                                                                                <td width="100" class="center">
                                                                                    <a title="修改" class="green" style="padding-right:8px;" href="/orderonline/public/shoptype/update/7766.html">
                                                                                        <i class="icon-pencil bigger-130">
                                                                                        </i>
                                                                                    </a>
                                                                                    <a title="删除" class="red" style="padding-right:8px;" href="/orderonline/public/shoptype/delete/7766.html">
                                                                                        <i class="icon-trash bigger-130">
                                                                                        </i>
                                                                                    </a>
                                                                                </td>
                                                                            </tr>
                                        
                                                                            <tr class="odd">
                                                                                <td>
                                                                                    总价
                                                                                </td>
                                                                                <td width="150">
                                        
                                                                                </td>
                                                                                <td>
                                                                                    100
                                                                                </td>
                                                                                <td>
                                                                                    dd
                                                                                </td>
                                                                                <td width="100" class="center">
                                        
                                                                                </td>
                                                                            </tr> -->
                                </tbody>
                            </table>
                            <div class="summary">
                                共
                                <?php
                                    echo count($orderitemarr->result());
                                ?> 条.
                            </div>
                            <form action="/orderonline/index.php/RestaurantOrder/ConfirmOrder" method="post">
                                <div class="col-md-offset-3 col-md-9">
                                                                            <!-- <button class="btn btn-info" type="submit">
                                                                                                <i class="icon-ok bigger-110">
                                                                                                </i> -->
                                    <?php
                                        if(count($orderarr->result()))
                                        {
                                            if($orderarr->result()[0]->order_status=="ordering")
                                            {
                                                echo "<button class='btn btn-info' type='submit' disabled>
                                            <i class='icon-ok bigger-110'></i>";
                                                echo "正在点单";
                                                echo "</button>";
                                            }
                                            if($orderarr->result()[0]->order_status=="pending")
                                            {
                                                echo "<button class='btn btn-info' type='submit'>
                                            <i class='icon-ok bigger-110'></i>";
                                                echo "确认订单";
                                                echo "</button>";
                                            }
                                            if($orderarr->result()[0]->order_status=="confirmed")
                                            {
                                                echo "<button class='btn btn-info' type='submit'>
                                            <i class='icon-ok bigger-110'></i>";
                                                echo "完成订单";
                                                echo "</button>";
                                            }
                                            if($orderarr->result()[0]->order_status=="finished")
                                            {
                                                echo "<button class='btn btn-info' type='submit'>
                                            <i class='icon-ok bigger-110'></i>";
                                                echo "空出座位";
                                                echo "</button>";
                                            }
                                        }
                                    ?>


                                </div>

                                <div class="keys" style="display:none" title="/orderonline/public/shoptype/index.html">
                                    <span>
                                    7766
                                    </span>
                                </div>
                            </form>
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