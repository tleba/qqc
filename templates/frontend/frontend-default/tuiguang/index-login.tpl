<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>邀请好友一起免费看片</title>
    <link rel="stylesheet" href="/templates/frontend/frontend-default/tuiguang/css/normalize.css"/>
    <link rel="stylesheet" href="/templates/frontend/frontend-default/tuiguang/css/reset.css"/>
    <link rel="stylesheet" href="/templates/frontend/frontend-default/tuiguang/css/style.css"/>
    <!-- 手机访问则跳到手机站 -->
    <script type="text/javascript">
        {literal}
            var userAgentInfo = navigator.userAgent;
            if  (userAgentInfo.indexOf("Android") > 0 || userAgentInfo.indexOf("iPhone") > 0 || userAgentInfo.indexOf("SymbianOS") > 0 || userAgentInfo.indexOf("Windows Phone") > 0 || userAgentInfo.indexOf("iPod") > 0 || userAgentInfo.indexOf("iPad") > 0)
            {
                window.location.href = "/tuiguang/m.index.php";
            }else {

            }
        {/literal}
    </script>
</head>
<body>
<div class="banner">
    <div class="container">
        <div class="banner-h2"></div>
        <div class="banner-txt"></div>
    </div>
</div>
<div class="main">
    <div class="container">
        <!--活动规则-->
        <div class="h2-rule margin-large-bottom-50"></div>
        <p class="rule-txt margin-large-bottom-50">
            复制您的专属分享链接发给QQ好友、QQ群、微信朋友、微信群、微信朋友圈、微博、百度贴吧、论坛等，<br/>邀请1个用户通过您的分享链接访问本站，您即可以获得 1 个体验币，有了体验币，您就可以免费观看视频了！
        </p>
        <!--您的专属链接-->
        <div class="h2-link margin-large-bottom-50"></div>
        <!--未登录-->
        <div class="login" >
            <!--立即登录-->
            <div class="input-link  clearfix">
                <input type="text" class="float-left margin-large-bottom-50" value="您还没有登录，登录后可见>>" disabled="disabled">
                <a href="/" class="block copy-link float-left">立即登录</a>
            </div>
        </div>

    </div>
</div>
</body>
</html>