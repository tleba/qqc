<html><head lang="en">                          
    <meta charset="UTF-8">
    <title>双诞（旦）福利：领变大红包0元获取VIP</title>
    <meta name="viewport" content="width=device-width,target-densitydpi=high-dpi,initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no">
    <link href="css/mcommon.css" rel="stylesheet" type="text/css">
    <link href="css/mindex.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/mstyle.css"/>
     <script src="js/modernizr.js"></script>
</head>
<body>
    <section id="layout">
        <section class="page-wrapper">
                <section id="content">
                    <div id="content_page">
                        <div id="page1">
                        {if $isstart == 2}
				            <div class="tc " role="alert">
								<div class="w-870 cd-popup-container tc-container">
									<img src="images/m/hongbao2.png"/>
									<a class="aa fl" href="/qhd/hongbao/bian.php?a=increase&uid={$uid}"></a>
									<a class="aa fr" href="/qhd/hongbao/"></a>
						            <a href="#0" class="cd-popup-close img-replace">Close</a>
								</div>
				            </div>
				        {/if}
                        	<div class="banner"><a href=""><img src="images/m/banner.jpg" alt="" /></a></div>
                        	<div class="chai"><a href="{if $isstart == 0 || $isstart==1}javascript:void(0);{/if}" onclick="{if $isstart == 0}alert('对不起，此活动目前不可用!');{elseif $isstart == 1}alert('对不起，您还未登陆！请先登陆后再来操作');window.location.href='/login';{/if}"><img src="images/m/chai.jpg"/></a></div>
                        	<div class="a"><img src="images/m/01.jpg"/><span>好友红包  共累计 <font class="hong">{$totalamount}</font> 元（含领取{$amount}元）</span>
                           <ul>
                        	{section name=i loop=$hbarr}
                        	<li>
								<font class="s1">{$hbarr[i].username}</font>
								<font class="s2">{$hbarr[i].bamount}元</font>
								{insert name=time_range assign=strtime time=$hbarr[i].rtime}
								<font class="s3">{$strtime}</font>
							</li>
							{/section}		
							</ul>
                        	</div>
                        	<div class="b"><img src="images/m/02.jpg"/>
                        <ul>
                {section name=i loop=$hdresult}
				<li>
					<span class="s1">{$hdresult[i].username}	</span>
					<span class="s2">红包金额{$hdresult[i].total}</span>
					<span class="s3">{$hdresult[i].money}元购买VIP视频</span>
				</li>
				{/section}
			</ul>
                        	</div>
                        	<div class="c"><img src="images/m/03.jpg" alt="" />
                        	<marquee direction="up" class="list_con"  scrollamount="3" >
                        	<ul>
{section name=i loop=$nhbarr}
				{insert name=time_range assign=strtime time=$nhbarr[i].rtime}
				<li><span class="s5 fl">{$nhbarr[i].username}帮助红包变大<font class="huang">{$nhbarr[i].bamount}元</font></span><span class="s6 fr">{$strtime}</span></li>
			{/section}
			</ul></marquee>
                        	</div>
                        	<div class="d"><img src="images/m/04.jpg"/></div>
                        	<div class="e"><img src="images/m/05.jpg"/></div>
                        </div>
                        <!--<div id="page2">page2</div>
                        <div id="page3">page3</div>
                        <div id="page4">page4</div>-->
                    </div>
                </section>
            </section>
        </section>
    </section>

<script src="js/jquery.1.11.1.js"></script>
<script src="js/main.js"></script>
	</body>
	</html>
