<!-- basic scripts -->
<!--[if !IE]> -->
<script type="text/javascript">
    window.jQuery || document.write("<script src='/ace/js/jquery-2.0.3.min.js'>"+"<"+"/orderonline/public/script>");
</script>

<!-- <![endif]-->
    <!--[if IE]>
                    <script type="text/javascript">
                     window.jQuery || document.write("<script src='/ace/js/jquery-1.10.2.min.js'>"+"<"+"/orderonline/public/script>");
                    </script>
                    <![endif]-->
<script type="text/javascript">
    if("ontouchend" in document) document.write("<script src='/ace/js/jquery.mobile.custom.min.js'>"+"<"+"/orderonline/public/script>");
</script>
<script src="/orderonline/public/ace/js/bootstrap.min.js"></script>
<script src="/orderonline/public/ace/js/typeahead-bs2.min.js"></script>

<!-- page specific plugin scripts -->
    <!--[if lte IE 8]>
                      <script src="/orderonline/public/ace/js/excanvas.min.js"></script>
                    <![endif]-->
<script src="/orderonline/public/ace/js/jquery-ui-1.10.3.full.min.js"></script>
<script src="/orderonline/public/ace/js/jquery.ui.touch-punch.min.js"></script>
<script src="/orderonline/public/ace/js/jquery.slimscroll.min.js"></script>
<script src="/orderonline/public/ace/js/jquery.easy-pie-chart.min.js"></script>
<script src="/orderonline/public/ace/js/jquery.sparkline.min.js"></script>
<script src="/orderonline/public/ace/js/flot/jquery.flot.min.js"></script>
<script src="/orderonline/public/ace/js/flot/jquery.flot.pie.min.js"></script>
<script src="/orderonline/public/ace/js/flot/jquery.flot.resize.min.js"></script>

<!-- ace scripts -->
<script src="/orderonline/public/ace/js/ace-elements.min.js"></script>
<script src="/orderonline/public/ace/js/ace.min.js"></script>
<script>
    function alertshow(content){
        $('#popalertwindowcontent').html(content);
        $('#popalertwindow').show();
    }
    $(function(){
        showalert();
        window.setInterval(showalert, 30000);
    })
    
    function closeoa(){
        $("#orderAlert").slideUp();
        stopFlash();
    }
    
    function tourl(){
        location.href="/orderonline/public/order/viewopen.html";
    }
    
    function showalert() {
        var initTime = "1400332537";
        var url = "/orderonline/public/order/getneworder.html"+"?initTime="+initTime;
        $.get(url,function(data){
            var list = data.split(":::");
            $("#oantnum").html(list[1]);
            if(list[0] > 0){
                var nowDate = new Date();
                var str = nowDate.getFullYear()+"-"+(nowDate.getMonth() + 1)+"-"+nowDate.getDate()+" "+nowDate.getHours()+":"+nowDate.getMinutes()+":"+nowDate.getSeconds();
                $("#oanum").html(list[0]);
                $("#oatnum,.oatnum").html(list[1]);
                $("#oatime").html(str);
                $("#orderAlert").slideUp();
                $("#orderAlert").slideDown();
                $("#soundsw").show(1000,function(){
                    $("#soundsw").html('<embed src="/orderonline/public/music/dingdong.wav" loop="0" autostart="true"></embed>');
                    $("#soundsw").hide();
                });
                flashTitle("您有"+list[0]+"笔新订单");
            }
        });
    }
    
    var flashTitlePlayer = {
        start: function (msg) {
            this.title = document.title;
            if (!this.action) {
                try {
                    this.element = document.getElementsByTagName('title')[0];
                    this.element.innerHTML = this.title;
                    this.action = function (ttl) {
                        this.element.innerHTML = ttl;
                    };
                } catch (e) {
                    this.action = function (ttl) {
                        document.title = ttl;
                    }
                    delete this.element;
                }
                this.toggleTitle = function () {
                    this.action('【' + this.messages[this.index = this.index == 0 ? 1 : 0] + '】乐外卖');
                };
            }
            this.messages = [msg];
            var n = msg.length;
            var s = '';
            if (this.element) {
                var num = msg.match(/\w/g);
                if (num != null) {
                    var n2 = num.length;
                    n -= n2;
                    while (n2 > 0) {
                        s += " ";
                        n2--;
                    }
                }
            }
            while (n > 0) {
                s += '　';
                n--;
            };
            this.messages.push(s);
            this.index = 0;
            this.timer = setInterval(function () {
                flashTitlePlayer.toggleTitle();
            }, 2000);
        },
        stop: function () {
            if (this.timer) {
                clearInterval(this.timer);
                this.action(this.title);
                delete this.timer;
                delete this.messages;
            }
        }
    };
    function flashTitle(msg) {
        flashTitlePlayer.start(msg);
    }
    function stopFlash() {
        flashTitlePlayer.stop();
    }
</script>
<div style="position:fixed;width:100%;height:100%;top:0px;left:0px;display:none;" id="popalertwindow">
    <div style="width:100%;height:100%;background:#eeeeee;filter:alpha(opacity=50);-moz-opacity:0.5;-khtml-opacity: 0.5;opacity: 0.5;position: absolute;z-index:9999;"></div>
    <div style="position:relative;width:500px;height:200px;margin:200px auto;filter:alpha(opacity=100);-moz-opacity:1;-khtml-opacity: 1;opacity: 1;z-index:10000;background:#ffffff;-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;-webkit-box-shadow: #666 0px 0px 10px;-moz-box-shadow: #666 0px 0px 10px;box-shadow: #666 0px 0px 10px;">
        <div style="height:40px;"></div>
        <div style="width:400px;height:90px;margin:0px auto;color:#999999;text-align:center;font-size:20px;">
            <table style="width:400px;height:90px;">
                <tr>
                    <td id="popalertwindowcontent"></td>
                </tr>
            </table>
        </div>
        <div style="height:20px;"></div>
        <div style="width:80px;height:40px;background:#eeeeee;margin:0 auto;line-height:40px;text-align:center;font-size:20px;border:1px solid #999999;cursor:pointer;" onclick="$('#popalertwindow').hide();">
				确认
        </div>
    </div>
</div>
<script type="text/javascript" src="/orderonline/public/assets/2514499d/gridview/jquery.yiigridview.js"></script>
