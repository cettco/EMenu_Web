<div class="sidebar" id="sidebar">
    <script type="text/javascript">
        try {
            ace.settings.check('sidebar', 'fixed')
        } catch(e) {}
    </script>
    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <a class="btn btn-success" href="#statistics_chartrevenue">
                <i class="icon-bar-chart"></i>
            </a>
            <a class="btn btn-info" href="/orderonline/index.php/WebPage/tableorder">
                <i class="icon-shopping-cart"></i>
            </a>
            <a class="btn btn-warning" href="#shop">
                <i class="icon-desktop"></i>
            </a>
            <a class="btn btn-danger" href="#pay">
                <i class="icon-smile"></i>
            </a>
        </div>
        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>
            <span class="btn btn-info"></span>
            <span class="btn btn-warning"></span>
            <span class="btn btn-danger"></span>
        </div>
    </div>
    <!-- #sidebar-shortcuts -->
    <!-- notice which is selected or active-->
    <ul class="nav nav-list">
        <li>
            <a href="/orderonline/index.php/WebPage/mainpage">
                <i class="icon-home"></i>
                <span class="menu-text">首页</span>
            </a>
        </li>
        <li>
            <a href="/orderonline/index.php/WebPage/statistic">
                <i class="icon-bar-chart"></i>
                <span class="menu-text">统计</span>
            </a>
        </li>
        <li>
            <a href="#" class="dropdown-toggle">
                <i class="icon-shopping-cart"></i>
                <span class="menu-text">订单</span>
                <b class="arrow icon-angle-down"></b>
            </a>
            <ul class="submenu">
                <li>
                    <a href="/orderonline/index.php/WebPage/ordereditem">
                        <i class="icon-double-angle-right"></i>
                        已点订单
                    </a>
                </li>
                <li>
                    <a href="#ordersearch">
                        <i class="icon-double-angle-right"></i>
                        订单搜索
                    </a>
                </li>
                <li>
                    <a href="#orderexport">
                        <i class="icon-double-angle-right"></i>
                        导出订单
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#" class="dropdown-toggle">
                <i class="icon-desktop"></i>
                <span class="menu-text">店铺</span>
                <b class="arrow icon-angle-down"></b>
            </a>
            <ul class="submenu">
                <li>
                    <a href="/orderonline/index.php/WebPage/shopmanagement">
                        <i class="icon-double-angle-right"></i>
                        店铺管理
                    </a>
                </li>
                <li>
                    <a href="/orderonline/index.php/WebPage/tablemanagement">
                        <i class="icon-double-angle-right"></i>
                        餐桌管理
                    </a>
                </li>
                <li>
                    <a href="/orderonline/index.php/WebPage/menu">
                        <i class="icon-double-angle-right"></i>
                        菜单管理
                    </a>
                </li>
                                    <!--<li>
                                                            <a href="#printer">
                                                                <i class="icon-double-angle-right"></i>
                                                                打印机设置
                                                            </a>
                                                        </li>-->
            </ul>
        </li>
                    <!--<li>
                                    <a href="#" class="dropdown-toggle">
                                        <i class="icon-comment"></i>
                                        <span class="menu-text">顾客交流</span>
                                        <b class="arrow icon-angle-down"></b>
                                    </a>
                                    <ul class="submenu">
                                        <li>
                                            <a href="/orderonline/public/message/index.html">
                                                <i class="icon-double-angle-right"></i>
                                                店铺留言
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/orderonline/public/message/comment.html">
                                                <i class="icon-double-angle-right"></i>
                                                店铺评论
                                            </a>
                                        </li>
                                    </ul>
                                </li>-->
        <li>
            <a href="#" class="dropdown-toggle">
                <i class="icon-gear"></i>
                <span class="menu-text">设置</span>
                <b class="arrow icon-angle-down"></b>
            </a>
            <ul class="submenu">
                <li>
                    <a href="/orderonline/index.php/WebPage/changepwd">
                        <i class="icon-double-angle-right"></i>
                        帐号设置
                    </a>
                </li>
                <!-- <li>
                    <a href="#employee">
                        <i class="icon-double-angle-right"></i>
                        员工账号
                    </a>
                </li> -->
            </ul>
        </li>
    </ul>
    <!-- /.nav-list -->
    <div class="sidebar-collapse" id="sidebar-collapse">
        <i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
    </div>
    <script type="text/javascript">
        try {
            ace.settings.check('sidebar', 'collapsed')
        } catch(e) {}
    </script>
</div>