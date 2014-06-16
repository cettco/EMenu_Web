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
                            function CreateNewType()
                            {
                                window.location.href = '/orderonline/index.php/WebPage/categorynew';
                            }
                            function CreateNewItem()
                            {
                                window.location.href = '/orderonline/index.php/WebPage/menuitemnew';
                            }
                        </script>

                        <div class="row">
                            <div class="col-sm-4">
                                <button class="btn btn-sm btn-success" onclick="CreateNewType()">新建分类</button>

                                <div id="yw0" class="grid-view">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th id="yw0_c0">菜品类名</th>
                                            <th id="yw0_c1">描述</th>
                                            <th class="button-column" id="yw0_c2">操作</th>
                                        </tr>
</thead>
                                        <tbody>
                                        
                                        <?php
                                            $restaurantid = $_SESSION['restaurantid'];
                                            $menuarr = $this->Management_Model->select_specialrow('restaurant_id',$restaurantid,'menu');
                                            $menuid = $menuarr->result()[0]->menu_id;
                                            $categoryarr = $this->Management_Model->select_specialrow('menu_id',$menuid,'category');
                                            if(count($categoryarr->result()))
                                            {
                                                for($i=0;$i<count($categoryarr->result());$i++)
                                                {
                                                    $categoryid = $categoryarr->result()[$i]->category_id;
                                                    $name = $categoryarr->result()[$i]->name;
                                                    $description = $categoryarr->result()[$i]->description;
                                                    echo "<tr class='odd'><td><a href='/orderonline/index.php/WebPage/menu?categoryid=".$categoryid."'>".$name."</a></td>";
                                                    echo "<td width='150'><a href='/orderonline/index.php/WebPage/menu?categoryid=".$categoryid."'>".$description."</a></td>";
                                                    echo "<td width='100' class='center'><a title='修改' class='green' style='padding-right:8px;' 
                                                    href='/orderonline/index.php/WebPage/categoryedit?categoryid=".$categoryid."'><i class='icon-pencil bigger-130'></i>
                                                    </a><a title='删除' class='red' style='padding-right:8px;' href='/orderonline/index.php/RestaurantManage/DeleteMenuType?categoryid=".$categoryid."'>
                                                    <i class='icon-trash bigger-130'></i></a></td></tr>";
                                                }
                                            }
                                            ?>
                                            <!-- <td>hhh</td>
                                            <td width="150">0</td>
                                            <td width="100" class="center"><a title="修改" class="green" style="padding-right:8px;" href="/orderonline/public/shoptype/update/7766.html"><i class="icon-pencil bigger-130"></i></a><a title="删除" class="red" style="padding-right:8px;" href="/orderonline/public/shoptype/delete/7766.html"><i class="icon-trash bigger-130"></i></a></td> -->
</tbody>
                                    </table><div class="summary">第 1-1 条, 共<?php echo count($categoryarr->result());?>条.</div><div class="keys" style="display:none" title="/orderonline/public/shoptype/index.html"><span>7766</span></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <button class="btn btn-sm btn-success" onclick="CreateNewItem()">新建菜品</button>

                                <div id="yw0" class="grid-view">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                <tr>
                                    <th id="yw0_c0">
                                                菜名
                                    </th>
                                    <th id="yw0_c1">
                                                描述
                                    </th>
                                    <th id="yw0_c2">
                                                单位
                                    </th>
                                    <th id="yw0_c3">
                                                单价
                                    <th class="button-column" id="yw0_c3">
                                            操作
                                    </th>
                                </tr>
                                </thead>
                                        <tbody>
                                        <!-- <tr class="odd">
                                            <td>hhh</td>
                                            <td width="150">0</td>
                                            <td width="100" class="center"><a title="修改" class="green" style="padding-right:8px;" href="/orderonline/public/shoptype/update/7766.html"><i class="icon-pencil bigger-130"></i></a><a title="删除" class="red" style="padding-right:8px;" href="/orderonline/public/shoptype/delete/7766.html"><i class="icon-trash bigger-130"></i></a></td>
                                        </tr> -->
                                        <?php
                                        $num = 0;
                                        if(isset($_GET['categoryid']))
                                        {
                                            $categoryid = $_GET['categoryid'];
                                            $itemarr = $this->Management_Model->select_specialrow('category_id',$categoryid,'item');
                                            for($i=0;$i<count($itemarr->result());$i++)
                                            {
                                                $itemid = $itemarr->result()[$i]->item_id;
                                                $name = $itemarr->result()[$i]->name;
                                                $description = $itemarr->result()[$i]->description;
                                                $unit = $itemarr->result()[$i]->unit;
                                                $price = $itemarr->result()[$i]->price;
                                                echo "<tr class='odd'>";
                                                echo "<td>".$name."</td>";
                                                echo "<td>".$description."</td>";
                                                echo "<td>".$unit."</td>";
                                                echo "<td>".$price."</td>";
                                                echo "<td width='100' class='center'><a title='修改' class='green' style='padding-right:8px;' 
                                                href='/orderonline/index.php/WebPage/menuitemedit?itemid=".$itemid."'><i class='icon-pencil bigger-130'></i>
                                                </a><a title='删除' class='red' style='padding-right:8px;' href='/orderonline/index.php/RestaurantManage/DeleteMenuItem?itemid=".$itemid."'>
                                                <i class='icon-trash bigger-130'></i></a></td></tr>";
                                                $num = $num+1;
                                                // echo "<a title='删除'' class='red' style='padding-right:8px;'' href='/orderonline/public/shoptype/delete/7766.html'>
                                                // <i class='icon-trash bigger-130'></i></a></td></tr>";
                                            }
                                        }
                                        
                                    ?>
</tbody>
                                    </table><div class="summary">第 1-1 条, 共<?php echo $num;?>条.</div><div class="keys" style="display:none" title="/orderonline/public/shoptype/index.html"><span>7766</span></div>
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
    </body>
</html>