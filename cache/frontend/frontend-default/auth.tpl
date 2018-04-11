<!DOCTYPE html>
<html lang="Zh-hans">
<head>
    <title>auth</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=9" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">	
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="robots" content="index, follow" />
    <meta name="revisit-after" content="1 days" />
    {if $accesslink}
    <meta http-equiv="Refresh" content="1; url={$accesslink}" /> 
    {else}
    <meta http-equiv="Refresh" content="2; url=/" /> 
    {/if}
{literal}<style>body{ font: 18px Verdana,"Microsoft YaHei",Helvetica,Arial,Sans-Serif; }</style>
{/literal}
</head>

<body>
<div style=" margin: 0 auto; text-align: center;  color: #555; margin-top: 20%; font-size: 18px; border: 1px solid #999; background: #DDD; padding: 20px; width: 50%;">
{if !$message}

	{if $accesslink!=''}
	
	尊敬的用户{$username},你即将进入我们的论坛,如果浏览器没有响应请<a href="{$accesslink}">点击此处进入论坛</a>!
	
	{else}
	
	API异常！
	
	{/if}

{else}
{$message}
{/if}
</div>
</body>
</html>
