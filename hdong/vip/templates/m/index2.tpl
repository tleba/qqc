    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"/>
    <link rel="icon" href="templates/m/2/images/favicon.ico" type="image/x-icon"/>
    <!--reset css-->
    <link rel="stylesheet" href="templates/m/2/css/normalize.css"/>
    <!--轮播图css-->
    <link rel="stylesheet" href="templates/m/2/css/owl.carousel.css"/>
    <link rel="stylesheet" href="templates/m/2/css/owl.theme.css"/>
    <!--页面样式-->
    <link rel="stylesheet" href="templates/m/2/css/style.css?t=1"/>
    <!--jquery 引入-->
    <script src="templates/m/2/js/jquery-1.11.1.min.js"></script>
    <!--轮播图js-->
    <script src="templates/m/2/js/owl.carousel.js"></script>
    <!--点击显示隐藏元素-->
    <script src="templates/m/2/js/toggle.js"></script>
<!--top bar-->
<div class="top_bar" id="topBar">
    <a href="javascript:" class="btn_register" id="btnRegister">
        <span><img src="templates/m/2/images/icon-register.png"></span>
        立即注册
    </a>
    <a href="#" id="btn_show_flow" class="btn_check_flow">
        <span><img src="templates/m/2/images/icon_flow.png"></span>
        查看流程
    </a>
</div>
<!--banner-->
<div class="banner">
    <a href="#" id="btn_banner">
        <img src="templates/m/2/images/banner.png">
    </a>
</div>
<div class="container">
    <div class="txt"><img src="templates/m/2/images/img_txt.png"/></div>
    <!--photos list-->
    <div class="photos-content">
        <ul class="photos-wrap">
            <li>
                <a style="border:0;width:100%;height:100%;display:block;position: inherit;" href="/hdong/pop"><img src="templates/m/2/images/imglist07.jpg"/></a>
            </li>
            <li>
                <a style="border:0;width:100%;height:100%;display:block;position: inherit;" href="/hdong/pop"><img src="templates/m/2/images/imglist08.jpg"/></a>
            </li>
            <li>
                <a style="border:0;width:100%;height:100%;display:block;position: inherit;" href="/hdong/pop"><img src="templates/m/2/images/imglist09.jpg"/></a>
            </li>
            <li>
                <a style="border:0;width:100%;height:100%;display:block;position: inherit;" href="/hdong/pop"><img src="templates/m/2/images/imglist01.jpg" /></a>
            </li>
            <li>
                <a style="border:0;width:100%;height:100%;display:block;position: inherit;" href="/hdong/pop"><img src="templates/m/2/images/imglist02.jpg" /></a>
            </li>
            <li>
                <a style="border:0;width:100%;height:100%;display:block;position: inherit;" href="/hdong/pop"><img src="templates/m/2/images/imglist03.jpg" /></a>
            </li>
            <li>
                <a style="border:0;width:100%;height:100%;display:block;position: inherit;" href="/hdong/pop"><img src="templates/m/2/images/imglist04.jpg" /></a>
            </li>
            <li>
                <a style="border:0;width:100%;height:100%;display:block;position: inherit;" href="/hdong/pop"><img src="templates/m/2/images/imglist05.jpg" /></a>
            </li>
            <li>
                <a style="border:0;width:100%;height:100%;display:block;position: inherit;" href="/hdong/pop"><img src="templates/m/2/images/imglist06.jpg" /></a>
            </li>
            <li>
                <a style="border:0;width:100%;height:100%;display:block;position: inherit;" href="/hdong/pop"><img src="templates/m/2/images/imglist10.jpg" /></a>
            </li>
            <li>
                <a style="border:0;width:100%;height:100%;display:block;position: inherit;" href="/hdong/pop"><img src="templates/m/2/images/imglist11.jpg" /></a>
            </li>
            <li>
                <a style="border:0;width:100%;height:100%;display:block;position: inherit;" href="/hdong/pop"><img src="templates/m/2/images/imglist12.jpg" /></a>
            </li>
        </ul>
    </div>
