{include file="header.tpl"}
<link rel="stylesheet" href="/css/index.css" />
{literal}
 <script>
    /*$(function(){
        $(".delt").click(function(){
          $(".zc").hide();
        })
    });*/
    $(".footer-container").css('position', 'relative');
</script>
{/literal}
{include file="errors.tpl"}
<!--
<div class="zc" style="margin-top: -15px;">
    <img src="/img/zc.jpg">
    <div class="left"><a href="/yamei/vip/index.html"></a></div>
    <div class="right"><a href="{ $bbs }"></a></div>
    <div class="delt"></div>
</div>-->
<div class="container">
    <div class="well well-filters new_filters">
            <div class="pull-left">
                <h4><i class="fa fa-thumbs-o-up green"></i>&nbsp;本站推荐的视频</h4>
            </div>

            <div class="pull-right btn-line-height m-l-20">
                <a class="btn btn-primary" href="{$relative}/videos?o=mr"><span class="hidden-xs"><i class="fa fa-plus"></i> {translate c='index.most_recent_videos_more'}</span><span class="visible-xs"><i class="fa fa-plus"></i></span></a>
            </div>

            <div class="pull-right m-l-20">
                            <div class="hidden-xs">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">{if $type == ''}{t c='global.type'}{elseif $type == 'public'}{t c='global.public'}{else}{t c='global.private'}{/if} <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li {if $type == ''}class="active"{/if}><a href="{url base='videos' strip='type' value=''}">{t c='global.all'}</a></li>
                                        <li {if $type == 'public'}class="active"{/if}><a href="{url base='videos' strip='type' value='public'}">{t c='global.public'}</a></li>
                                        <li {if $type == 'private'}class="active"{/if}><a href="{url base='videos' strip='type' value='private'}">{t c='global.private'}</a></li>
                                    </ul>
                                </div>

                                <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">{if $timeframe == 'a'}{t c='global.timeline'}{elseif $timeframe == 't'}{t c='global.added'} {t c='global.today'}{elseif $timeframe == 'w'}{t c='global.added'} {t c='global.this_week'}{else}{t c='global.added'} {t c='global.this_month'}{/if} <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li {if $timeframe == 'a'}class="active"{/if}><a href="{url base='videos' strip='t' value='a'}">{t c='global.all'}</a></li>
                                        <li {if $timeframe == 't'}class="active"{/if}><a href="{url base='videos' strip='t' value='t'}">{t c='global.added'} {t c='global.today'}</a></li>
                                        <li {if $timeframe == 'w'}class="active"{/if}><a href="{url base='videos' strip='t' value='w'}">{t c='global.added'} {t c='global.this_week'}</a></li>
                                        <li {if $timeframe == 'm'}class="active"{/if}><a href="{url base='videos' strip='t' value='m'}">{t c='global.added'} {t c='global.this_month'}</a></li>
                                    </ul>
                                </div>

                                <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">{if $order == 'bw'}{t c='global.being_watched'}{elseif $order == 'mr'}{t c='global.most_recent'}{elseif $order == 'mv'}{t c='global.most_viewed'}{elseif $order == 'tr'}{t c='global.top_rated'}{elseif $order == 'md'}{t c='global.most_commented'}{elseif $order == 'tf'}{t c='global.top_favorites'}{else}{t c='global.longest'}{/if} <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li {if $order == 'bw'}class="active"{/if}><a href="{url base='videos' strip='o' value='bw'}">{t c='global.being_watched'}</a></li>
                                        <li {if $order == 'mr'}class="active"{/if}><a href="{url base='videos' strip='o' value='mr'}">{t c='global.most_recent'}</a></li>
                                        <li {if $order == 'mv'}class="active"{/if}><a href="{url base='videos' strip='o' value='mv'}">{t c='global.most_viewed'}</a></li>
                                        <li {if $order == 'md'}class="active"{/if}><a href="{url base='videos' strip='o' value='md'}">{t c='global.most_commented'}</a></li>
                                        <li {if $order == 'tr'}class="active"{/if}><a href="{url base='videos' strip='o' value='tr'}">{t c='global.top_rated'}</a></li>
                                        <li {if $order == 'tf'}class="active"{/if}><a href="{url base='videos' strip='o' value='tf'}">{t c='global.top_favorites'}</a></li>
                                        <li {if $order == 'lg'}class="active"{/if}><a href="{url base='videos' strip='o' value='lg'}">{t c='global.longest'}</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="visible-xs">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Filters <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li {if $type == ''}class="active"{/if}><a href="{url base='videos' strip='type' value=''}">{t c='global.all'}</a></li>
                                        <li {if $type == 'public'}class="active"{/if}><a href="{url base='videos' strip='type' value='public'}">{t c='global.public'}</a></li>
                                        <li {if $type == 'private'}class="active"{/if}><a href="{url base='videos' strip='type' value='private'}">{t c='global.private'}</a></li>
                                        <li class="divider"></li>
                                        <li {if $timeframe == 'a'}class="active"{/if}><a href="{url base='videos' strip='t' value='a'}">{t c='global.all'}</a></li>
                                        <li {if $timeframe == 't'}class="active"{/if}><a href="{url base='videos' strip='t' value='t'}">{t c='global.added'} {t c='global.today'}</a></li>
                                        <li {if $timeframe == 'w'}class="active"{/if}><a href="{url base='videos' strip='t' value='w'}">{t c='global.added'} {t c='global.this_week'}</a></li>
                                        <li {if $timeframe == 'm'}class="active"{/if}><a href="{url base='videos' strip='t' value='m'}">{t c='global.added'} {t c='global.this_month'}</a></li>
                                        <li class="divider"></li>
                                        <li {if $order == 'bw'}class="active"{/if}><a href="{url base='videos' strip='o' value='bw'}">{t c='global.being_watched'}</a></li>
                                        <li {if $order == 'mr'}class="active"{/if}><a href="{url base='videos' strip='o' value='mr'}">{t c='global.most_recent'}</a></li>
                                        <li {if $order == 'mv'}class="active"{/if}><a href="{url base='videos' strip='o' value='mv'}">{t c='global.most_viewed'}</a></li>
                                        <li {if $order == 'md'}class="active"{/if}><a href="{url base='videos' strip='o' value='md'}">{t c='global.most_commented'}</a></li>
                                        <li {if $order == 'tr'}class="active"{/if}><a href="{url base='videos' strip='o' value='tr'}">{t c='global.top_rated'}</a></li>
                                        <li {if $order == 'tf'}class="active"{/if}><a href="{url base='videos' strip='o' value='tf'}">{t c='global.top_favorites'}</a></li>
                                        <li {if $order == 'lg'}class="active"{/if}><a href="{url base='videos' strip='o' value='lg'}">{t c='global.longest'}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

            <div class="clearfix"></div>
    </div>

    <div class="row row-boder">
        <div class="col-md-12">
            {if $featured_videos}
            <div class="row">
            {section name=i loop=$featured_videos}

                <div class="col-sm-4 col-md-3 col-lg-3">
                    <div class="well well-sm">
                        <a href="{$relative}/video/{$featured_videos[i].VID}/{$featured_videos[i].title|clean}">
                            <div class="thumb-overlay">
                                <img src="{insert name=thumb_path vid=$featured_videos[i].VID}/{$featured_videos[i].thumb}.jpg" title="{$featured_videos[i].title|escape:'html'}" alt="{$featured_videos[i].title|escape:'html'}" id="rotate_{$featured_videos[i].VID}_{$featured_videos[i].thumbs}_{$featured_videos[i].thumb}_recent" class="img-responsive {if $featured_videos[i].type == 'private'}{/if}"/>
                                {if $featured_videos[i].type == 'public'}<div class="label-private">{t c='global.PRIVATE'}</div>{else}<div class="label-vip">&nbsp;</div>{/if}
                                {if $featured_videos[i].hd==1}<div class="hd-text-icon">HD</div>{/if}
                                <div class="duration">
                                    {insert name=duration assign=duration duration=$featured_videos[i].duration}
                                    {$duration}
                                </div>
                            </div>
                            <span class="video-title title-truncate m-t-5">{$featured_videos[i].title|escape:'html'}</span>
                        </a>
                        <div class="video-added">
                            {insert name=time_range assign=addtime time=$featured_videos[i].addtime}
                            {$addtime}
                        </div>
                        <div class="video-views pull-left">
                            <i class="fa fa-eye"></i>&nbsp;{$featured_videos[i].viewnumber}
                        </div>
                        <div class="video-rating pull-right {if $featured_videos[i].rate == 0 && $featured_videos[i].dislikes == 0}no-rating{/if}">
                            <i class="fa fa-thumbs-up video-rating-heart {if $featured_videos[i].rate == 0 && $featured_videos[i].dislikes == 0}no-rating{/if}"></i> <b>{if $featured_videos[i].rate == 0 && $featured_videos[i].dislikes == 0}-{else}{$featured_videos[i].rate}%{/if}</b>
                        </div>
                        <div class="clearfix"></div>

                    </div>
                </div>

            {/section}
            </div>
            {else}
            <div class="well well-sm">
                <span class="text-danger">暂无推荐的视频！(标志为:featured).</span>
            </div>
            {/if}
        </div>
    </div>
    <div class="ad-body">

