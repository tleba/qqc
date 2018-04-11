<div class="list-group" style="margin-bottom:0px;">
<!--Mobile-->
<div class="header visible-mo" style="background-color:#1bbc9d;border-color:#1bbc9d;color:white;display:none\9;">
	<a href="{url base='videos' strip='c' value=""}" class="list-group-item" style="background-color:#1bbc9d;border-color:#1bbc9d;color:white;">
		<i class="fa fa-list-alt"></i>&nbsp;视频分类
	</a>
	<a style="display: block;float: right;padding: 10px 15px;color: white;font-weight: bold;font-size:20px;" showorhide="0" onclick="showOrHide(this);"><img src="/templates/frontend/frontend-default/img/aaOn.png" style="width:18px;"/></a>
<div style="clear:both;"></div>
	</div>
<!--Mobile-->
	<a href="{url base='videos' strip='c' value=""}" class="list-group-item header visible-pc">
		<i class="fa fa-list-alt"></i>&nbsp;视频分类
	</a>
	{section name=i loop=$categories}
	{if $categories[i].num > 6}
		<a id="categories_class_{$categories[i].CHID}" {if $categories[i].CHID == 63 || $categories[i].CHID == 65}href="{url base='yinshi' strip='c' value=$categories[i].CHID}" {else /}href="{url base='videos' strip='c' value=$categories[i].CHID}"{/if} {if $category == $categories[i].CHID}class="active_list list-group-item active"{else}class="active_list list-group-item"{/if}>
		{$categories[i].name} <i class="total_videos pull-right">{$categories[i].num}</i>
		</a>
	{/if}
	{/section}
</div>
 <script type="text/javascript">
 {literal}
function showOrHide(obj){
	var sh  = $(obj).attr('showorhide');
	if(sh == 1){
		$('.active_list').hide();
		$(obj).attr('showorhide',0);
		$(obj).html('<img src="/templates/frontend/frontend-default/img/aaOn.png" style="width:18px;"/>');
	}
	if(sh == 0){
		$('.active_list').show();
		$(obj).attr('showorhide',1);
		$(obj).html('<img src="/templates/frontend/frontend-default/img/aaOff.png" style="width:18px;"/>');
	}
}
{/literal}
</script>