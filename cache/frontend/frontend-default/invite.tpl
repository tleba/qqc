<script type="text/javascript">
    {literal}
        $(document).ready(function(){
            $("#captcha_reload").click(function(event){
                event.preventDefault();
                $("#captcha_image").attr('src', "{/literal}{$relative}{literal}/captcha" + '/' + Math.random());
            });
        });
    {/literal}  
</script>

<div class="container">

	<div class="row">
		<div class="col-md-12">
			<div class="well err-well bs-component">
				<form class="form-horizontal" name="inviteFriendsForm" id="inviteFriendsForm" method="post" action="{$relative}/invite">
				  <fieldset>
					<legend>{t c='invite.title'}</legend>
						<div class="m-b-20">
							<h4>{t c='invite.expl'}</h4>
						</div>
						
						<div class="form-group {if $err.emails}has-error{/if}">
							<label for="friend_1" class="col-lg-3 control-label">{t c='global.friend'} {t c='global.one'}</label>
							<div class="col-lg-9">
								<input name="friend_1" type="text" class="form-control" value="{$emails[0]}" id="friend_1" placeholder="{t c='global.email'}" />
							</div>
						</div>

						<div class="form-group">
							<label for="friend_2" class="col-lg-3 control-label">{t c='global.friend'} {t c='global.two'}</label>
							<div class="col-lg-9">
								<input name="friend_2" type="text" class="form-control" value="{$emails[1]}" id="friend_2" placeholder="{t c='global.email'}" />
							</div>
						</div>

						<div class="form-group">
							<label for="friend_3" class="col-lg-3 control-label">{t c='global.friend'} {t c='global.three'}</label>
							<div class="col-lg-9">
								<input name="friend_3" type="text" class="form-control" value="{$emails[2]}" id="friend_3" placeholder="{t c='global.email'}" />
							</div>
						</div>

						<div class="form-group">
							<label for="friend_4" class="col-lg-3 control-label">{t c='global.friend'} {t c='global.four'}</label>
							<div class="col-lg-9">
								<input name="friend_4" type="text" class="form-control" value="{$emails[3]}" id="friend_4" placeholder="{t c='global.email'}" />
							</div>
						</div>

						<div class="form-group">
							<label for="friend_5" class="col-lg-3 control-label">{t c='global.friend'} {t c='global.five'}</label>
							<div class="col-lg-9">
								<input name="friend_5" type="text" class="form-control" value="{$emails[4]}" id="friend_5" placeholder="{t c='global.email'}" />
							</div>
						</div>						

						<div class="form-group {if $err.name}has-error{/if}">
							<label for="invite_name" class="col-lg-3 control-label">{t c='global.name'}</label>
							<div class="col-lg-9">
								<input name="name" type="text" class="form-control" value="{$invite.name}" id="invite_name" placeholder="{t c='global.name'}" />
							</div>
						</div>	

						<div class="form-group {if $err.message}has-error{/if}">
							<label for="invite_friends_message" class="col-lg-3 control-label">{t c='global.message'}</label>
							<div class="col-lg-9">
								<textarea name="message" class="form-control" id="invite_friends_message" rows="4" placeholder="{t c='global.message'}" >{$invite.message}</textarea>
							</div>
						</div>						

						<div class="form-group {if $err.captcha}has-error{/if}">
							<label for="invite_verification" class="col-lg-3 control-label">{t c='global.verification'}</label>
							<div class="col-lg-9">
								<input name="verification" type="text" class="form-control" value="" id="invite_verification" placeholder="{t c='global.verif_expl'}" />
								<div class="m-t-10">
									<img src="{$relative}/captcha" id="captcha_image" alt="Are you human?" />
								</div>
								<div class="m-t-5">
									<a href="#reload_captcha" id="captcha_reload">{t c='global.verif_reload'}</a>
								</div>
							</div>
						</div>						
						
						<div class="form-group">
							<div class="col-lg-9 col-lg-offset-3">
								<button name="submit_invite" type="submit" class="btn btn-primary">{t c='invite.send'}</button>
							</div>
						</div>
						
				  </fieldset>
				</form>		
			</div>
		</div>
		
	</div>
</div>