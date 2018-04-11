<div class="list-group">
	<a href="{url base='picture' strip='c' value=""}" class="list-group-item header">
		图片分类
	</a>
	{section name=i loop=$categories}
		<a id="categories_class_{$categories[i].CHID}" href="{url base='pictures' strip='c' value=$categories[i].CHID}" {if $category == $categories[i].CHID}class="list-group-item active"{else}class="list-group-item"{/if}>
		{$categories[i].name} <i class="total_videos pull-right">{$categories[i].totals}</i>
		</a>
	{/section}
</div>