<div class="adv-pc">

<script type="text/javascript" src="{$baseurl}/ads/adv.js?pos=39"></script>

</div>

    </div>
    <div class="well well-filters new_filters">
    <div class="pull-left">
        <h4><i class="fa fa-clock-o green"></i>&nbsp;{translate c='index.most_recent_videos'}</h4>
    </div>

    <div class="pull-right btn-line-height m-l-20">
        <a class="btn btn-primary" href="{$relative}/videos?o=mr"><span class="hidden-xs"><i class="fa fa-plus"></i> {translate c='index.most_recent_videos_more'}</span><span class="visible-xs"><i class="fa fa-plus"></i></span></a>
    </div>

    <div class="pull-right m-l-20">
                    <div class="hidden-xs">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">{if $type == ''}{t c='global.type'}{elseif $type == 'public'}{t c='global.public'}{else}{t c='global.private'}{/if} <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li {if $type == ''}class="active"{/if}><a href="{url base='videos' strip='type' value=''}">{t c='global.all'}</a></li>
                                <li {if $type == 'public'}class="active"{/if}><a href="{url base='videos' strip='type' value='public'}">{t c='global.public'}</a></li>
                                <li {if $type == 'private'}class="active"{/if}><a href="{url base='videos' strip='type' value='private'}">{t c='global.private'}</a></li>
                            </ul>
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">{if $timeframe == 'a'}{t c='global.timeline'}{elseif $timeframe == 't'}{t c='global.added'} {t c='global.today'}{elseif $timeframe == 'w'}{t c='global.added'} {t c='global.this_week'}{else}{t c='global.added'} {t c='global.this_month'}{/if} <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li {if $timeframe == 'a'}class="active"{/if}><a href="{url base='videos' strip='t' value='a'}">{t c='global.all'}</a></li>
                                <li {if $timeframe == 't'}class="active"{/if}><a href="{url base='videos' strip='t' value='t'}">{t c='global.added'} {t c='global.today'}</a></li>
                                <li {if $timeframe == 'w'}class="active"{/if}><a href="{url base='videos' strip='t' value='w'}">{t c='global.added'} {t c='global.this_week'}</a></li>
                                <li {if $timeframe == 'm'}class="active"{/if}><a href="{url base='videos' strip='t' value='m'}">{t c='global.added'} {t c='global.this_month'}</a></li>
                            </ul>
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">{if $order == 'bw'}{t c='global.being_watched'}{elseif $order == 'mr'}{t c='global.most_recent'}{elseif $order == 'mv'}{t c='global.most_viewed'}{elseif $order == 'tr'}{t c='global.top_rated'}{elseif $order == 'md'}{t c='global.most_commented'}{elseif $order == 'tf'}{t c='global.top_favorites'}{else}{t c='global.longest'}{/if} <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li {if $order == 'bw'}class="active"{/if}><a href="{url base='videos' strip='o' value='bw'}">{t c='global.being_watched'}</a></li>
                                <li {if $order == 'mr'}class="active"{/if}><a href="{url base='videos' strip='o' value='mr'}">{t c='global.most_recent'}</a></li>
                                <li {if $order == 'mv'}class="active"{/if}><a href="{url base='videos' strip='o' value='mv'}">{t c='global.most_viewed'}</a></li>
                                <li {if $order == 'md'}class="active"{/if}><a href="{url base='videos' strip='o' value='md'}">{t c='global.most_commented'}</a></li>
                                <li {if $order == 'tr'}class="active"{/if}><a href="{url base='videos' strip='o' value='tr'}">{t c='global.top_rated'}</a></li>
                                <li {if $order == 'tf'}class="active"{/if}><a href="{url base='videos' strip='o' value='tf'}">{t c='global.top_favorites'}</a></li>
                                <li {if $order == 'lg'}class="active"{/if}><a href="{url base='videos' strip='o' value='lg'}">{t c='global.longest'}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="visible-xs">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Filters <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li {if $type == ''}class="active"{/if}><a href="{url base='videos' strip='type' value=''}">{t c='global.all'}</a></li>
                                <li {if $type == 'public'}class="active"{/if}><a href="{url base='videos' strip='type' value='public'}">{t c='global.public'}</a></li>
                                <li {if $type == 'private'}class="active"{/if}><a href="{url base='videos' strip='type' value='private'}">{t c='global.private'}</a></li>
                                <li class="divider"></li>
                                <li {if $timeframe == 'a'}class="active"{/if}><a href="{url base='videos' strip='t' value='a'}">{t c='global.all'}</a></li>
                                <li {if $timeframe == 't'}class="active"{/if}><a href="{url base='videos' strip='t' value='t'}">{t c='global.added'} {t c='global.today'}</a></li>
                                <li {if $timeframe == 'w'}class="active"{/if}><a href="{url base='videos' strip='t' value='w'}">{t c='global.added'} {t c='global.this_week'}</a></li>
                                <li {if $timeframe == 'm'}class="active"{/if}><a href="{url base='videos' strip='t' value='m'}">{t c='global.added'} {t c='global.this_month'}</a></li>
                                <li class="divider"></li>
                                <li {if $order == 'bw'}class="active"{/if}><a href="{url base='videos' strip='o' value='bw'}">{t c='global.being_watched'}</a></li>
                                <li {if $order == 'mr'}class="active"{/if}><a href="{url base='videos' strip='o' value='mr'}">{t c='global.most_recent'}</a></li>
                                <li {if $order == 'mv'}class="active"{/if}><a href="{url base='videos' strip='o' value='mv'}">{t c='global.most_viewed'}</a></li>
                                <li {if $order == 'md'}class="active"{/if}><a href="{url base='videos' strip='o' value='md'}">{t c='global.most_commented'}</a></li>
                                <li {if $order == 'tr'}class="active"{/if}><a href="{url base='videos' strip='o' value='tr'}">{t c='global.top_rated'}</a></li>
                                <li {if $order == 'tf'}class="active"{/if}><a href="{url base='videos' strip='o' value='tf'}">{t c='global.top_favorites'}</a></li>
                                <li {if $order == 'lg'}class="active"{/if}><a href="{url base='videos' strip='o' value='lg'}">{t c='global.longest'}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

    <div class="clearfix"></div>
