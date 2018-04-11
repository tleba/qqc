<div class="container">
	
	<div class="row">
		<div class="col-md-12 col-sm-8">
		<div class="well err-well">
			  <fieldset>
				<legend>温馨提示</legend>
				<div class="m-b-20 text-danger">
					{$message}
				</div>
			  </fieldset>

		</div>
		</div>
		
	</div>
	<div class="ad-body">
		<p class="ad-title">{t c='global.sponsors'}</p>
		{insert name=adv assign=adv group='index_bottom'}
		{if $adv}{$adv}{/if}
	</div>	
</div>