</div>

<!--过渡部分 客服-->
<div class="main_cs">
    <div class="bottom_arrow">
        <img src="templates/m/2/images/icon_next_page.png">
    </div>
    <!--客服弹出按钮-->
    <div class="cs">
        <a href="#" id="btn_cs">联系客服<br><span>&lt;&lt;展开</span></a>
        <div class="clear"></div>
    </div>
    <!--客服框-->
    <div class="cs_box" id="content_cs">
        <h4>联系客服</h4>
        <a href="tencent://message/?uin={$qq1}&Site=www.luoxiao123.cn&Menu=yes" id="cs1">
            <span><img src="templates/m/2/images/icon_qq_cs1.png"></span>
            <p>{$qq1}</p>
            <div class="clear"></div>
        </a>
        <a href="tencent://message/?uin={$qq2}&Site=www.luoxiao123.cn&Menu=yes" id="cs2">
            <span><img src="templates/m/2/images/icon_qq_cs2.png"></span>
            <p>{$qq2}</p>
            <div class="clear"></div>
        </a>
        <a href="https://tb.53kf.com/code/client/10138776/1" target="_blank" id="cs3">
            <span><img src="templates/m/2/images/icon_sc.png"></span>
            <p>7x24小时<br/>在线客服</p>
            <div class="clear"></div>
        </a>
        <a href="#" id="btn_hide_cs">&gt;&gt;收起</a>
    </div>
</div>
<!--注册页面-->
<!--注册js-->
<script>
{literal}
    function register() {
        var name = document.getElementById("loginname").value;
        var passwordfield = document.getElementById("pwd").value;
        var phone = document.getElementById("phone").value;
        var flag = true;
        var isphone= /^\d{11}$/;
        var isname = /^([a-zA-Z0-9]){4,11}$/;
        var ispwd = /^([a-zA-Z0-9]){6,16}$/;

        if (name == '') {
            flag = false;
            alert('帐号不能为空');
            return;
        } else if (!isname.test(name)) {
            flag = false;
            alert('账号由（4-11位）小写字母或数字组成');
            return;
        }

        if (passwordfield == '') {
            flag = false;
            alert('登陆密码不能为空');
            return;
        } else if (!ispwd.test(passwordfield)) {
            flag = false;
            alert('登录密码由（6-16位）小写字母和数字组成');
            return;
        }
         /*if(phone=='' || phone=='请填写正确的手机号码'){
         	flag = false;
         	alert('联系电话不能为空');
         	return;
         }else */
         if(phone && !isphone.test(phone)){
         	flag = false;
         	alert('电话格式不对');
         	return;
         }

        if (flag) {
            var form = document.getElementById("realAccount");
            form.submit();
        }
    }
{/literal}
</script>
<div class="register_box">
    <div class="container">
        <div class="title">
            <div class="logo"><img src="templates/m/2/images/register_logo.png"></div>
            <h3>注册尊龙娱乐账号</h3>
        </div>
        <div class="main_register">
            <form name="realAccount" id="realAccount" action="https://m.{$domain}/MarketCreateRealAccount.htm" method="post">
                <table cellpadding="0" cellspacing="0">
                    <tbody>
                    <tr>
                        <td class="icon_username"><img src="templates/m/2/images/icon_username.png"></td>
                        <td><input type="text" size="1" maxlength="1" class="prefix" readonly="" value="m">
                            <input type="hidden" name="prefix" value="m">
                            <input type="text" name="loginname" id="loginname" class="prefix1" maxlength="11" size="30" onmouseover="value=value.replace(/[^a-zA-Z0-9]/g,'')" onkeyup="value=value.replace(/[^a-zA-Z0-9]/g,'')" placeholder="账号（4-11位）字母或数字组合">
                        </td>
                    </tr>
                    <tr>
                        <td class="icon_password"><img src="templates/m/2/images/icon_password.png"></td>
                        <td><input type="password" maxlength="10" id="pwd" name="pwd" required="required" class="text password" size="20" placeholder="密码（6-16位）字母和数字组合"></td>
                    </tr>
                    <tr>
                        <td class="icon_phone"><img src="templates/m/2/images/icon_phone_num.png"></td>
                        <td><input type="text" name="phone" maxlength="11" id="phone" class="text phone" onkeypress="return numberOnly(event);" size="19" onkeyup="value=value.replace(/\D/g,'')" placeholder="手机号填写用于查询账号密码">
                        </td>
                    </tr>
                    <tr><td></td><td style="color: red;font-size: 1.4rem;">（注：务必先在此处注册尊龙账号使用，以免影响您正常绑定升级VIP及成人福利获取）</td></tr>
                    </tbody>
                </table>
                <div class="btn_submit">
                    <a href="javascript:register()" id="submitBtn" class="submit">快速注册</a>
                </div>
                <div class="btn_login">
                    <p>已有尊龙账号请，<a href="https://www.dd11d.net/" target="_blank">登录</a></p>
                </div>
            </form>
        </div>
    </div>
    <div class="register_flow">
        <img src="templates/m/2/images/img_flow.png">
    </div>
