
		{include file="header.tpl"}
		<link rel="stylesheet" type="text/css" href="css/index.css?t=18">
	
	<div class="wapper">
		<div class="pop">
			<p class="title">提示<span id="close">x</span></p>
			<p class="text">非常抱歉您尚未完成游戏任务。立即进入游戏做任务！</p>
			<a onclick="$('#close').click();" href="http://www.dd00d.net/" target="_blank">进入游戏</a>
		</div>
		<div class="cm">
				<span>您当前游戏账户的游戏筹码：</span>
				<b>{$balance}</b>
			</div>
		<div class="tableContent">
			<ul class="tabcontent" style="height:425px;">
			{section name=i loop=$rows}
				<li>
					<ul>
						<li class="renwu">{$rows[i].tname}</li>
						<li class="jl">{$rows[i].prize}</li>
						{if $rows[i].isreceive == 1}
							<li class="lj"><span class="gray">已领取</span></li>
						{elseif $rows[i].isreceive == 3}
							<li class="lj"><span class="gray" style="background:#FF0000;">已兑换</span></li>
						{else}
							{if $rows[i].isreceive == 2}
							<li class="lj"><span class="yellow" onclick="actionStatus('{$rows[i].isreceive}',this,'{$rows[i].id}')">领奖</span></li>
							{else}
							<li class="lj"><span class="blue" onclick="actionStatus('{$rows[i].isreceive}')">领奖</span></li>
							{/if}
						{/if}
					</ul>
				</li>
			{/section}
			<div style="clear:both;"></div>
			</ul>
			<a href="http://www.dd00d.net/" target="_blank"> </a>
		</div>
	</div>
	<div>
	{include file="footer.tpl"}
</body>
{literal}
<style type="text/css">
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