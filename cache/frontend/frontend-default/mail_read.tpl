<link type="test/css" rel="stylesheet" href="/templates/frontend/frontend-default/css/uc_color.css"/>
<div class="container">
	<div class="row">
		<div class="col-md-4">
			{include file='mail_menu.tpl'}		
			<div class="hidden-sm hidden-xs">
				{include file='user_info.tpl'}
			</div>
		</div>
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading">
					<span class="title-truncate">{t c='mail.reading'}: <span class="text-white">{$mail.subject|truncate:100:'...':true|escape:'html'}</span></span>
				</div>
				<div class="panel-body">
				<div class="pull-left">
					{if $mail.sender != $site_admin}<a href="{$relative}/user/{$mail.sender}">{/if}
						<img src="{$relative}/media/users/{if $mail.photo == ''}nopic-{$mail.gender}.gif{else}{$mail.photo}{/if}" alt="{$mail.sender}'s avatar" class="comment-avatar" />
					{if $mail.sender != $site_admin}</a>{/if}
				</div>
				<div class="comment">
					<div class="comment-info">
						{t c="global.from"}: {if $mail.sender != $site_admin}<a href="{$relative}/user/{$mail.sender}">{/if}{$mail.sender}{if $mail.sender != $site_admin}</a>{/if} <br />
						{t c="global.subject"}: <span class="text-black">{$mail.subject|escape:'html'}</span>
					</div>
					<div class="text-black comment-body" style="color:#626262;">
					<p>
						{$mail.body}
					</p>
					</div>
				</div>
				<div class="clearfix m-b-15"></div>
				<div class="m-l-80">
					{if $mail.sender != $site_admin}<a href="{$relative}/mail/compose/{$mail.sender}?s=Re: {$mail.subject|escape:urlpathinfo|escape:'html'}" class="btn btn-primary" >{t c='global.reply'}</a>{/if}
					<a href="{$relative}/mail/{$folder}?delete={$mail.mail_id}" class="btn btn-secondary m-l-5" >{t c='global.delete'}</a>
				</div>
	
				</div>				
			</div>	
		</div>
	</div>
</div>

