<script type="text/javascript">
var lang_posting = "{t c='global.posting'}";
var lang_removing = "{t c='global.removing'}";
var lang_blocking = "{t c='global.blocking'}";
var lang_unblocking = "{t c='global.unblocking'}";
var lang_block = "{t c='user.block'}";
var lang_unblock = "{t c='user.unblock'}";
var lang_friend_msg = "{t c='ajax.invite_friend_msg_length'}";
var lang_friendship = "{t c='ajax.invite_friend_friendship'}";
var lang_remove_friend_ask = "{t c='ajax.remove_friend_ask'}";
var lang_remove_fav_game_ask = "{t c='ajax.remove_fav_game_ask'}";
var lang_remove_fav_video_ask = "{t c='ajax.remove_fav_video_ask'}";
var lang_remove_fav_photo_ask = "{t c='ajax.remove_fav_photo_ask'}";
var lang_remove_playlist_ask = "{t c='ajax.remove_playlist_ask'}";
var lang_report_user_msg_length = "{t c='ajax.report_user_msg_length'}";
var lang_subscribing = "{t c='global.subscribing'}";
var lang_unsubscribe = "{t c='user.unsubscribe'}";
var lang_unsubscribing = "{t c='global.unsubscribing'}";
var lang_subscribe = "{t c='user.subscribe'}";
var lang_wall_length = "{t c='ajax.wall_comment_length'}";
var lang_delete_video_ask = "{t c='video.delete_confirm'}";
var lang_delete_game_ask = "{t c='game.delete_confirm'}";

</script>

<script type="text/javascript" src="/templates/frontend/frontend-default/js/jquery.profile-0.2.js"></script>
<script type="text/javascript" src="/templates/frontend/frontend-default/js/jquery.voting-user-0.1.js"></script>
{include file='quick_jumps.tpl'}

