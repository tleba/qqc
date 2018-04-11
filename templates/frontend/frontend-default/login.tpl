<div class="container">
	<div class="row login">
		<div class="col-md-8">
		<div class="well login-header">
		
		<h3 class="mt-0 pl-20 white">登录到青青草账户！</h3>
		<h5 class="font-bold mb-20 pl-20 white">登录之后，你将享受如下服务！</h5>
		
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
				<form class="form-horizontal" name="login_form" id="login_form" method="post" action="{$relative}/login">
				  <fieldset>
					
										
						<div class="form-group {if $errors}has-error{/if}">
							<label for="login_username" class="col-lg-3 control-label">{t c='global.username'}</label>
							<div class="col-lg-6">
								<input name="username" type="text" class="form-control" value="" id="login_username" placeholder="{t c='global.username'}" />
							</div>
						</div>

						<div class="form-group {if $errors}has-error{/if}">
							<label for="login_password" class="col-lg-3 control-label">{t c='global.password'}</label>
							<div class="col-lg-6">
								<input name="password" type="password" class="form-control" value="" id="login_password" placeholder="{t c='global.password'}" />
								<div class="checkbox">
									<label>
										<input name="login_remember" type="checkbox" id="login_remember" /> {t c='global.remember'}
									</label>
								</div>							
							</div>
						</div>
<!--
						<div class="form-group">
							<div class="col-lg-9 col-lg-offset-3">
								<a href="{$relative}/lost" rel="nofollow">{t c='global.forgot'}</a>
							</div>
						</div>

						<div class="form-group">
							<div class="col-lg-9 col-lg-offset-3">
								<a href="{$relative}/confirm" rel="nofollow">{t c='global.confirm'}</a>
							</div>
						</div>
-->
						<div class="form-group">
							<div class="col-lg-6 col-lg-offset-3 reg-btn">
								<button name="submit_login" type="submit" class="btn-no btn-primary">{t c='global.login'}</button>
							</div>
						</div>
						
				  </fieldset>
				</form>		
			</div>
		</div>
		<div class="col-md-4">
			
			<div class="ad-body">
				
				<div class="adv-pc">
				<!--<script type="text/javascript" src="/ads/login-right.js"></script>-->
				</div>
				
			</div>
			
		</div>
	</div>
</div>
