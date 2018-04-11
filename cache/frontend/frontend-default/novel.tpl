<link type="text/css" rel="stylesheet" href="/templates/frontend/frontend-default/css/cont.css?v=2015080915037"/>
<div class="cont">
  <div class="left">
   <div class="top">
   	<p class="left-title">
    	{$user.username}个人资料
    </p>
  <p class="title-cont">编辑个人资料-<a>修改头像</a></p>
  <div class="title-left"><img src="{if $user.photo != ''}{$relative}/media/users/{$user.photo}{else}/images/left_03.jpg{/if}"></div>
  <div class="title-right">
  	<p>人数：{$user.popularity}</p>
    <p>活动：{$user.points}</p>
    <p>性别：{if $user.gender == 'Male'}{t c='global.male'}{else}{t c='global.female'}{/if}</p>
    {insert name=time_range assign=joined time=$user.addtime}
    <p>加入：{$joined}</p>
    {insert name=time_range assign=last_login time=$user.logintime}
    <p>上次登陆：{$last_login}</p>
    <p>简介：{$user.aboutme}</p>
    <p>爱好：{$user.turnon}</p>
  </div>
  </div>
   <div class="ad-first">
   <!--<script type="text/javascript" src="{$baseurl}/ads/adv.js?pos=71"></script>-->
   <div class="ads_71"></div>
   </div>
   <div class="ad-second">
   <!--<script type="text/javascript" src="{$baseurl}/ads/adv.js?pos=73"></script>-->
   <div class="ads_73"></div>
   </div>
   <div class="ad-three">
   <!--<script type="text/javascript" src="{$baseurl}/ads/adv.js?pos=75"></script>-->
   <div class="ads_75"></div>
   </div>
  </div><!--left结束-->
  <div class="right">
  	<p class="banner">
  		当前位置<a href="/novels/index.html">成人小说</a>><a href="/novels/{$novel.category_id}/">{$category}</a>><span style="color: #1bbc9d">{$novel.title}</span>

  	</p>
  <div class="head">
    <div class="cont-top">
    	<a href="/novels.php"><img src="/images/mulu_03.jpg">返回目录</a>
      </div><!--cont-top-->
      <p class="title">{$novel.title}</p>
       <p class="title-cont">类型：{$category}  查看：{$novel.viewnumber}  加入时间：{insert name=time_range assign=addtime time=$novel.addtime}{$addtime}</p>
      </div>
      <div class="cont-ad">
      <!--<script type="text/javascript" src="{$baseurl}/ads/adv.js?pos=61"></script>-->
      <div class="ads_61"></div>
      </div>
        <div class="list" style="font-size:15px;">
        {$novel.content}
        </div>
      <div class="clearfix"></div>
      <div class="end-list">
      <div class="end-list-cont">

      </div>
      </div>
      <div class="clearfix"></div>
       <div class="cont-ad">
       <!--<script type="text/javascript" src="{$baseurl}/ads/adv.js?pos=65"></script>-->
       <div class="ads_65"></div>
       </div>
       <div class="clearfix"></div>
  </div><!--right-->
</div><!--cont-->
<div class="clearfix"></div>
