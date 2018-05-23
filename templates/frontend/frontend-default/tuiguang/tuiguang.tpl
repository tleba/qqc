{include file="header.tpl"}



<script type="text/javascript">
    var token = "{$token}";
    var fomid = "{$fomid}";
    {literal}
        function loadAjax(){
            $.ajax({
                url:'/ajax/tuiguang_add',
                type:'post',
                data:{'token':token,'fomid':fomid},
                cache:false,
                dataType:'json',
                async:true,
                error:function(){
                    alert('网络请求错误!');
                },
                success:function(data){
                    alert(data.msg);
                    //window.location.href='/';
                }
            });
        }
        loadAjax();
    {/literal}
</script>

{include file="footer.tpl"}