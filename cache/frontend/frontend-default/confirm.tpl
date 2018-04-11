<div class="container">
	
	<div class="row">
		<div class="col-md-12">
		<div class="well err-well">
			<form class="form-horizontal" name="confirmEmailForm" id="confirmEmailForm" method="post" action="{$relative}/confirm">
			  <fieldset>
				<legend>{t c='confirm.title'}</legend>
				<div class="m-b-20">
					<h4> {t c='confirm.expl'}.</h4>
				</div>
				<div class="form-group {if $errors}has-error{/if}">
					<label for="confirm_email" class="col-lg-3 control-label">{t c='global.email'}</label>
					<div class="col-lg-9">
						<input name="email" type="text" class="form-control" value="" id="confirm_email" placeholder="{t c='global.email'}" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-9 col-lg-offset-3">
						<input name="submit_confirm" type="submit" value="{t c='confirm.send'}" id="confirm_submit" class="btn btn-primary">
					</div>
				</div>					
			  </fieldset>
			</form>		
		</div>
		</div>
		
	</div>
</div>