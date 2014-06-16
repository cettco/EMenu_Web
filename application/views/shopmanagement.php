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
                            <li><a href="/orderonline/public/shoptype/index.html">店铺</a></li>
                            <li class="active">管理</li>
                        </ul><!-- .breadcrumb -->
                    </div>

                    <div class="page-content">

                        <script type="text/javascript">
                            $(function($) {	
                                $('[data-rel="tooltip"]').tooltip();
                                $('[data-rel="popover"]').popover();
                            })
                        </script>
                        <div class="row">
                            <div class="col-sm-10">
                                <form enctype="multipart/form-data" class="form-horizontal" id="shoptype-form" action="/orderonline/index.php/RestaurantManage/ShopEdit" method="post">
                                    <div class="alert alert-danger" id="shoptype-form_es_" style="display:none"><p>请更正下列输入错误:</p>
                                        <ul>
                                            <li>dummy</li>
                                        </ul></div>
                                    <input name="oldAdminId" value="8011" type="hidden">
                                    <?php
                                    $accountid = $_SESSION['accountid'];
                                    $accountarr = $this->Management_Model->select_row($accountid,'account');
                                    $restaurantid = $accountarr->result()[0]->restaurant_id;
                                    $restaurantarr = $this->Management_Model->select_row($restaurantid,'restaurant');
                                    $name = $restaurantarr->result()[0]->name;
                                    $address = $restaurantarr->result()[0]->address;
                                    $description = $restaurantarr->result()[0]->description;
                                    $type = $restaurantarr->result()[0]->type;
                                    $phone = $restaurantarr->result()[0]->phone;
                                    $picturearr = $this->Management_Model->select_specialrow('restaurant_id',$restaurantid,'picture');
                                    $picturename = $picturearr->result()[0]->name; 
                                    ?>
                                    <div id="basicinfo" class="tab-pane active">
                                        <div class="form-group">
                                            <label class="col-sm-1">
                                                <label for="Config_tag">
                                                            餐厅名
                                                </label>
                                            </label>
                                            <input class="col-sm-4" value="<?php echo $name;?>" name="restaurantname" id="name" type="text" readonly />
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-1">
                                                <label for="Config_shopaddress">
                                                            地址
                                                </label>
                                            </label>
                                            <input class="col-sm-4" value="<?php echo $address;?>" name="address" id="address" type="text" />
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-1">
                                                <label for="Config_shopaddress">
                                                            描述
                                                </label>
                                            </label>
                                            <textarea class="col-sm-3" rows="5" name="description" id="description"><?php echo $description;?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-1">
                                                <label>餐厅类型</label>
                                            </label>
                                            <select name="type" style="width:332px">
                                        <option value="鸡公煲">鸡公煲</option>
                                        <option value="火锅">火锅</option>
                                        <option value="海鲜馆">海鲜馆</option>
                                        <option value="烧烤">烧烤</option>
                                        </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-1">
                                                <label for="price">
                                                            电话
                                                </label>
                                            </label>
                                            <input class="col-sm-2" value="<?php echo $phone;?>" name="phone" id="phone" type="text" />
                                        </div>
                                        <div class="alert alert-block alert-success">
                                                    图片最大允许上传500K,支持jpg、png、jpeg格式的图片,为了达到最佳效果，建议上传360*200的图片
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-1">
                                            <label for="price">
                                                            图片
                                            </label>
                                        </label>
                                        <input class="col-sm-3" value="<?php echo $picturename;?>" name="picture" id="picture" type="text" readonly />
                                    </div>
                                    <div style="">
                                        <input type="file" class="btn-success btn" name="pic">上传图片</input>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-info" type="submit">
                                            <i class="icon-ok bigger-110"></i>
                                                        保存
                                        </button>
                                    </div>
                                    </div>

                                    
                                                                            <!-- <div class="clearfix form-actions">
                                                        <div class="col-md-offset-3 col-md-9">
                                                            <button class="btn btn-info" type="submit">
                                                                <i class="icon-ok bigger-110"></i>
                                                                保存
                                                            </button>
                                                        </div>
                                                    </div> -->
                                </form>
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