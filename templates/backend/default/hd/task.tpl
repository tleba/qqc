     <div id="rightcontent">
        {include file="errmsg.tpl"}
        <div id="searchForm">
            <table width="100%" cellpadding="0" cellspacing="5" border="0">
            <tr style="padding:15px 0;"><td colspan="7" align="left"><a name="add_deposit" href="hd.php?m=task_add" style="background-color:#D4D4D4;padding:6px 20px;border-radius:8px;border-right: 1px solid #bbb;border-bottom: 1px solid #ccc;border-top: 1px solid #ccc;border-left: 1px solid #bbb;margin-right:10px;">--添加游戏任务--</a></td></tr>
            </table>
        </div>
        <div id="right">
            <table width="100%" cellspacing="1" cellpadding="3" border="0">
            <tr>
                <td align="center"><b>ID</b></td>
                <td align="center"><b>游戏任务名称</b></td>
                <td align="center"><b>成立条件</b></td>
                <td align="center"><b>奖品信息</b></td>
                <td align="center"><b>是否显示</b></td>
                <td align="center"><b>添加时间</b></td>
                <td align="center"><b>显示排序</b></td>
                <td align="center"><b>操作</b></td>
            </tr>
            {if $rows}
            {section name=i loop=$rows}
            <tr bgcolor="{cycle values="#F8F8F8,#F2F2F2"}">
                <td align="center">{$rows[i].id}</td>
                <td align="center">
                    {$rows[i].tname}
                </td>
                <td align="center">{$rows[i].condition_str}</td>
                <td align="center">{$rows[i].prize}</td>
                <td align="center">{if $rows[i].isshow == 1}是{else}否{/if}</td>
                <td align="center">{$rows[i].atime|date_format}</td>
                <td align="center">{$rows[i].order}</td>
                <td align="center"><a href="hd.php?m=task_edit&id={$rows[i].id}">修改</a><br/><a href="javascript:void(0);" onclick="del('{$rows[i].id}');">删除</a></td>
            </tr>
            {/section}
            {else}
            <tr>
                <td colspan="8" align="center"><div class="missing">没有什么发现</div></td>
            </tr>
            {/if}
            </table>
        </div>
         {if $total >= 1}
	        <div id="paging" style="width:100%;">
	            <div class="pagingnav">{$paging}</div>
	        </div>
        {/if}
     </div>
     <script type="text/javascript">
     {literal}
     	function del(id){
     		if(confirm('确定要删除？')){
     			window.location.href = 'hd.php?m=task&a=del&id='+id;
     		}
     	}
     {/literal}
     </script>