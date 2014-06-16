<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="/js/flot/excanvas.min.js"></script><![endif]-->

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
                            <li><i class="icon-bar-chart"></i>统计</li>
                        </ul><!-- .breadcrumb -->
                    </div>


                    <div class="page-content" width="100%">
                        <script type="text/javascript">

                        function SetCwinHeight(obj)
                        {
                          var cwin=obj;
                          if (document.getElementById)
                          {
                            if (cwin && !window.opera)
                            {
                              if (cwin.contentDocument && cwin.contentDocument.body.offsetHeight)
                                cwin.height = cwin.contentDocument.body.offsetHeight; 
                              else if(cwin.Document && cwin.Document.body.scrollHeight)
                                cwin.height = cwin.Document.body.scrollHeight;
                            }
                          }
                        }
                        </script>
                        <iframe src="/orderonline/public/statistic.html" width="778" align="center" height="500" id="cwin" name="cwin" onload="Javascript:SetCwinHeight(this)" frameborder="0" scrolling="no"></iframe>
<!--                         <iframe id="cwin" name="content" src="/orderonline/public/test.html" onload="javascript:SetCwinHeight(this)"></iframe>
 -->                    </div><!-- /.page-content -->

                </div><!-- /.main-content -->
            </div><!-- /.main-container-inner -->
            <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                <i class="icon-double-angle-up icon-only bigger-110"></i>
            </a>
        </div><!-- /.main-container -->
        <?php include ('basicscripts.php'); ?>
    </body>
</html>