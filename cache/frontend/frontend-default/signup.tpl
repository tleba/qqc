<link rel="stylesheet" href="{$relative_tpl}/css/register.css?t=23" />
<script type="text/javascript" src="{$relative_tpl}/js/main.js?t=2"></script>
<div class="container">

	<div class="row">
		<div class="col-md-8">

		<div class="well login-header">

		<h3 class="mt-0 pl-20 white">注册青青草账户！</h3>
		<h5 class="font-bold mb-20 pl-20 white">注册之后，你将享受如下服务！</h5>

		<div class="row col-md-8 login-header-icon">
			<div class="col-sm-6">
				<ul class="list-unstyled m-l-30">
					<li><i class="fa fa-upload m-r-10 text-white m-b-5"></i>上传视频</li>
					<li><i class="fa fa-comments m-r-10 text-white m-b-5"></i>发布评论</li>
					<li><i class="fa fa-folder m-r-10 text-white m-b-5"></i>添加收藏</li>
					<li><i class="fa fa-rss m-r-10 text-white m-b-5"></i>订阅用户</li>
				</ul>
			</div>
			<div class="col-sm-6">
				<ul class="list-unstyled m-l-30">
					<li><i class="fa fa-th-list m-r-10 text-white m-b-5"></i>创建播放列表</li>
					<li><i class="fa fa-share-alt m-r-10 text-white m-b-5"></i>分享视频</li>
					<li><i class="fa fa-user m-r-10 text-white m-b-5"></i>添加朋友</li>
					<li><i class="fa fa-wrench m-r-10 text-white m-b-5"></i>制订您的设置</li>
				</ul>
			</div>
		</div>

		</div>


		<div class="well bs-component login-inpbox">
			<form class="form-horizontal" name="signup_form" id="signup_form" method="post" action="{$relative}/signup">
			  <fieldset>
					<div class="form-group {if $err.username}has-error{/if}">
						<label for="username" class="col-lg-3 control-label">{t c='global.username'}</label>
						<div class="col-lg-6">
							<input name="username" type="text" class="form-control" value="{$signup.username}" id="username" maxlength="14" placeholder="{t c='global.username'}" />
						</div>
					</div>

					<div class="form-group {if $err.password}has-error{/if}">
						<label for="psw" class="col-lg-3 control-label">{t c='global.password'}</label>
						<div class="col-lg-6">
							<input name="password" type="password" class="form-control" value="" id="psw" placeholder="{t c='global.password'}" />
						</div>
					</div>

					<div class="form-group {if $err.password_confirm}has-error{/if}">
						<label for="confirm_psw" class="col-lg-3 control-label">{t c='global.password_confirm'}</label>
						<div class="col-lg-6">
							<input name="password_confirm" type="password" class="form-control" value="" id="confirm_psw" placeholder="{t c='global.password_confirm'}" />
						</div>
					</div>

					<div class="form-group {if $err.email}has-error{/if}">
						<label for="email" class="col-lg-3 control-label">{t c='global.email'}</label>
						<div class="col-lg-6">
							<input name="email" type="text" class="form-control" value="{$signup.email}" id="email" placeholder="{t c='global.email'}" />
						</div>
					</div>
					<div class="form-group">
						<label for="guname" class="col-lg-3 control-label">游戏账号</label>
						<div class="col-lg-6">
							<input name="guname" type="text" class="form-control" value="" id="guname" placeholder="凯时或尊龙账号(*可填项)" />
						</div>
					</div>
					<div class="form-group {if $err.gender}has-error{/if}">
						<label class="col-lg-3 control-label">{t c='global.gender'}</label>
						<div class="col-lg-6">

						<div class="col-lg-3">

							<div class="radio">
								<label>
									<input name="gender" type="radio" value="Male" id="signup_gender_male"{if $signup.gender == 'Male'} checked="checked"{/if} />
									{t c='global.male'}
								</label>
							</div>
							<div class="radio">
								<label>
									<input name="gender" type="radio" value="Female" id="signup_gender_female"{if $signup.gender == 'Female'} checked="checked"{/if} />
									{t c='global.female'}
								</label>
							</div>

							</div>

							<div class="form-group col-lg-8">
								<div class="">
									<div class="checkbox">
										<label>
											<input name="age" type="checkbox" id="signup_age"{if $signup.age == 'on'} checked="checked"{/if} /><span class="{if $err.age}text-danger{/if}"> {t c='signup.certify'}</span>
										</label>
									</div>
								</div>
								<div class="">
									<div class="checkbox">
										<label>
											<input name="terms" type="checkbox" id="signup_certify" checked="checked"/> <span class="{if $err.terms}text-danger{/if}"> {t c='signup.terms' u=$baseurl v=$baseurl}</span>
										</label>
									</div>
								</div>
							</div>
						</div>
					</div>
                    {if $captcha == '1'}
				<!--<div class="form-group {if $err.captcha}has-error{/if}">
						<label for="yzm" class="col-lg-4 control-label">{t c='global.verification'}</label>
						<div class="col-lg-8">
							<div class="m-t-5">-->
								{$areyh}
						<!--</div>
						</div>
					</div>-->
                    {/if}
					<div class="form-group">
						<div class="col-lg-6 col-lg-offset-3 reg-btn">
							<button name="submit_signup" type="submit" class="btn-no btn-primary">{t c='global.sign_up'}</button>
						</div>
					</div>

			  </fieldset>
			</form>
		</div>
		</div>
		<div class="col-md-4">
			<div class="ad-body">
				<div class="adv-pc">
				<div style="margin-bottom:10px">
				<div class="ads_43"></div>
				</div>
				<div style="margin-bottom:10px">
				<div class="ads_44"></div>
				</div>

				<div style="margin-bottom:10px">
				<div class="ads_45"></div>
				</div>
				</div>
			</div>

		</div>
	</div>
</div>