</div>

<div class="row row-boder">
    <div class="col-sm-9 hidden-xs hidden-sm">
        {if $recent_videos}
        <div class="row">
        {section name=i loop=$recent_videos}

            <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="well well-sm">
                    <a href="{$relative}/video/{$recent_videos[i].VID}/{$recent_videos[i].title|clean}">
                        <div class="thumb-overlay">
                            <img src="{insert name=thumb_path vid=$recent_videos[i].VID}/{$recent_videos[i].thumb}.jpg" title="{$recent_videos[i].title|escape:'html'}" alt="{$recent_videos[i].title|escape:'html'}" id="rotate_{$recent_videos[i].VID}_{$recent_videos[i].thumbs}_{$recent_videos[i].thumb}_recent" class="img-responsive {if $recent_videos[i].type == 'private'}{/if}"/>
                            {if $recent_videos[i].type == 'public'}<div class="label-private">{t c='global.PRIVATE'}</div>{else}<div class="label-vip">&nbsp;</div>{/if}
                            {if $recent_videos[i].hd==1}<div class="hd-text-icon">HD</div>{/if}
                            <div class="duration">
                                {insert name=duration assign=duration duration=$recent_videos[i].duration}
                                {$duration}
                            </div>
                        </div>
                        <span class="video-title title-truncate m-t-5">{$recent_videos[i].title|escape:'html'}</span>
                    </a>
                    <div class="video-added">
                        {insert name=time_range assign=addtime time=$recent_videos[i].addtime}
                        {$addtime}
                    </div>
                    <div class="video-views pull-left">
                        <i class="fa fa-eye"></i>&nbsp;{$recent_videos[i].viewnumber}
                    </div>
                    <div class="video-rating pull-right {if $recent_videos[i].rate == 0 && $recent_videos[i].dislikes == 0}no-rating{/if}">
                        <i class="fa fa-thumbs-up video-rating-heart {if $recent_videos[i].rate == 0 && $recent_videos[i].dislikes == 0}no-rating{/if}"></i> <b>{if $recent_videos[i].rate == 0 && $recent_videos[i].dislikes == 0}-{else}{$recent_videos[i].rate}%{/if}</b>
                    </div>
                    <div class="clearfix"></div>

                </div>
            </div>


        {/section}


        </div>
        {else}
        <div class="well well-sm">
            <span class="text-danger">{t c='videos.no_videos_found'}.</span>
        </div>
        {/if}


    </div>

    <div class="col-sm-8 visible-xs visible-sm">
        {if $recent_videos}
        <div class="row">
        {section name=i loop=$recent_videos}

            <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="well well-sm">
                    <a href="{$relative}/video/{$recent_videos[i].VID}/{$recent_videos[i].title|clean}">
                        <div class="thumb-overlay">
                            <img src="{insert name=thumb_path vid=$recent_videos[i].VID}/{$recent_videos[i].thumb}.jpg" title="{$recent_videos[i].title|escape:'html'}" alt="{$recent_videos[i].title|escape:'html'}" id="rotate_{$recent_videos[i].VID}_{$recent_videos[i].thumbs}_{$recent_videos[i].thumb}_recent" class="img-responsive {if $recent_videos[i].type == 'private'}{/if}"/>
                            {if $recent_videos[i].type == 'public'}<div class="label-private">{t c='global.PRIVATE'}</div>{else}<div class="label-vip">&nbsp;</div>{/if}
                            {if $recent_videos[i].hd==1}<div class="hd-text-icon">HD</div>{/if}
                            <div class="duration">
                                {insert name=duration assign=duration duration=$recent_videos[i].duration}
                                {$duration}
                            </div>
                        </div>
                        <span class="video-title title-truncate m-t-5">{$recent_videos[i].title|escape:'html'}</span>
                    </a>
                    <div class="video-added">
                        {insert name=time_range assign=addtime time=$recent_videos[i].addtime}
                        {$addtime}
                    </div>
                    <div class="video-views pull-left">
                        <i class="fa fa-eye"></i>&nbsp;{$recent_videos[i].viewnumber}
                    </div>
                    <div class="video-rating pull-right {if $recent_videos[i].rate == 0 && $recent_videos[i].dislikes == 0}no-rating{/if}">
                        <i class="fa fa-thumbs-up video-rating-heart {if $recent_videos[i].rate == 0 && $recent_videos[i].dislikes == 0}no-rating{/if}"></i> <b>{if $recent_videos[i].rate == 0 && $recent_videos[i].dislikes == 0}-{else}{$recent_videos[i].rate}%{/if}</b>
                    </div>
                    <div class="clearfix"></div>

                </div>
            </div>


        {/section}


        </div>
        {else}
        <div class="well well-sm">
            <span class="text-danger">{t c='videos.no_videos_found'}.</span>
        </div>
        {/if}


    </div>



