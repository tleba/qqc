{if $is_show}
<!-- Modal -->
<div class="modal fade sebi" id="mymessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header"></div>
      <div class="modal-body" style="color:#000;">
        {$msg}
        <p style="color: red;text-align: center;margin-top: 5px;">{$prompt}</p>
        <p style="text-align:center;margin-top:5px;">{$but_msg}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="close" data-dismiss="modal"><img src="/templates/frontend/frontend-default/img/btn_close_pre.png"></button>
      </div>
    </div>
  </div>
</div>
 <script type="text/javascript">
 {literal}
 $(function(){
	 $('#mymessage').modal({
    	show:true,
   	 	backdrop:true
    });
    setTimeout(function(){
    	$('#mymessage').fadeOut();
    	$('.modal-backdrop').fadeOut();
    },20000);
});
 {/literal}
 </script>
{/if}

{if $ispuzzleshow}
<style type="text/css">
 {literal}
 .complete{position: fixed;top: 0;right: 0;bottom: 0;left: 0;background-color:rgba(0,0,0,.5);z-index: 9999;cursor:pointer;}
.main-complete{width:auto;height:auto;position:relative;z-index: 99999;text-align:center;margin-top:5%;}
@media (max-width: 414px) {
	.main-complete{margin-top:30%;}
	.main-complete img{width:32rem;}
}
@media (max-width: 320px) {
	.main-complete img{width:30rem;}
}
  {/literal}
</style>
 <script type="text/javascript">
 {literal}
 	$(function(){
 	$('#puzzle_close').click(function(){
 		$('.complete').hide();
 	});
 	});
  {/literal}
 </script>
<div class="complete">
    <div class="main-complete"><span id="puzzle_close" style="display:block;position: absolute;text-align: center;width: 100%;height: 80px;z-index:9999999;">&nbsp;</span><a href="/qhd/puzzle/" style="display: block;" target="_blank"><img src="/qhd/puzzle/images/puzzle.png"/></a></div>
</div>
{/if}