</div>
    <div class="check_flow">
        <span><img src="templates/m/2/images/icon_naozhogn.png"></span>
        <a class="btn_check_flow2" id="btn_show_flow2" href="javascript:void(0);"><img src="templates/m/2/images/btn_check_flow.png"></a>
        <div class="arrow_down">
            <img src="templates/m/2/images/icon_next_page.png">
        </div>
    </div>
<!--------------------------vip尊享------------------------>
<div class="vip_title">
    <img src="templates/m/2/images/title_vip.jpg">
</div>
<div class="vip_content">
    <div class="container">
        <div>
            <div class="vip_content1">
                <div class="content_icon1">
                    <img src="templates/m/2/images/icon_vip1.png">
                </div>
                <p>海量资源<br/>随时随地播放</p>
            </div>
            <div class="vip_content2">
                <div class="content_icon2">
                    <img src="templates/m/2/images/icon_vip2.png">
                </div>
                <p>美女裸聊<br/>保证火辣性感</p>
            </div>
            <div class="clear"></div>
        </div>
        <div>
            <div class="vip_content3">
                <div class="content_icon3">
                    <img src="templates/m/2/images/icon_vip3.png">
                </div>
                <p>各类游戏<br/>赢钱火速取款</p>
            </div>
            <div class="vip_content4">
                <div class="content_icon4">
                    <img src="templates/m/2/images/icon_vip4.png">
                </div>
                <p>尊贵礼品<br/>月月领到手软</p>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<!--------------------------青青草VIP 等级兑换------------------------>