<div class="col-md-3 col-sm-4">

<div class="ad-body">

<div class="adv-pc">
    <div style="margin-bottom:20px;"><script type="text/javascript" src="{$baseurl}/ads/adv.js?pos=41"></script></div>
    <div><script type="text/javascript" src="{$baseurl}/ads/adv.js?pos=42"></script></div>
</div>

</div>

</div>


</div>


<div class="ad-body">

<div class="adv-pc">
<script type="text/javascript" src="{$baseurl}/ads/adv.js?pos=40"></script>
</div>

</div>



    <div class="well well-filters new_filters">
        <div class="pull-left">
            <h4><i class="fa fa-fire green"></i>&nbsp;最受欢迎的视频</h4>
        </div>

        <div class="pull-right btn-line-height m-l-20">
            <a class="btn btn-primary" href="{$relative}/videos?o=mr"><span class="hidden-xs"><i class="fa fa-plus"></i> {translate c='index.most_recent_videos_more'}</span><span class="visible-xs"><i class="fa fa-plus"></i></span></a>
        </div>

        <div class="pull-right m-l-20">
                        <div class="hidden-xs">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">{if $type == ''}{t c='global.type'}{elseif $type == 'public'}{t c='global.public'}{else}{t c='global.private'}{/if} <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li {if $type == ''}class="active"{/if}><a href="{url base='videos' strip='type' value=''}">{t c='global.all'}</a></li>
                                    <li {if $type == 'public'}class="active"{/if}><a href="{url base='videos' strip='type' value='public'}">{t c='global.public'}</a></li>
                                    <li {if $type == 'private'}class="active"{/if}><a href="{url base='videos' strip='type' value='private'}">{t c='global.private'}</a></li>
                                </ul>
                            </div>

                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">{if $timeframe == 'a'}{t c='global.timeline'}{elseif $timeframe == 't'}{t c='global.added'} {t c='global.today'}{elseif $timeframe == 'w'}{t c='global.added'} {t c='global.this_week'}{else}{t c='global.added'} {t c='global.this_month'}{/if} <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li {if $timeframe == 'a'}class="active"{/if}><a href="{url base='videos' strip='t' value='a'}">{t c='global.all'}</a></li>
                                    <li {if $timeframe == 't'}class="active"{/if}><a href="{url base='videos' strip='t' value='t'}">{t c='global.added'} {t c='global.today'}</a></li>
                                    <li {if $timeframe == 'w'}class="active"{/if}><a href="{url base='videos' strip='t' value='w'}">{t c='global.added'} {t c='global.this_week'}</a></li>
                                    <li {if $timeframe == 'm'}class="active"{/if}><a href="{url base='videos' strip='t' value='m'}">{t c='global.added'} {t c='global.this_month'}</a></li>
                                </ul>
                            </div>

                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">{if $order == 'bw'}{t c='global.being_watched'}{elseif $order == 'mr'}{t c='global.most_recent'}{elseif $order == 'mv'}{t c='global.most_viewed'}{elseif $order == 'tr'}{t c='global.top_rated'}{elseif $order == 'md'}{t c='global.most_commented'}{elseif $order == 'tf'}{t c='global.top_favorites'}{else}{t c='global.longest'}{/if} <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li {if $order == 'bw'}class="active"{/if}><a href="{url base='videos' strip='o' value='bw'}">{t c='global.being_watched'}</a></li>
                                    <li {if $order == 'mr'}class="active"{/if}><a href="{url base='videos' strip='o' value='mr'}">{t c='global.most_recent'}</a></li>
                                    <li {if $order == 'mv'}class="active"{/if}><a href="{url base='videos' strip='o' value='mv'}">{t c='global.most_viewed'}</a></li>
                                    <li {if $order == 'md'}class="active"{/if}><a href="{url base='videos' strip='o' value='md'}">{t c='global.most_commented'}</a></li>
                                    <li {if $order == 'tr'}class="active"{/if}><a href="{url base='videos' strip='o' value='tr'}">{t c='global.top_rated'}</a></li>
                                    <li {if $order == 'tf'}class="active"{/if}><a href="{url base='videos' strip='o' value='tf'}">{t c='global.top_favorites'}</a></li>
                                    <li {if $order == 'lg'}class="active"{/if}><a href="{url base='videos' strip='o' value='lg'}">{t c='global.longest'}</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="visible-xs">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Filters <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li {if $type == ''}class="active"{/if}><a href="{url base='videos' strip='type' value=''}">{t c='global.all'}</a></li>
                                    <li {if $type == 'public'}class="active"{/if}><a href="{url base='videos' strip='type' value='public'}">{t c='global.public'}</a></li>
                                    <li {if $type == 'private'}class="active"{/if}><a href="{url base='videos' strip='type' value='private'}">{t c='global.private'}</a></li>
                                    <li class="divider"></li>
                                    <li {if $timeframe == 'a'}class="active"{/if}><a href="{url base='videos' strip='t' value='a'}">{t c='global.all'}</a></li>
                                    <li {if $timeframe == 't'}class="active"{/if}><a href="{url base='videos' strip='t' value='t'}">{t c='global.added'} {t c='global.today'}</a></li>
                                    <li {if $timeframe == 'w'}class="active"{/if}><a href="{url base='videos' strip='t' value='w'}">{t c='global.added'} {t c='global.this_week'}</a></li>
                                    <li {if $timeframe == 'm'}class="active"{/if}><a href="{url base='videos' strip='t' value='m'}">{t c='global.added'} {t c='global.this_month'}</a></li>
                                    <li class="divider"></li>
                                    <li {if $order == 'bw'}class="active"{/if}><a href="{url base='videos' strip='o' value='bw'}">{t c='global.being_watched'}</a></li>
                                    <li {if $order == 'mr'}class="active"{/if}><a href="{url base='videos' strip='o' value='mr'}">{t c='global.most_recent'}</a></li>
                                    <li {if $order == 'mv'}class="active"{/if}><a href="{url base='videos' strip='o' value='mv'}">{t c='global.most_viewed'}</a></li>
                                    <li {if $order == 'md'}class="active"{/if}><a href="{url base='videos' strip='o' value='md'}">{t c='global.most_commented'}</a></li>
                                    <li {if $order == 'tr'}class="active"{/if}><a href="{url base='videos' strip='o' value='tr'}">{t c='global.top_rated'}</a></li>
                                    <li {if $order == 'tf'}class="active"{/if}><a href="{url base='videos' strip='o' value='tf'}">{t c='global.top_favorites'}</a></li>
                                    <li {if $order == 'lg'}class="active"{/if}><a href="{url base='videos' strip='o' value='lg'}">{t c='global.longest'}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

        <div class="clearfix"></div>
    </div>

    <div class="row row-boder">
        <div class="col-sm-12">
            {if $viewed_videos}
            <div class="row">
            {section name=i loop=$viewed_videos}

                <div class="col-sm-4 col-md-3 col-lg-3">
                    <div class="well well-sm">
                        <a href="{$relative}/video/{$viewed_videos[i].VID}/{$viewed_videos[i].title|clean}">
                            <div class="thumb-overlay">
                            <img src="{insert name=thumb_path vid=$viewed_videos[i].VID}/{$viewed_videos[i].thumb}.jpg" title="{$viewed_videos[i].title|escape:'html'}" alt="{$viewed_videos[i].title|escape:'html'}" id="rotate_{$viewed_videos[i].VID}_{$viewed_videos[i].thumbs}_{$viewed_videos[i].thumb}_recent" class="img-responsive {if $viewed_videos[i].type == 'private'}{/if}"/>
                                {if $viewed_videos[i].type == 'public'}<div class="label-private">{t c='global.PRIVATE'}</div>{else}<div class="label-vip">&nbsp;</div>{/if}
                                {if $viewed_videos[i].hd==1}<div class="hd-text-icon">HD</div>{/if}
                                <div class="duration">
                                    {insert name=duration assign=duration duration=$viewed_videos[i].duration}
                                    {$duration}
                                </div>
                            </div>
                            <span class="video-title title-truncate m-t-5">{$viewed_videos[i].title|escape:'html'}</span>
                        </a>
                        <div class="video-added">
                            {insert name=time_range assign=addtime time=$viewed_videos[i].addtime}
                            {$addtime}
                        </div>
                        <div class="video-views pull-left">
                            <i class="fa fa-eye"></i>&nbsp;{$viewed_videos[i].viewnumber}
                        </div>
                        <div class="video-rating pull-right {if $viewed_videos[i].rate == 0 && $viewed_videos[i].dislikes == 0}no-rating{/if}">
                            <i class="fa fa-thumbs-up video-rating-heart {if $viewed_videos[i].rate == 0 && $viewed_videos[i].dislikes == 0}no-rating{/if}"></i> <b>{if $viewed_videos[i].rate == 0 && $viewed_videos[i].dislikes == 0}-{else}{$viewed_videos[i].rate}%{/if}</b>
                        </div>
                        <div class="clearfix"></div>

                    </div>
                </div>

            {/section}
            </div>
            {else}
            <div class="well well-sm">
                <span class="text-danger">{t c='videos.no_videos_found'}.</span>
            </div>
            {/if}
        </div>
    </div>

<!--首页分页-->
<div class="index-pages">
    {if $videos}
        {if $page_link}
            <div style="text-align: center;" class="hidden-xs">
                <ul class="pagination">{$page_link}</ul>
            </div>
        {/if}
    {/if}

                {if $videos}
                    {if $page_link}
                        <div style="text-align: center;" class="visible-xs">
                            <ul class="pagination pagination-lg">{$page_link}</ul>
                        </div>
                    {/if}
                {/if}
</div>
<!--首页分页-->
</div>
{include file="footer.tpl"}