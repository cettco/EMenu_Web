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
                            <i class="icon-home home-icon">
                            </i>
                            <li class="active">
                                首页
                            </li>
                        </ul>
                        <!-- .breadcrumb -->
                    </div>
                    <div class="page-content">
                        <div class="span10 content borBox" style="height: 417px; display: block;">
                            <div class="page-header">
                                <h1 class="hBig">
                                    <?php
                                        echo $restaurantname;
                                    ?>
                                    <small>
                                        餐桌管理
                                    </small>
                                </h1>
                            </div>
                            <?php
                                $tablearr = $this->Management_Model->select_specialrow('restaurant_id',$restaurantid,'table');
                                if(count($tablearr->result())>=4)
                                { 
                                    $len = count($tablearr->result())-count($tablearr->result())%4;
                                    for($i=0;$i<$len;$i++)
                                    {
                                
                                        if($i%4==0)
                                        {
                                            echo "<div class='row-fluid boxMenu'>";
                                            echo "<div class='span3 box' data-target='jobs'>";
                                            echo "<a href='/orderonline/index.php/WebPage/tableorder?tableid=".$tablearr->result()[$i]->table_id."'>";
                                            echo "<div class='box_click'><h1>".$tablearr->result()[$i]->table_no."</br>状态：".$tablearr->result()[$i]->table_status."</h1></div></a></div>";
                                        }
                                        if($i%4==3)
                                        {
                                            echo "<div class='span3 box' data-target='jobs'>";
                                            echo "<a href='/orderonline/index.php/WebPage/tableorder?tableid=".$tablearr->result()[$i]->table_id."'>";
                                            echo "<div class='box_click'><h1>".$tablearr->result()[$i]->table_no."</br>状态：".$tablearr->result()[$i]->table_status."</h1></div></a></div>";
                                            echo "</div><hr>";
                                        }
                                        if($i%4==1)
                                        {
                                            echo "<div class='span3 box'>";
                                            echo "<a href='/orderonline/index.php/WebPage/tableorder?tableid=".$tablearr->result()[$i]->table_id."'>";
                                            echo "<div class='box_click'><h1>".$tablearr->result()[$i]->table_no."</br>状态：".$tablearr->result()[$i]->table_status."</h1></div></a></div>";
                                        }
                                        if($i%4==2)
                                        {
                                            echo "<div class='span3 box'>";
                                            echo "<a href='/orderonline/index.php/WebPage/tableorder?tableid=".$tablearr->result()[$i]->table_id."'>";
                                            echo "<div class='box_click'><h1>".$tablearr->result()[$i]->table_no."</br>状态：".$tablearr->result()[$i]->table_status."</h1></div></a></div>";
                                        }
                                    }
                                    echo "<div class='row-fluid boxMenu'>";
                                    for($i=0;$i<count($tablearr->result())%4;$i++)
                                    {
                                        echo "<div class='span3 box'>";
                                        echo "<a href='/orderonline/index.php/WebPage/tableorder?tableid=".$tablearr->result()[$i+$len]->table_id."'>";
                                        echo "<div class='box_click'><h1>".$tablearr->result()[$i+$len]->table_no."</br>状态：".$tablearr->result()[$i+$len]->table_status."</h1></div></a></div>";
                                    }
                                    echo "</div><hr>";
                                }
                                if(count($tablearr->result()) && count($tablearr->result())<4)
                                {
                                    echo "<div class='row-fluid boxMenu'>";
                                    for($i=0;$i<count($tablearr->result());$i++)
                                    {
                                        echo "<div class='span3 box'>";
                                        echo "<a href='/orderonline/index.php/WebPage/tableorder?tableid=".$tablearr->result()[$i]->table_id."'>";
                                        echo "<div class='box_click'><h1>".$tablearr->result()[$i]->table_no."</br>状态：".$tablearr->result()[$i]->table_status."</h1></div></a></div>";
                                    }
                                    echo "</div><hr>";
                                    //echo "aa";
                                }
                                
                                echo "<div class='row-fluid boxMenu'>";
                                echo "<a href='/orderonline/index.php/WebPage/tablecreate'>";
                                echo "<div class='span3 box'><h1>添加餐桌</h1></div></a></div>";
                                echo "</div><hr>";
                                
                            ?>
                                                            <!-- <div class="row-fluid boxMenu">
                                
                                                                <div class="span3 box" data-target="journals">
                                                                    <a href="aaa">
                                                                    <div class="box_click">
                                                                        <h1>
                                                                        5
                                                                        </h1>
                                                                    </div>
                                                                    </a>
                                                                </div>
                                                                <div class="span3 box">
                                                                    <a href="aa">
                                                                    <h1>
                                                                        6
                                                                    </h1>
                                                                    </a>
                                                                </div>
                                                                <div class="span3 box">
                                                                    <h1>
                                                                        7
                                                                    </h1>
                                                                </div>
                                                            </div>
                                                            <hr> -->
                                                            <!-- <div class="row-fluid boxMenu">
                                                                <div class="span3 box">
                                                                    <h1>
                                                                        8
                                                                    </h1>
                                                                </div>
                                                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <script src="/orderonline/public/js/suggest.js">
        </script>
        <script src="/orderonline/public/public/fck/editor/kindeditor.js">
        </script>
        <script>
            KindEditor.ready(function(K) {
                editor = K.create('textarea[name="content"]', {
                    width: '100%',
                    resizeType: 1,
                    allowPreviewEmoticons: false,
                    allowImageUpload: true,
                    filterMode: true,
                    items: ['fontname', 'fontsize', '|', 'bold', 'italic', 'underline', 'removeformat', '|', 'insertorderedlist', 'insertunorderedlist', '|', 'emoticons']
                });
            });
        </script>
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
            jQuery(function($) {
                jQuery('#suggest_area').yiiGridView({
                    'ajaxUpdate': ['suggest_area'],
                    'ajaxVar': 'ajax',
                    'pagerClass': 'pager',
                    'loadingClass': 'grid-view-loading',
                    'filterClass': 'filters',
                    'tableClass': 'table table-striped table-bordered table-hover',
                    'selectableRows': 1,
                    'enableHistory': false,
                    'updateSelector': '{page}, {sort}',
                    'filterSelector': '{filter}',
                    'pageVar': 'Suggest_page',
                    'afterAjaxUpdate': afterSearch
                });
            });
            /*]]>*/
            
        </script>
    </body>

</html>