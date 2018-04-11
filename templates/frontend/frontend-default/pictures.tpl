<link type="text/css" rel="stylesheet" href="/templates/frontend/frontend-default/css/new.css?t=20150923" />
<div class="container">
	<div class="row">
		<div class="col-md-3 col-sm-4">
			{include file='category.tpl'}
			<div class="ad-body">
				<div class="adv-pc"></div>
			</div>
		</div>
		<div class="col-md-9 col-sm-8">
				<div class="well well-filters new_filters">
							<div class="pull-left">
								<h4><i class="fa fa-clock-o green"></i>&nbsp;{if $category == 0}{t c='global.pictures'}{else}{$category_in_name[$category]}{/if}</h4>
							</div>
							<div class="pull-right m-l-20">
								<div class="hidden-xs">
									<div class="btn-group">
										<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">{if $type == ''}{t c='global.type'}{elseif $type == 'public'}{t c='global.public'}{else}{t c='global.private'}{/if} <span class="caret"></span></button>
										<ul class="dropdown-menu">
											<li {if $type == ''}class="active"{/if}><a href="{url base='pictures' strip='type' value=''}">{t c='global.all'}</a></li>
											<li {if $type == 'public'}class="active"{/if}><a href="{url base='pictures' strip='type' value='public'}">{t c='global.public'}</a></li>
											<li {if $type == 'private'}class="active"{/if}><a href="{url base='pictures' strip='type' value='private'}">{t c='global.private'}</a></li>
										</ul>
									</div>

									<div class="btn-group">
										<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">{if $timeframe == 'a'}{t c='global.all'}{elseif $timeframe == 't'}{t c='global.added'} {t c='global.today'}{elseif $timeframe == 'w'}{t c='global.added'} {t c='global.this_week'}{else}{t c='global.added'} {t c='global.this_month'}{/if} <span class="caret"></span></button>
										<ul class="dropdown-menu">
											<li {if $timeframe == 'a'}class="active"{/if}><a href="{url base='pictures' strip='t' value='a'}">{t c='global.all'}</a></li>
											<li {if $timeframe == 't'}class="active"{/if}><a href="{url base='pictures' strip='t' value='t'}">{t c='global.added'} {t c='global.today'}</a></li>
											<li {if $timeframe == 'w'}class="active"{/if}><a href="{url base='pictures' strip='t' value='w'}">{t c='global.added'} {t c='global.this_week'}</a></li>
											<li {if $timeframe == 'm'}class="active"{/if}><a href="{url base='pictures' strip='t' value='m'}">{t c='global.added'} {t c='global.this_month'}</a></li>
										</ul>
									</div>
									<div class="btn-group">
										<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">{if $order == 'bw'}{t c='global.mores'}{elseif $order == 'mr'}{t c='global.most_recent'}{elseif $order == 'mv'}{t c='global.most_viewed'}{elseif $order == 'tr'}{t c='global.top_rated'}{elseif $order == 'md'}{t c='global.most_commented'}{elseif $order == 'tf'}{t c='global.top_favorites'}{else}{t c='global.longest'}{/if} <span class="caret"></span></button>
										<ul class="dropdown-menu">
											<li {if $order == 'bw'}class="active"{/if}><a href="{url base='pictures' strip='o' value='bw'}">{t c='global.mores'}</a></li>
											<li {if $order == 'mr'}class="active"{/if}><a href="{url base='pictures' strip='o' value='mr'}">{t c='global.most_recent'}</a></li>
											<li {if $order == 'mv'}class="active"{/if}><a href="{url base='pictures' strip='o' value='mv'}">{t c='global.most_viewed'}</a></li>
										</ul>
									</div>
								</div>
								<div class="visible-xs">
									<div class="btn-group">
										<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Filters <span class="caret"></span></button>
										<ul class="dropdown-menu">
											<li {if $type == ''}class="active"{/if}><a href="{url base='pictures' strip='type' value=''}">{t c='global.all'}</a></li>
											<li {if $type == 'public'}class="active"{/if}><a href="{url base='pictures' strip='type' value='public'}">{t c='global.public'}</a></li>
											<li {if $type == 'private'}class="active"{/if}><a href="{url base='pictures' strip='type' value='private'}">{t c='global.private'}</a></li>
											<li class="divider"></li>
											<li {if $timeframe == 'a'}class="active"{/if}><a href="{url base='pictures' strip='t' value='a'}">{t c='global.all'}</a></li>
											<li {if $timeframe == 't'}class="active"{/if}><a href="{url base='pictures' strip='t' value='t'}">{t c='global.added'} {t c='global.today'}</a></li>
											<li {if $timeframe == 'w'}class="active"{/if}><a href="{url base='pictures' strip='t' value='w'}">{t c='global.added'} {t c='global.this_week'}</a></li>
											<li {if $timeframe == 'm'}class="active"{/if}><a href="{url base='pictures' strip='t' value='m'}">{t c='global.added'} {t c='global.this_month'}</a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="pull-right" style="display: none;">
								<a class="btn btn-primary" href="{$relative}/upload/video"><span class="hidden-xs"><i class="fa fa-upload"></i> {t c='videos.upload'}</span><span class="visible-xs"><i class="fa fa-upload"></i></span></a>
							</div>
							<div class="clearfix"></div>
					</div>

		            {if $pictures}
					<div class="well well-sm" style="display: none;">
						{t c='global.showing'} <span class="text-white">{$start_num}</span> {t c='global.to'} <span class="text-white">{$end_num}</span> {t c='global.of'} <span class="text-white">{$pictures_total}</span> {t c='pictures.pictures'}.
					</div>
					<div class="row row-boder">
		            {section name=i loop=$pictures}
						<div class="col-sm-6 col-md-4 col-lg-4 img-cont" style="border: 1px solid #d1d1d1;padding: 10px;margin-bottom:10px;background-color:#fff;border-radius:5px;">
							<a href="{$relative}/picture/{$pictures[i].VID}/">
								 <img src="{insert name=thumb_img pid=$pictures[i].VID}" style="height:132px;" title="{$pictures[i].title|escape:'html'}" alt="{$pictures[i].title|escape:'html'}" class="img-responsive {if $pictures[i].privacy == 'private'}img-private{/if}"/>
							</a>
							<p class="first" style="text-align: center;font-size: 18px;padding: 8px;"><a href="{$relative}/picture/{$pictures[i].VID}/" style="font-size:16px;font-weight:bolder;">{$pictures[i].title|escape:'html'|msubstr:0:10}</a></p>
							<div class="clearfix"></div>
							<p class="second" style="font-size: 14px;">
								<span style="float: right;">加入时间：{insert name=time_range assign=addtime time=$pictures[i].addtime}{$addtime}</span>类型：{insert name=category_name assign=categoryname cate=$category_in_name ids=$pictures[i].category_id}{$categoryname}
							</p>
        					<div class="clearfix"></div>
        					<p class="three" style="font-size:15px;padding:5px;"><span style="float:right;"><img style="margin-right:5px;" src="/images/cont-right_03.jpg" alt="" /><b>{if $pictures[i].total_imgs == 0}-{else}{$pictures[i].total_imgs}P{/if}</span><img style="margin-right:5px;" src="/images/cont-left_03.jpg">{$pictures[i].viewnumber}</p>
						</div>
		            {/section}

					</div>
		            {else}
					<div class="well well-sm">
						<span class="text-danger">{t c='picture.no_pictures_found'}.</span>
					</div>
		            {/if}


					{if $pictures}
						{if $page_link}
							<div style="text-align: center;" class="hidden-xs">
								<ul class="pagination">{$page_link}</ul>
							</div>
						{/if}
					{/if}

					{if $pictures}
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
</div>