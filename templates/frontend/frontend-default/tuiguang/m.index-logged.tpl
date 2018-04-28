<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1"/>
    <meta http-equiv="X-UA-Compatible" content="IE=9"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="robots" content="index, follow"/>
    <title>邀请好友一起免费看片</title>
    <link rel="stylesheet" href="/templates/frontend/frontend-default/tuiguang/css/normalize.css"/>
    <link rel="stylesheet" href="/templates/frontend/frontend-default/tuiguang/css/reset.css"/>
    <link rel="stylesheet" href="/templates/frontend/frontend-default/tuiguang/css/m.style.css"/>
    <!-- 手机访问则跳到手机站 -->
    <script type="text/javascript">
        {literal}
            var userAgentInfo = navigator.userAgent;
            if  (userAgentInfo.indexOf("Android") > 0 || userAgentInfo.indexOf("iPhone") > 0 || userAgentInfo.indexOf("SymbianOS") > 0 || userAgentInfo.indexOf("Windows Phone") > 0 || userAgentInfo.indexOf("iPod") > 0 || userAgentInfo.indexOf("iPad") > 0)
            {
            }else {
                window.location.href = "/tuiguang/index.php";
            }
        {/literal}
    </script>
</head>
<body>
<div class="banner">
    <img src="/templates/frontend/frontend-default/tuiguang/images/banner-m.jpg" alt="邀请好友一起免费看片 每天10万体验币免费送" class="block">
</div>
<div class="main">
    <div class="h2-rule h2-title ">
        <img src="/templates/frontend/frontend-default/tuiguang/images/h2-rule.png" alt="活动规则" class="block">
    </div>
    <p class="rule-txt">复制您的专属分享链接发给QQ好友、QQ群、微信朋友、微信群、微信朋友圈、微博、百度贴吧、论坛等，邀请2个用户通过您的分享链接访问本站，您即可以获得 1 个体验币，有了体验币，您就可以免费观看视频了！</p>
    <!--您的专属链接-->
    <div class="h2-link h2-title margin-large-top-50">
        <img src="/templates/frontend/frontend-default/tuiguang/images/h2-link.png" alt="您的专属链接">
    </div>
    <!--已登录-->
    <div  class="logged" >
        <!--复制链接-->
        <div class="input-link margin-bottom-15 clearfix">
            <input type="text" class="float-left" value="{$url}" id="link" >
            <button data-clipboard-action="copy" data-clipboard-target="#link" class="block copy-link float-left" id="copy-link" >复制链接</button>
        </div>

        <!--您已经免费获得体验币-->
        <div class="clearfix gold">
            <div class="icon-gold float-left margin-right-15">
                <img src="/templates/frontend/frontend-default/tuiguang/images/icon-gold.png" alt="金币">
            </div>
            <p class="float-left text-gold margin-large-bottom-50">
                您已经免费获得体验币：<span>{$sebi}个</span>
            </p>
        </div>
    </div>
</div>

<script src="/templates/frontend/frontend-default/tuiguang/javascript/clipboard.min.js"></script>
<script>
    {literal}
        var clipboard = new ClipboardJS('#copy-link');
        clipboard.on('success', function(e) {
            var text = e.text;
            alert('推广地址：'+text+"复制成功！");
        });
        clipboard.on('error', function(e) {
            var text = e.text;
            alert('推广地址：'+text+"复制失败，请手动复制！");
        });
    {/literal}
</script>
</body>
</html>