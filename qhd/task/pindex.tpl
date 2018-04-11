{include file="header.tpl"}
<link rel="stylesheet" href="css/pindex.css?t=32">
<div class="video-body">
	<div class="people">
		<div class="money">
			<span>您当前游戏账户的筹码：<b>{$balance}</b></span>
		</div>
	</div>

	<div class="content">
		<ul class="title">
			<li>游戏任务</li>
			<li>游戏奖励</li>
			<li>兑换</li>
		</ul>
		{section name=i loop=$rows}
		<ul class="disxq">
			<li>{$rows[i].tname}</li>
			<li>{$rows[i].prize}</li>
			{if $rows[i].isreceive == 1}
				<li class="lj"><span class="gray">已领取</span></li>
			{elseif $rows[i].isreceive == 3}
				<li class="lj"><span class="ok" style="background:#FF0000;">已兑换</span></li>
			{else}
				{if $rows[i].isreceive == 2}
				<li class="lj"><span class="yellow" onclick="actionStatus('{$rows[i].isreceive}',this,'{$rows[i].id}')">领奖</span></li>
				{else}
				<li class="lj"><span class="blue" onclick="actionStatus('{$rows[i].isreceive}')">领奖</span></li>
				{/if}
			{/if}
		</ul>
		{/section}
		<ul class="open">
			<a href="http://www.dd00d.net/"><img src="images/popen_03.jpg"></a>
		</ul>
	</div>
	<div class="end">
		
	</div>
</div>
{include file="footer.tpl"}
<div class="pop">
	<p class="title">提示<span id="close">x</span></p>
	<p class="text">非常抱歉您尚未完成游戏任务。立即进入游戏做任务！</p>
	<a onclick="$('#close').click();" href="http://www.dd00d.net/" target="_blank">进入游戏</a>
</div>
</body>
{literal}
<style type="text/css">
	#wrapper{padding-bottom:0!important;min-height:0;}
	.navbar{margin:0;}
	.ps-body{
		display:none;
	}
</style>
<script type="text/javascript">
	function actionStatus(status,obj,id){
		if(status == -1){
			alert('您还未登陆，请先登陆！');
			window.location.href = '/login';
		}else{
			if(status == 0){
				$(".pop").show();
			}else if(status == 2){
				$.post('/qhd/task/index.php',{'a':'exchange','id':id},function(d){
					if(d){
						if(d.code == 1){
							if(d.task_isfirst == 1){
								$(".pop").show();
							}else
								alert(d.msg);
							$(obj).removeClass('yellow').addClass('gray').unbind('click').html('已领取');
						}else{
							alert(d.msg);
						}
					}else{
						alert('未知错误');
					}
				},'json');
				
			}
		}
	}
	$(function(){
		$("#close").click(function(){
			$(this).parents(".pop").hide();
		})
	})
</script>
{/literal}
</html>