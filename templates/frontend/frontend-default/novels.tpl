<link type="text/css" rel="stylesheet" href="/templates/frontend/frontend-default/css/new.css?v=2015080915037"/>
<div class="container">
	<div class="row cont">
		<div class="col-md-3 col-sm-4">
			{include file='category_novel.tpl'}
			<div class="ad-body">
				<div class="adv-pc"></div>
			</div>
		</div>
		<div class="col-md-9 col-sm-8">
				<div class="well well-filters new_filters">
							<div class="pull-left">
								<h4><i class="fa fa-clock-o green"></i>&nbsp;{t c='global.pictures'}</h4>
							</div>
							<div class="pull-right m-l-20">
								<div class="hidden-xs">
									<div class="btn-group">
										<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">{if $type == ''}{t c='global.type'}{elseif $type == 'public'}{t c='global.public'}{else}{t c='global.private'}{/if} <span class="caret"></span></button>
										<ul class="dropdown-menu">
											<li {if $type == ''}class="active"{/if}><a href="{url base='novels' strip='type' value=''}">{t c='global.all'}</a></li>
											<li {if $type == 'public'}class="active"{/if}><a href="{url base='novels' strip='type' value='public'}">{t c='global.public'}</a></li>
											<li {if $type == 'private'}class="active"{/if}><a href="{url base='novels' strip='type' value='private'}">{t c='global.private'}</a></li>
										</ul>
									</div>

									<div class="btn-group">
										<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">{if $timeframe == 'a'}{t c='global.all'}{elseif $timeframe == 't'}{t c='global.added'} {t c='global.today'}{elseif $timeframe == 'w'}{t c='global.added'} {t c='global.this_week'}{else}{t c='global.added'} {t c='global.this_month'}{/if} <span class="caret"></span></button>
										<ul class="dropdown-menu">
											<li {if $timeframe == 'a'}class="active"{/if}><a href="{url base='novels' strip='t' value='a'}">{t c='global.all'}</a></li>
											<li {if $timeframe == 't'}class="active"{/if}><a href="{url base='novels' strip='t' value='t'}">{t c='global.added'} {t c='global.today'}</a></li>
											<li {if $timeframe == 'w'}class="active"{/if}><a href="{url base='novels' strip='t' value='w'}">{t c='global.added'} {t c='global.this_week'}</a></li>
											<li {if $timeframe == 'm'}class="active"{/if}><a href="{url base='novels' strip='t' value='m'}">{t c='global.added'} {t c='global.this_month'}</a></li>
										</ul>
									</div>
									<div class="btn-group">
										<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">{if $order == 'mr'}{t c='global.most_recent'}{elseif $order == 'mv'}{t c='global.most_viewed'}{elseif $order == 'tr'}{t c='global.top_rated'}{elseif $order == 'md'}{t c='global.most_commented'}{elseif $order == 'tf'}{t c='global.top_favorites'}{else}{t c='global.longest'}{/if} <span class="caret"></span></button>
										<ul class="dropdown-menu">
											<li {if $order == 'mr'}class="active"{/if}><a href="{url base='novels' strip='o' value='mr'}">{t c='global.most_recent'}</a></li>
											<li {if $order == 'mv'}class="active"{/if}><a href="{url base='novels' strip='o' value='mv'}">{t c='global.most_viewed'}</a></li>
										</ul>
									</div>
								</div>
								<div class="visible-xs">
									<div class="btn-group">
										<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Filters <span class="caret"></span></button>
										<ul class="dropdown-menu">
											<li {if $type == ''}class="active"{/if}><a href="{url base='novels' strip='type' value=''}">{t c='global.all'}</a></li>
											<li {if $type == 'public'}class="active"{/if}><a href="{url base='novels' strip='type' value='public'}">{t c='global.public'}</a></li>
											<li {if $type == 'private'}class="active"{/if}><a href="{url base='novels' strip='type' value='private'}">{t c='global.private'}</a></li>
											<li class="divider"></li>
											<li {if $timeframe == 'a'}class="active"{/if}><a href="{url base='novels' strip='t' value='a'}">{t c='global.all'}</a></li>
											<li {if $timeframe == 't'}class="active"{/if}><a href="{url base='novels' strip='t' value='t'}">{t c='global.added'} {t c='global.today'}</a></li>
											<li {if $timeframe == 'w'}class="active"{/if}><a href="{url base='novels' strip='t' value='w'}">{t c='global.added'} {t c='global.this_week'}</a></li>
											<li {if $timeframe == 'm'}class="active"{/if}><a href="{url base='novels' strip='t' value='m'}">{t c='global.added'} {t c='global.this_month'}</a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="pull-right" style="display: none;">
								<a class="btn btn-primary" href="{$relative}/upload/video"><span class="hidden-xs"><i class="fa fa-upload"></i> {t c='videos.upload'}</span><span class="visible-xs"><i class="fa fa-upload"></i></span></a>
							</div>
							<div class="clearfix"></div>
					</div>

		            {if $novels}
					<div class="well well-sm" style="display: none;">
						{t c='global.showing'} <span class="text-white">{$start_num}</span> {t c='global.to'} <span class="text-white">{$end_num}</span> {t c='global.of'} <span class="text-white">{$novels_total}</span> {t c='pictures.pictures'}.
					</div>
					<div class="right" style="background-color:none;padding-bottom:10px;">
					<div class="cont-ad">
					<!--<script type="text/javascript" src="{$baseurl}/ads/adv.js?pos=59"></script>-->
					<div class="ads_59"></div>
					</div>
		            {section name=i loop=$novels}
			            <div class="list-novels list">
				            <p class="list-first">
				            <a href="{$relative}/novel/{$novels[i].VID}/">{$novels[i].title}</a></p>
				            <p class="list-second"> 加入：{insert name=time_range assign=addtime time=$novels[i].addtime}{$addtime} 类型：{insert name=category_name assign=categoryname cate=$category_in_name ids=$novels[i].category_id}{$categoryname} 查看：{$novels[i].viewnumber}</p>
				            <p class="list-three">
				            	{$novels[i].content|msubstr:0:300}。。。
				             </p>
			             	<p class="list-end"><a href="{$relative}/novel/{$novels[i].VID}/" style="font-size:15px;">点击这里阅读全文</a></p>
						</div>
		            {/section}
						<div class="cont-ad">
						<!--<script type="text/javascript" src="{$baseurl}/ads/adv.js?pos=63"></script>-->
						<div class="ads_63"></div>
						</div>
					</div>
		            {else}
					<div class="well well-sm">
						<span class="text-danger">{t c='picture.no_pictures_found'}.</span>
					</div>
		            {/if}

					{if $novels}
						{if $page_link}
							<div style="text-align: center;" class="hidden-xs">
								<ul class="pagination">{$page_link}</ul>
							</div>
						{/if}
					{/if}

					{if $novels}
						{if $page_link}
							<div style="text-align: center;" class="visible-xs">
								<ul class="pagination pagination-lg">{$page_link}</ul>
							</div>
						{/if}
					{/if}

				</div>


	</div>


	<div class="ad-body">
		<p class="ad-title">{t c='global.sponsors'}</p>
	</div>

<div class="clearfix"></div>