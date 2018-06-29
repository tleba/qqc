	<link rel="stylesheet" href="2/css/swiper.min.css">
	<link rel="stylesheet" href="2/css/base.css">
    <link rel="stylesheet" href="2/css/index.css?t=6">
    <div class="plug">
        <!-- Swiper -->
        <div class="swiperContent">
            <span class="close"><img src="2/images/close_03.png"></span>
            <span class="closeLine"></span>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><img src="2/images/plug_03.jpg"></div>
                    <div class="swiper-slide logins">
                        <img src="2/images/plug2_03.jpg">
                        <a href="" class="left"></a>
                        <a href="" class="right"></a>
                    </div>
                    <div class="swiper-slide"><img src="2/images/plug3_03.jpg"></div>
                    <div class="swiper-slide"><img src="2/images/plug4_03.jpg"></div>
                    <div class="swiper-slide"><img src="2/images/plug5_03.jpg"></div>
                    <div class="swiper-slide"><img src="2/images/plug6_03.jpg"></div>
                </div>
            </div>
            <div class="swiper-right">
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <!-- Add Pagination -->
    </div>

    <div class="plug-luoliao">
        <div class="luoliao-content">
            <span class="close"><img src="2/images/close_03.png"></span>
            <div class="luoliao-table">
                <h3>真人裸聊福利兑换说明 </h3>
                <p>（限首存之日起6个自然月内的游戏账号兑换使用）</p>
                <table border="1">
                    <thead>
                    <tr>
                        <th width="60px">首存</th>
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


    <div class="qq">
        <a href="javascript:void(0)" class="first" id="btn-register"><span>注册尊龙</span></a>
        <div class="isolate"></div>
        <a href="javascript:void(0);" id="wvip"><span>VIP等级兑换</span></a>
        <div class="isolate"></div>
        <a href="javascript:void(0);" data-role="wflow"><span>详细开通流程</span></a>
        <div class="isolate"></div>
        <a href="https://tb.53kf.com/code/client/10138776/1" target="_blank" class="small"><span>7x24小时在线客服</span></a>
        <div class="isolate"></div>
        <div class="title">青青草QQ</div>
        <div class="avator_box">
            <a class="first_avator" target="_blank" href="tencent://message/?uin={$qq1}&Site=qq&Menu=yes"><span class="avator"><img src="2/images/avator.png" /></span>{$qq1}</a>
            <div class="isolate"></div>
            <a class="second_avator" target="_blank" href="tencent://message/?uin={$qq2}&Site=qq&Menu=yes"><span class="avator"><img src="2/images/avator2.png" /></span>{$qq2}</a>
        </div>
    </div>
    <div class="wrapper">
        <div class="top"></div>
        <div class="relative">
            <div class="contain">
                <div class="layer">
                    <div class="login_box">
                        <div class="login">
                            <h4>注册尊龙娱乐账号</h4>
                            <form name="realAccount" id="realAccount" action="https://www.{$domain}/MarketCreateRealAccount.htm" method="post">
                            <div class="content">
                                <div class="input"><em class="icon iuser"></em>
                                    <span class="orange_bg">m<input type="hidden" name="prefix" value="m"/></span>
                                    <input type="text" placeholder="账号（4-11位）字母或数字组合" maxlength="11" name="loginname" id="loginname" onmouseover="value=value.replace(/[^a-zA-Z0-9]/g,'')" onkeyup="value=value.replace(/[^a-zA-Z0-9]/g,'')"/>
                                </div>
                                <div class="input"><em class="icon ipw"></em>
                                    <input type="password" placeholder="密码（6-16位）字母和数字组合" maxlength="16" id="pwd" name="pwd">
                                </div>
                                <div class="input"><em class="icon iphone"></em>
                                    <input type="tel" placeholder="手机号填写用于查询账号密码" id="phone" name="phone" onkeypress="return numberOnly(event);" onkeyup="value=value.replace(/\D/g,'')">
                                </div>
                                <div class="input" style="height:auto;margin-bottom:0;color:red;">（注：务必先在此处注册尊龙账号使用，以免影响您正常绑定升级VIP及成人福利获取）</div>
                                </ul>
                                <div class="btn_group" style="margin-top:10px;"><a href="javascript:void(0);" onclick="register()" id='but' class="btn btn_blue">快速注册</a></div>
                                <p style="margin-top:10px;">已有尊龙账号，<a href="https://www.dd11d.net/" target="_blank">登陆</a></p>
                            </div>
                            </form>
                            <div class="img"><img src="2/images/login_txt.png"></div>
                        </div>
                        <a href="javascript:void(0);" class="watch" data-role="wflow"><img src="2/images/watch.png" alt="查看流程" title="查看流程" /></a>
                    </div>
                    <div class="banner">
                        <div class="title"><img src="2/images/title.png" alt="火辣视频 性感直播 刺激娱乐 24小时永不停歇" title="火辣视频 性感直播 刺激娱乐 24小时永不停歇" /></div>
                        <div class="b_banner">
                            <div id="focus">
                                <ul>
                                    <li><a style="border:0;width:100%;height:auto;position: inherit;" href="/hdong/pop"><img src="2/images/l_banner.jpg"></a></li>
                                    <li><a style="border:0;width:100%;height:auto;position: inherit;" href="/hdong/pop"><img src="2/images/l_banner.jpg"></a></li>
                                    <li><a style="border:0;width:100%;height:auto;position: inherit;" href="/hdong/pop"><img src="2/images/l_banner.jpg"></a></li>
                                    <li><a style="border:0;width:100%;height:auto;position: inherit;" href="/hdong/pop"><img src="2/images/l_banner.jpg"></a></li>
                                    <li><a style="border:0;width:100%;height:auto;position: inherit;" href="/hdong/pop"><img src="2/images/l_banner.jpg"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="clear">&nbsp;</div>
                </div>
            </div>
        </div>
    </div>
    <div class="vip">
        <div class="content">
            <div class="contain">
                <img src="2/images/vip_img.png" />
                <div id="icon" class="icon_group">
                    <div class="block">
                        <span><img src="2/images/icon/i1.png" /></span>
                        <p>海量资源</p>
                        <p>随时随地播放</p>
                    </div>
                    <div class="block btn-luoliao">
                        <span><img src="2/images/icon/i2.png" /></span>
                        <p>美女裸聊</p>
                        <p>保证火辣性感</p>
                    </div>
                    <div class="block">
                        <span><img src="2/images/icon/i3.png" /></span>
                        <p>各类游戏</p>
                        <p>赢钱火速取款</p>
                    </div>
                    <div class="block">
                        <span><img src="2/images/icon/i4.png" /></span>
                        <p>尊贵礼品</p>
                        <p>月月领到手软</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="vip_grade">
        <div class="contain">
            <a href="javascript:;" id="tabletext" class="left"><img src="2/images/vip_grade.png">
            </a>
            <div class="content">
                <table>
                    <thead>
                        <tr>
                            <th width="60px">存款</th>
                            <th width="70px">色币数</th>
                            <th width="110px">游戏加赠色币</th>
                            <th width="">首存游戏加赠裸聊点</th>
                            <th width="340px">
                                会员福利
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>20</td>
                            <td>20</td>
                            <td>10</td>
                            <td>
                                <div class="relative">100点
                                    <div class="pp">
                                        <div class="title">新手</div>
                                        <p>腾讯视频7天会员</p>
                                        <span class="more"></span>
                                    </div>
                                </div>
                            </td>
                            <td>腾讯视频7天会员
                            </td>
                        </tr>
                        <tr>
                            <td>50</td>
                            <td>50</td>
                            <td>25</td>
                            <td>
                                <div class="relative">200点
                                    <div class="pp">
                                        <div class="title">屌丝</div>
                                        <p>腾讯视频月会员</p>
                                        <span class="more"></span>
                                    </div>
                                </div>
                            </td>
                            <td>腾讯视频月会员</td>
                        </tr>
                        <tr>
                            <td>100</td>
                            <td>100</td>
                            <td>50</td>
                            <td>
                                <div class="relative">300点
                                    <div class="pp">
                                        <div class="title">老板</div>
                                        <p>爱奇艺/腾讯会员+百度网盘会员</p>
                                        <span class="more"></span>
                                    </div>
                                </div>
                            </td>
                            <td>爱奇艺/腾讯会员+百度网盘会员</td>
                        </tr>
                        <tr>
                            <td>200</td>
                            <td>200</td>
                            <td>100</td>
                            <td>
                                <div class="relative">500点
                                    <div class="pp">
                                        <div class="title">富人</div>
                                        <p>爱奇艺/腾讯会员+百度网盘会员+女优扑克</p>
                                        <span class="more"></span>
                                    </div>
                                </div>
                            </td>
                            <td>爱奇艺/腾讯会员+百度网盘会员+女优扑克
                            </td>
                        </tr>
                        <tr>
                            <td>300</td>
                            <td>300</td>
                            <td>150</td>
                            <td>
                                <div class="relative">700点
                                    <div class="pp">
                                        <div class="title">富豪</div>
                                        <p>爱奇艺/腾讯会员+百度网盘会员+女优扑克</p>
                                        <span class="more"></span>
                                    </div>
                                </div>
                            </td>
                            <td>爱奇艺/腾讯会员+百度网盘会员+女优扑克
                            </td>
                        </tr>
                        <tr>
                            <td>500</td>
                            <td>全年VIP</td>
                            <td rowspan="3">无色币限制</td>
                            <td>
                                <div class="relative">1100点
                                    <div class="pp">
                                        <div class="title">大富豪</div>
                                        <p>裸贷视频+爱奇艺/腾讯会员+百度网盘会员+女优扑克</p>
                                        <span class="more"></span>
                                    </div>
                                </div>
                            </td>
                            <td>裸贷视频+爱奇艺/腾讯会员+百度网盘会员+女优扑克
                            </td>
                        </tr>
                        <tr>
                            <td>1000</td>
                            <td rowspan="2">永久VIP</td>
                            <td>
                                <div class="relative">2100点
                                    <div class="pp">
                                        <div class="title">福布斯</div>
                                        <p>裸贷视频+爱奇艺/腾讯会员+百度网盘会员+女优扑克+VR眼镜</p>
                                        <span class="more"></span>
                                    </div>
                                </div>
                            </td>
                            <td>裸贷视频+爱奇艺/腾讯会员+百度网盘会员+女优扑克+VR眼镜
                            </td>
                        </tr>
                        <tr>
                            <td>2000</td>
                            <td>
                                <div class="relative">4000点
                                    <div class="pp">
                                        <div class="title">福布斯</div>
                                        <p>裸贷视频+爱奇艺/腾讯会员+网盘会员+女优扑克+VR眼镜</p>
                                        <span class="more"></span>
                                    </div>
                                </div>
                            </td>
                            <td>裸贷视频+爱奇艺/腾讯会员+网盘会员+女优扑克+VR眼镜
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="info">
                    <h3>使用说明</h3>
                    <p><em class="icon idot"></em>一个电影只需消耗一个色币</p>
                    <p><em class="icon idot"></em>青青草账号可与成功充值的尊龙账号进行绑定，存款<span class="yellow">自动兑换VIP色币</span>（详情点击查看流程）</p>
                    <p><em class="icon idot"></em>尊龙娱乐游戏后，可联系青青草客服为您<span class="yellow">添加额外色币、激活裸聊账号及相关福利</span></p>
                    <p><em class="icon idot"></em>每月20号青青草会员日，游戏流水英雄榜，神秘大奖月月等您抢</p>
                    <p><em class="icon idot"></em>尊龙账号输赢不影响青青草 VIP使用</p>
                </div>
            </div>
        </div>
    </div>
    <div class="layer_last">
        <div class="banner">
            <a href="javascript:;" class="lf" id="left"></a>
            <a href="javascript:;" class="rt" id="right"></a>
            <div class="c-banner" id="c-banner">
                <ul>
                    <li>
                        <img src="2/images/lb1.png" alt="美女云集 火辣发牌" title="美女云集 火辣发牌" />
                        <a href="http://www.dd118d.com/livecasino.htm" target="_blank" class="hidden"></a>
                        <a href="javascript:void(0);" class="left"></a>
                        <a href="javascript:void(0);" class="right"></a>
                    </li>
                    <li>
                        <img src="2/images/lb2.png" alt="百款电游 以小搏大" title="百款电游 以小搏大" />
                        <a href="http://www.dd118d.com/slot-home.htm" target="_blank" class="hidden"></a>
                        <a href="javascript:void(0);" class="left"></a>
                        <a href="javascript:void(0);" class="right"></a>
                    </li>
                    <li>
                        <img src="2/images/lb3.png" alt="水位高 赛事广" title="水位高 赛事广" />
                        <a href="http://www.dd118d.com/virtual-sports.htm" target="_blank" class="hidden"></a>
                        <a href="javascript:void(0);" class="left"></a>
                        <a href="javascript:void(0);" class="right"></a>
                    </li>
                    <li>
                        <img src="2/images/lb4.png" alt="捕得多 赢的多" title="捕得多 赢的多" />
                        <a href="http://www.dd118d.com/slot-home.htm" target="_blank" class="hidden"></a>
                        <a href="javascript:void(0);" class="left"></a>
                        <a href="javascript:void(0);" class="right"></a>
                    </li>
                    <li>
                        <img src="2/images/lb5.png" alt="真人对战" title="真人对战" />
                        <a href="http://www.dd118d.com/ap_home.htm" target="_blank" class="hidden"></a>
                        <a href="javascript:void(0);" class="left"></a>
                        <a href="javascript:void(0);" class="right"></a>
                    </li>
                    <li>
                        <img src="2/images/lb6.png" alt="彩种丰富" title="彩种丰富" />
                        <a href="http://www.dd118d.com/lotteryhome.htm" target="_blank" class="hidden"></a>
                        <a href="javascript:void(0);" class="left"></a>
                        <a href="javascript:void(0);" class="right"></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Swiper JS -->
    <script src="2/js/swiper.min.js"></script>
    <script src="2/js/jquery.min.js"></script>
    <!-- Initialize Swiper -->
    <script>
    {literal}
    function register(){
			var name = document.getElementById("loginname").value;
			var passwordfield = document.getElementById("pwd").value;
			var phone = document.getElementById("phone").value;
			var flag = true;
			var isphone= /^\d{11}$/;
			var isname = /^([a-zA-Z0-9]){4,11}$/;
			var ispwd = /^([a-zA-Z0-9]){6,16}$/;
           
			if(name==''){
				flag = false;
				alert('帐号不能为空');
				return;
			}else if(!isname.test(name)){
				flag = false;
				alert('账号由（4-11位）小写字母或数字组成');
				return;
			}

			if(passwordfield==''){
				flag = false;
				alert('登陆密码不能为空');
				return;
			}else if(!ispwd.test(passwordfield)){
				flag = false;
				alert('登录密码由（8-10位）小写字母和数字组成');
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

			if(flag){
				var form = document.getElementById("realAccount");
			    form.submit();
			}
	}
    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        paginationClickable: true,
        direction: 'vertical'
    });

    $(function() {
        $("[data-role='wflow']").click(function() {
            $(".plug").css('top', '0px');
            $(".swiperContent").css('marginLeft', '-430px');


        });
        $("#btn-register").click(function() {
            $("html,body").animate({
                scrollTop: $(".login_box").offset().top
            }, 1000);
        });
        $("#wvip").click(function() {
            $("html,body").animate({
                scrollTop: $(".vip_grade").offset().top
            }, 1000);
        });
        $(".close").click(function() {
            $(".plug").css('top', '-10000px');
            $(".swiperContent").css('marginLeft', '-4300px');
            $(".plug-luoliao").fadeOut();

        });

        $(".btn-luoliao").click(function () {
            $(".plug-luoliao").fadeIn();
        });

        $("#tabletext").mouseenter(function() {
            $(".info").show();

        });
        $("#tabletext").mouseleave(function() {
            $(".info").hide();

        });
    });
    {/literal}
    </script>
    <script type="text/javascript">
    {literal}
    var clearTime;
    function runs() {
        var oleft = document.getElementById("left")
        var oright = document.getElementById("right")
        var oDiv = document.getElementById("c-banner");
        var oUl = oDiv.getElementsByTagName('ul')[0]
        var oLi = oUl.getElementsByTagName('li');
        var sppend = -1126;
        oleft.onclick = function() {
            sppend = 1126;
            move()
                // oUl.style.left = oUl.offsetLeft+sppend+"px"
        }
        oright.onclick = function() {
            sppend = -1126;
            move()
                //oUl.style.left = oUl.offsetLeft+sppend+"px"
        }
        oUl.innerHTML = oUl.innerHTML + oUl.innerHTML;
        oUl.style.width = oLi[0].offsetWidth * oLi.length + "px"
        function move() {
            // alert(oUl.offsetLeft)
            oUl.style.left = oUl.offsetLeft + sppend + "px"
            if (parseInt(oUl.style.left) == -6756) {
                oUl.style.left = 0 + 'px';

            }

            if (oUl.offsetLeft > 0) {
                oUl.style.left = -5630 + 'px'
            }

        }
        clearTime = setInterval(move, 3000)
        oDiv.onmouseover = function() {
            clearInterval(clearTime);
            
        }
        oDiv.onmouseout = function() {
            clearTime = setInterval(move, 3000)
        }
    }
    runs();
    {/literal}
    </script>
    	
    <script type="text/javascript">
    {literal}
    $(function() {
    	$('.quick_links_wrap').hide();
        var sWidth = $("#focus").width(); //获取焦点图的宽度（显示面积）
        var len = $("#focus ul li").length; //获取焦点图个数
        var index = 0;
        var picTimer;

        //以下代码添加数字按钮和按钮后的半透明条，还有上一页、下一页两个按钮
        //var btn = "<div class='btnBg'></div><div class='btn'>";
        var btn = "<div class='btn'>";
        for (var i = 0; i < len; i++) {
            btn += "<span></span>";
        }
        btn += "</div><div class='preNext pre'></div><div class='preNext next'></div>";
        $("#focus").parents(".b_banner").append(btn);
        // $("#focus .btnBg").css("opacity",0.5);

        //为小按钮添加鼠标滑入事件，以显示相应的内容
        $(".b_banner .btn span").css("opacity", 0.4).mouseover(function() {
            index = $(".b_banner .btn span").index(this);
            showPics(index);
        }).eq(0).trigger("mouseover");

        //上一页、下一页按钮透明度处理
        $(".b_banner .preNext").css("opacity", 0.2).hover(function() {
            $(this).stop(true, false).animate({
                "opacity": "0.5"
            }, 300);
        }, function() {
            $(this).stop(true, false).animate({
                "opacity": "0.2"
            }, 300);
        });

        //上一页按钮
        $(".b_banner .pre").click(function() {
            index -= 1;
            if (index == -1) {
                index = len - 1;
            }
            showPics(index);
        });

        //下一页按钮
        $(".b_banner .next").click(function() {
            index += 1;
            if (index == len) {
                index = 0;
            }
            showPics(index);
        });

        //本例为左右滚动，即所有li元素都是在同一排向左浮动，所以这里需要计算出外围ul元素的宽度
        $("#focus ul").css("width", sWidth * (len));

        //鼠标滑上焦点图时停止自动播放，滑出时开始自动播放
        $("#focus").hover(function() {
            clearInterval(picTimer);
        }, function() {
            picTimer = setInterval(function() {
                showPics(index);
                index++;
                if (index == len) {
                    index = 0;
                }
            }, 4000); //此4000代表自动播放的间隔，单位：毫秒
        }).trigger("mouseleave");

        //显示图片函数，根据接收的index值显示相应的内容
        function showPics(index) { //普通切换
            var nowLeft = -index * sWidth; //根据index值计算ul元素的left值
            $("#focus ul").stop(true, false).animate({
                "left": nowLeft
            }, 300); //通过animate()调整ul元素滚动到计算出的position
            //$("#focus .btn span").removeClass("on").eq(index).addClass("on"); //为当前的按钮切换到选中的效果
            $("#focus .btn span").stop(true, false).animate({
                "opacity": "0.4"
            }, 300).eq(index).stop(true, false).animate({
                "opacity": "1"
            }, 300); //为当前的按钮切换到选中的效果
        }
    });
    $(function() {
        var urladdress = window.location.href;

        if (urladdress.indexOf("qqcmo") > -1 || urladdress.indexOf("qqcca") > -1 || urladdress.indexOf("qqcff") > -1) {
            $("#realAccount").attr({
                action: 'http://www.ZL1616.com/MarketCreateRealAccount.htm'
            });
        }
    })
    {/literal}
    </script>
    <script> 
    	{literal}
    		(function() {var _53code = document.createElement("script");_53code.src = "https://tb.53kf.com/code/code/10138776/1";var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(_53code, s);})();
        {/literal}
    </script>
    <style type="text/css">
    {literal}
    .quick_links_wrap{display:none!important;}
    {/literal}
    </style>