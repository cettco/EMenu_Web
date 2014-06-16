<div class="navbar navbar-default" id="navbar">
    <script type="text/javascript">
        try{ace.settings.check('navbar' , 'fixed')}catch(e){}
    </script>

    <div class="navbar-container" id="navbar-container">
        <div class="navbar-header pull-left">
            <a href="/orderonline/index.php/WebPage/mainpage" class="navbar-brand" style="padding: 5px 0 0 0;">
                <small>
                    <img src="/orderonline/public/img/logo_38.png">
						EMenu
                    <?php
                        
                        
                        if (!isset($_SESSION['accountid'])) {
                            // $accountid = $_GET['accountid'];
                            // $this->load->model('Management_Model');
                            // $accountarr = $this->Management_Model->select_row($accountid,'account');
                            // $restaurantid = $accountarr->result()[0]->restaurant_id;
                            // $accountname = $accountarr->result()[0]->username;
                            // $restaurantarr = $this->Management_Model->select_row($restaurantid,'restaurant');
                            // $restaurantname = $restaurantarr->result()[0]->name;
                        
                            // $_SESSION['accountid']=$accountid;
                            // $_SESSION['restaurantname']=$restaurantname;
                            // $_SESSION['accountname']=$accountname;
                        }
                        else
                        {
                            $accountid=$_SESSION['accountid'];
                            $this->load->model('Management_Model');
                            $accountarr = $this->Management_Model->select_row($accountid,'account');
                            $restaurantid = $accountarr->result()[0]->restaurant_id;
                            $accountname = $accountarr->result()[0]->username;
                            $restaurantarr = $this->Management_Model->select_row($restaurantid,'restaurant');
                            $restaurantname = $restaurantarr->result()[0]->name;
                        }
                        
                            echo $restaurantname;
                        
                    ?>
                        后台管理
                </small>
            </a><!-- /.brand -->
        </div><!-- /.navbar-header -->
        <div class="navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">
                <li class="red">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="icon-bell-alt icon-animated-bell"></i>
                        <span class="badge badge-important oatnum redalert">0</span>
                    </a>

                    <ul class="pull-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
                        <li class="dropdown-header">
                            <i class="icon-warning-sign"></i>
                            <span class="oatnum readalert1 redalert">0</span>催单
                        </li>


                        <li>
                            <a href="/orderonline/index.php/WebPage/reminder">
									查看全部催单
                                <i class="icon-arrow-right"></i>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="green">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="icon-bell-alt icon-animated-bell"></i>
                        <span class="badge badge-success">0</span>
                    </a>
                    <script src="/orderonline/public/js/socket.io.js"></script>

                        <script>
                        var count=0;
                        var  global_socket = io.connect('http://m.tzwm.me:8000');
                        global_socket.on('connection', function(data) {
                            var restaurantid = "";
                            restaurantid = <?php echo $_SESSION['restaurantid'] ;?>;
                            if(restaurantid==data.restaurantid)
                                {
                                     $(".redalert").empty();
                                     count++;
                                     $(".redalert").text(count);              
                                }                                            
                        });    
                        </script>
                    <ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                        <li class="dropdown-header">
                            <span class="oatnum readalert1 greenalert">0</span>催单
                        </li>

                        <li>
                            <a href="/orderonline/index.php/WebPage/reminder">
                                    查看全部催单
                                <i class="icon-arrow-right"></i>
                            </a>
                        </li>

                        <li>

                        </li>
                    </ul>
                </li>

                <li class="light-blue">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        <img class="nav-user-photo" src="/orderonline/public/ace/avatars/user.jpg" alt="Jason's Photo" />
                        <span class="user-info">
                            <small>欢迎您，</small>
                            <?php
                                echo $accountname;
                            ?>							</span>

                        <i class="icon-caret-down"></i>
                    </a>

                    <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <li>
                            <a href="/orderonline/index.php/WebPage/changepwd">
                                <i class="icon-user"></i>
									帐号设置
                            </a>
                        </li>

                        <li class="divider"></li>

                        <li>
                            <a href="#logout">
                                <i class="icon-off"></i>
									退出
                            </a>
                        </li>
                    </ul>
                </li>
            </ul><!-- /.ace-nav -->
        </div><!-- /.navbar-header -->
    </div><!-- /.container -->
</div>