<div class="qqc_lve">
    <div class="container">
        <div class="qqc_lve_title">
            <a href="javascript:;" id="use_describe">
                <img src="templates/m/2/images/title_qqc_vip.png"/>
            </a>
        </div>
        <div class="qqc_lve_content">
            <table>
                <tbody>
                    <tr>
                        <td width="10%">存款</td>
                        <td width="10%">色币数</td>
                        <td width="20%">游戏加赠色币</td>
                        <td width="20%">首存游戏加裸聊点</td>
                        <td width="30%">会员福利</td>
                    </tr>
                    <tr>
                        <td width="10%">20</td>
                        <td width="10%">20</td>
                        <td width="20%">10</td>
                        <td width="20%">100</td>
                        <td width="30%">腾讯视频7天会员</td>
                    </tr>
                    <tr>
                        <td width="10%">50</td>
                        <td width="10%">50</td>
                        <td width="20%">25</td>
                        <td width="20%">200</td>
                        <td width="30%">腾讯视频月会员</td>
                    </tr>
                    <tr>
                        <td width="10%">100</td>
                        <td width="10%">100</td>
                        <td width="20%">50</td>
                        <td width="20%">300</td>
                        <td width="30%">爱奇艺/腾讯会员+百度网盘会员</td>
                    </tr>
                    <tr>
                        <td width="10%">200</td>
                        <td width="10%">200</td>
                        <td width="20%">100</td>
                        <td width="20%">500</td>
                        <td width="30%">爱奇艺/腾讯会员+百度网盘会员+女优扑克</td>
                    </tr>
                    <tr>
                        <td width="10%">300</td>
                        <td width="10%">300</td>
                        <td width="20%">150</td>
                        <td width="20%">700</td>
                        <td width="30%">爱奇艺/腾讯会员+百度网盘会员+女优扑克</td>
                    </tr>
                    <tr>
                        <td width="10%">500</td>
                        <td width="10%">全年VIP</td>
                        <td width="20%" rowspan="3">无色币限制</td>
                        <td width="20%">1100</td>
                        <td width="30%">裸贷视频+爱奇艺/腾讯会员+百度网盘会员+女优扑克</td>
                    </tr>
                    <tr>
                        <td width="10%">1000</td>
                        <td width="10%" rowspan="2">永久VIP</td>
                        <td width="20%">2100</td>
                        <td width="30%" rowspan="2">裸贷视频+爱奇艺/腾讯会员+百度网盘会员+女优扑克+VR眼镜</td>
                    </tr>
                    <tr>
                        <td width="10%">2000</td>
                        <td width="20%">4000</td>
                    </tr>
                </tbody>
            </table>
            <div class="icon_next_arrow">
                <img src="templates/m/2/images/icon_next_page.png"/>
            </div>
        </div>
    </div>
</div>

<!--使用说明 弹出-->
<div id="main_describe" class="main_use">
    <div class="container">
        <div class="btn_close">
            <a href="javascript:;" id="btn_hide_desc"><img src="templates/m/2/images/btn_close.png"></a>
        </div>
        <div class="desc_bg flow_bg">
            <div id="owl-banner-use" class="owl-Carousel owl-carousel owl-theme">
                <a href="javascript:;" class="flow7"></a>
            </div>
        </div>
    </div>
</div>

<!------------------------------游戏类型-------------------------------->
<div class="game_type">
    <div class="container">
        <div class="banner">
            <div id="owl-banner" class="owl-Carousel owl-carousel owl-theme">
                <!--banner images-->
                <a class="item1" href="javascript:;"></a>
                <a class="item2" href="javascript:;"></a>
                <a class="item3" href="javascript:;"></a>
                <a class="item4" href="javascript:;"></a>
                <a class="item5" href="javascript:;"></a>
                <a class="item6" href="javascript:;"></a>
            </div>
        </div>
    </div>
</div>
<!--每月会员日-->
<div class="vip_day">
    <img src="templates/m/2/images/img_vip_day.png"/>
    <div class="container">
        <a href="http://www.dd118d.com" target="_blank" class="btn_play_now">立即娱乐</a>
    </div>
</div>
<!--查看流程 弹出-->
<div id="flow" class="main_flow">
    <div class="container">
        <div class="btn_close">
            <a href="#" id="btn_hide_flow"><img src="templates/m/2/images/btn_close.png"></a>
        </div>
        <div class="flow_bg">
            <div id="owl-banner-flow" class="owl-Carousel owl-carousel owl-theme">
                <!--flow images-->
                <a href="javascript:;" class="flow1"></a>
                <a href="javascript:;" class="flow2"></a>
                <a href="javascript:;" class="flow3"></a>
                <a href="javascript:;" class="flow4"></a>
                <a href="javascript:;" class="flow5"></a>
                <a href="javascript:;" class="flow6"></a>
                <a href="javascript:;" class="flow7"></a>
            </div>
        </div>

    </div>
</div>