<div class="panel panel-default">
	<div class="panel-heading title-truncate user-panel">
		<a href="{$relative}/user/{$user.username}">{$user.username}{if $smarty.session.language == 'en_US'}&#39;s{/if} {t c='user.profile'}</a>
		{if $online}
			<div class="online" alt="{t c='global.online'}" title="{t c='global.online'}"></div>
		{else}
			<div class="offline" alt="{t c='global.offline'}" title="{t c='global.offline'}"></div>
		{/if}		
	</div>
	<div class="panel-body">
		{if $smarty.session.username == $username}
			<div class="m-b-15 user-t8">
				<a href="{$relative}/user/edit">{t c='user.edit_profile'}</a> <strong>&middot;</strong> <a href = "{$relative}/user/avatar">{t c='user.change_avatar'}</a>
			</div>
		{/if}

		<div class="row">
			<div class="col-sm-5 col-xs-6 m-b-15">
                <a href="{$relative}/user/{$username}">
                    <img src="{$relative}/media/users/{if $user.photo != ''}{$user.photo}{else}nopic-{$user.gender}.gif{/if}" title="{$user.username}'s avatar" alt="{$user.username}'s avatar" class="img-responsive" />
                </a>
				<div class="vote-box vote-box-user">
					<div class="user-dislikes {if $user.likes == 0 and $user.dislikes == 0}not-voted{/if}">
						<div id="user_rate" class="likes" style="width: {$user.rate}%;"></div>
					</div>
					<div id="user_vote_msg" class="vote-msg">
						<div class="pull-left">
							<i class="glyphicon glyphicon-thumbs-up"></i> <span id="user_likes">{$user.likes}</span>
						</div>
						<div class="pull-right">
							<i class="glyphicon glyphicon-thumbs-down"></i> <span id="user_dislikes">{$user.dislikes}</span>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="">
					<div class="m-t-15">
						<a href="#" class="btn btn-primary" id="voteu_like_{$user.UID}" ><i class="glyphicon glyphicon-thumbs-up"></i></a>
						<a href="#" class="btn btn-primary" id="voteu_dislike_{$user.UID}"><i class="glyphicon glyphicon-thumbs-down"></i></a>
					</div>
				</div>				
			</div>
			<div class="col-xs-12 col-sm-7 m-b-15">
				<ul class="list-unstyled m-b-0">
					<li class="user-font-color">{t c='user.popularity'}: <span>{$user.popularity} {if $user.popularity == '1'}{t c='global.point'}{else}{t c='global.points'}{/if}</span></li>
					<li class="user-font-color">{t c='user.activity'}: <span>{$user.points} {if $user.points == '1'}{t c='global.point'}{else}{t c='global.points'}{/if}</span></li>
					{insert name=age assign=age bdate=$user.bdate}
					{if $age != ''}<li class="user-font-color">{t c='user.age'}: <span>{$age}</span></li>{/if}
					<li class="user-font-color">{t c='global.gender'}: <span>{if $user.gender == 'Male'}{t c='global.male'}{else}{t c='global.female'}{/if}</span></li>
					{if $user.relation != ''}<li class="user-font-color">{t c='user.relation'}: <span>{$user.relation}</span></li>{/if}
					{if $user.interested != ''}<li class="user-font-color">{t c='global.interested'}: <span>{$user.interested}</span></li>{/if}
					{insert name=time_range assign=joined time=$user.addtime}
					<li class="user-font-color">{t c='user.joined'}: <span>{$joined}</span></li>
					{insert name=time_range assign=last_login time=$user.logintime}
					<li class="user-font-color">{t c='user.last_login'}: <span>{$last_login}</span></li>
					<li class="user-font-color">{t c='user.profile_viewed'}: <span>{$user.profile_viewed} {if $user.profile_viewed == '1'}{t c=global.time'}{else}{t c='global.times'}{/if}</span></li>
					<li class="user-font-color">{t c='user.has_watched'}: <span>{$user.watched_video} {if $user.watched_video == '1'}{t c='global.video'}{else}{t c='videos.videos'}{/if}</span></li>
					<li class="user-font-color">{t c='user.video_watch' s=$user.username|truncate:20}: <span>{$user.video_viewed} {if $user.video_viewed == '1'}{t c='global.time'}{else}{t c='global.times'}{/if}</span></li>
				</ul>			
			</div>
		</div>
		<div class="clearfix"></div>
		{if (isset($user.aboutme) && $user.aboutme != '')||(isset($user.country) && $user.country != '')||(isset($user.town) && $user.town != '')||(isset($user.city) && $user.city != '')||(isset($user.school) && $user.school != '')||(isset($user.occupation) && $user.occupation != '')||(isset($user.interest_hobby) && $user.interest_hobby != '')||(isset($user.fav_movie_show) && $user.fav_movie_show != '')||(isset($user.fav_music) && $user.fav_music != '')||(isset($user.fav_book) && $user.fav_book != '')||(isset($user.turnon) && $user.turnon != '')||(isset($user.turnoff) && $user.turnoff != '')||(isset($user.interested) && $user.interested != '')}
		<div id="info-container" style="display: none;">
			<div class="separator">{t c='user.more_info'}</div>
			<ul class="list-unstyled m-b-15">
				{if isset($user.aboutme) && $user.aboutme != ''}
					<li>{t c='global.about_me'}: <span>{$user.aboutme}</span></li>
				{/if}
				{if isset($user.country) && $user.country != ''}
					<li>{t c='global.country'}: <span>{$user.country}</span></li>
				{/if}
				{if isset($user.town) && $user.town != ''}
					<li>{t c='global.hometown'}: <span>{$user.town}</span></li>
				{/if}
				{if isset($user.city) && $user.city != ''}
					<li>{t c='global.city'}: <span>{$user.city}</span></li>
				{/if}
				{if isset($user.school) && $user.school != ''}
					<li>{t c='global.school'}: <span>{$user.school}</span></li>
				{/if}
				{if isset($user.occupation) && $user.occupation != ''}
					<li>{t c='global.job'}: <span>{$user.occupation}</span></li>
				{/if}
				{if isset($user.interest_hobby) && $user.interest_hobby != ''}
					<li>{t c='global.here_for'}: <span>{$user.interest_hobby}</span></li>
				{/if}
				{if isset($user.fav_movie_show) && $user.fav_movie_show != ''}
					<li>{t c='user.favorite_sex'}: <span>{$user.fav_movie_show}</span></li>
				{/if}
				{if isset($user.fav_music) && $user.fav_music != ''}
					<li>{t c='user.favorite_sex_partner'}: <span>{$user.fav_music}</span></li>
				{/if}
				{if isset($user.fav_book) && $user.fav_book != ''}
					<li>{t c='user.my_erogenic_zones'}: <span>{$user.fav_book}</span></li>
				{/if}
				{if isset($user.turnon) && $user.turnon != ''}
					<li>{t c='user.turn_on'}: <span>{$user.turnon}</span></li>
				{/if}
				{if isset($user.turnoff) && $user.turnoff != ''}
					<li>{t c='user.turn_off'}: <span>{$user.turnoff}</span></li>
				{/if}
				{if isset($user.interested) && $user.interested != ''}
					<li>{t c='global.interested'}: <span>{$user.interested}</span></li>
				{/if}
			</ul>
		</div>
		<ul class="pager m-t-0 m-b-0">
			<li><a href="#" id="info-showmore">{t c='global.show_more'}</a></li>
			<li><a href="#" id="info-hide" style="display: none">{t c='global.hide'}</a></li>
		</ul>		
		{/if}
	</div>
</div>

<div class="panel panel-default">
	<!--<div class="panel-heading title-truncate">{t c='user.CONTACT'} {$username}</div>-->
	<div class="panel-body">
        <div class="row">
            {insert name=is_blocked assign=is_blocked UID=$smarty.session.uid BID=$user.UID}
            {if !$is_blocked}
                {insert name=is_friend assign=is_friend UID=$smarty.session.uid FID=$user.UID}
                {if $is_friend}
					<div class="col-sm-6" id="remove_friend"><a class="white font-song-14" href="#remove_friend" id="remove_from_friends_{$user.UID}">{t c='user.remove_friend'}</a></div>
					{if $private_msgs == 'friends'}
						<div class="col-sm-6"  id="send_message"><a class="user-font-color font-song-12" href="{$relative}/mail/compose/{$user.username}">{t c='user.send_message'}</a></div>
					{/if}
				{else}
					<!--<div class="col-sm-6"  id="add_friend"><a class="user-font-color font-song-12"  class="user-font-color font-song-12" href="#invite_friend" id="invite_as_friend_{$user.UID}">{t c='user.add_friend'}</a></div>-->
                {/if}
            {/if}
			
			{if $private_msgs == 'all'}
				<div class="col-sm-6"  id="send_message"><a class="user-font-color font-song-12" class="user-font-color font-song-12" href="{$relative}/mail/compose/{$user.username}">{t c='user.send_message'}</a></div>
			{/if}
            {insert name=is_subscribed assign=is_subscribed SUID=$smarty.session.uid UID=$user.UID}
            <!--{if $is_subscribed}
                <div class="col-sm-6"  id="handle_subscription"><a class="user-font-color font-song-12" href="#unsubscribe_user" id="unsubscribe_from_{$user.UID}">{t c='user.unsubscribe'}</a></div>
            {else}
                <div class="col-sm-6"  id="handle_subscription"><a class="user-font-color font-song-12" href="#subscribe_user" id="subscribe_to_{$user.UID}">{t c='user.subscribe'}</a></div>
            {/if}-->
            <!--<div class="col-sm-6"  id="report_user"><a class="user-font-color font-song-12" href="#report_user" id="open_report_user">{t c='user.report'}</a></div>
            {if $is_blocked}
                <div class="col-sm-6"  id="block_user"><a class="user-font-color font-song-12" href="#unblock_user" id="remove_block_{$user.UID}">{t c='user.unblock'}</a></div>
            {else}
                <div class="col-sm-6"  id="block_user"><a class="user-font-color font-song-12" href="#block_user" id="add_block_{$user.UID}">{t c='user.block'}</a></div>
            {/if}-->
        </div>
<!--
		<div id="invite_message" style="display: none;">
          	<input name="owner_id" type="hidden" value="{$user.UID}" id="user_id" />
			<a href="#close_invite_message" id="close_invite_message"  class="close" >&times;</a>
          	<div class="text-white m-t-15">
            	{t c='user.add_friend'}
         	</div>
			<div class="form-group">
				<textarea class="form-control" name="invite_friend_message" id="invite_friend_message" rows="4" cols="10" placeholder="{t c='global.message_opt'}" ></textarea>
			</div>
       		<div id="invite_friend_error" class="invite_error" style="display: none;"></div>

           	<input name="send_friend_invite" type="button" value="{t c='user.send_invite'}" id="send_friend_invite" class="btn btn-primary" />

  		</div>
  		-->
      	<div id="report_message" style="display: none;">
			<a href="#close_report_user" id="close_report_message"  class="close" >&times;</a>
          	<div class="text-white m-t-15">
            	{t c='user.report'}
         	</div>		
			<div class="form-group">
				<div class="radio">
				  <label>
					<input name="report_reason" value="offensive" id="report_reason_1" type="radio" checked="checked" />
					{t c='flag.offensive'}
				  </label>
				</div>
				<div class="radio">
				  <label>
					<input name="report_reason" value="underage" id="report_reason_2" type="radio"  />
					{t c='flag.underage'}
				  </label>
				</div>
				<div class="radio">
				  <label>
					<input name="report_reason" value="spammer" id="report_reason_3" type="radio" />
					{t c='flag.spammer'}
				  </label>
				</div>
				<div class="radio">
				  <label>
					<input name="report_reason" value="other" id="report_reason_4" type="radio" />
					{t c='flag.other'}
				  </label>
				</div>				
			</div>
			<div id="other_message" style="display: none;">
				<div class="form-group">
					<textarea class="form-control" name="other_reason" id="other_reason" rows="4" placeholder="{t c='global.message_opt'}"></textarea>
				</div>
          	</div>

           	<input name="send_report_user" type="button" value="{t c='user.flag_user'}" id="send_flag_user_{$user.UID}" class="btn btn-primary" />

      	</div>
		<div id="user_message" style="display:none;"></div>		
	
	</div>
</div>