<!--裸聊表格 弹出-->
<div class="plug-luoliao">
    <div class="container">
        <a href="#" id="btn_hide_luoliao"><img src="templates/m/2/images/btn_close.png"></a>
        <div class="luoliao-table">
            <h3>真人裸聊福利兑换说明 </h3>
            <p>（限首存之日起6个自然月内的游戏账号兑换使用）</p>
            <table border="1">
                <thead>
                <tr>
                    <th width="60px">存款</th>
                    <th width="110px">首存游戏加赠点</th>
                    <th width="110px">续存游戏赠点</th>
                    <th width="150px">三存开始1:1赠点</th>
                    <th width="300px">
                        累计&ge;2000元按月流水
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>20元</td>
                    <td>100点</td>
                    <td>150点</td>
                    <td>20点</td>
                    <td>1千~5千：300点</td>
                </tr>
                <tr style="background: gainsboro;">
                    <td>50元</td>
                    <td>200点</td>
                    <td>250点</td>
                    <td>50点</td>
                    <td>5千~2万：500点</td>
                </tr>
                <tr>
                    <td>100元</td>
                    <td>300点</td>
                    <td>350点</td>
                    <td>100点</td>
                    <td>2万~5万：1000点</td>
                </tr>
                <tr style="background: gainsboro;">
                    <td>200元</td>
                    <td>500点</td>
                    <td>550点</td>
                    <td>200点</td>
                    <td>5万~10万：1500点</td>
                </tr>
                <tr>
                    <td>300元</td>
                    <td>700点</td>
                    <td>750点</td>
                    <td>300点</td>
                    <td>10万~20万：2000点</td>
                </tr>
                <tr style="background: gainsboro;">
                    <td>500元</td>
                    <td>1100点</td>
                    <td>1200点</td>
                    <td>500点</td>
                    <td>20万~30万：2500点</td>
                </tr>
                <tr>
                    <td>1000元</td>
                    <td>2100点</td>
                    <td>2200点</td>
                    <td>按月游戏流水参与</td>
                    <td>30万~50万：3000点</td>
                </tr>
                <tr style="background: gainsboro;">
                    <td>2000元</td>
                    <td>4000点</td>
                    <td colspan="2">按月游戏流水兑点</td>
                    <td>&ge;50万：3500点</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!--banner轮播图 js-->
<script>
{literal}
//    游戏类型 轮播js
    $(document).ready(function () {
        $("#owl-banner").owlCarousel({
            slideSpeed: 300,
            paginationSpeed: 400,
            singleItem: true,
            autoPlay: 3000,
            stopOnHover: true,
            // "singleItem:true" is a shortcut for:
            items: 1,
            itemsDesktop: false,
            itemsDesktopSmall: false,
            itemsTablet: false,
            itemsMobile: false
        });
    });
//    查看流程 轮播js
    $(document).ready(function () {
        $("#owl-banner-flow").owlCarousel({
            slideSpeed: 300,
            paginationSpeed: 400,
            singleItem: true,
            autoPlay: 3000,
            stopOnHover: true,
            // "singleItem:true" is a shortcut for:
            items: 1,
            itemsDesktop: false,
            itemsDesktopSmall: false,
            itemsTablet: false,
            itemsMobile: false
        });
    });
//    使用说明 轮播js
$(document).ready(function () {
    $("#owl-banner-use").owlCarousel({
        slideSpeed: 300,
        paginationSpeed: 400,
        singleItem: true,
        autoPlay: 3000,
        stopOnHover: true,
        // "singleItem:true" is a shortcut for:
        items: 1,
        itemsDesktop: false,
        itemsDesktopSmall: false,
        itemsTablet: false,
        itemsMobile: false
    });
});
{/literal}
</script>

<!--VIP页浮标代码JS-->
<script>
{literal}
(function() {
		var _53code = document.createElement("script");
		_53code.src = "https://tb.53kf.com/code/code/10138776/1";
		var s = document.getElementsByTagName("script")[0]; 
		s.parentNode.insertBefore(_53code, s);
	}
)();
{/literal}
</script>