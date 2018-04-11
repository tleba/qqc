     <div id="rightcontent">
        {include file="errmsg.tpl"}
        <div id="searchForm">
            <form name="search_hd" method="POST" action="hd.php?m=task_receive">
            <table width="100%" cellpadding="0" cellspacing="5" border="0">
            <tr>
            	 <td align="right">用户名</td>
            	 <td><input type="text" name="keyword" value="{$keyword}"></td>
                <td colspan="6" align="left">
                    <input type="submit" name="search_hd" value=" -- 搜索 -- " class="button">
                    <input type="reset" name="reset_search" value=" -- 清除 -- " class="button">
                </td>
            </tr>
            </table>
            </form>
        </div>
        <div id="right">
            <table width="100%" cellspacing="1" cellpadding="3" border="0">
            <tr>
                <td align="center"><b>ID</b></td>
                <td align="center"><b>领取人</b></td>
                <td align="center"><b>领取任务名</b></td>
                <td align="center"><b>是否赠送</b></td>
                <td align="center"><b>赠送时间</b></td>
                <td align="center"><b>领取时间</b></td>
                <td align="center"><b>操作</b></td>
            </tr>
            {if $rows}
            {section name=i loop=$rows}
            <tr bgcolor="{cycle values="#F8F8F8,#F2F2F2"}">
                <td align="center">{$rows[i].id}</td>
                <td align="center">{$rows[i].username}</td>
                <td align="center">{$rows[i].tname}</td>
                <td align="center">{$rows[i].prize}</td>
                <td align="center">{if $rows[i].ispost == 1}是{else}否{/if}</td>
                <td align="center">{$rows[i].utime|date_format}</td>
                <td align="center">{if $rows[i].ispost == 1}已赠送{else}<a href="hd.php?m=task_receive&a=task_prize_post&id={$rows[i].id}">赠送</a>{/if}</td>
            </tr>
            {/section}
            {else}
            <tr>
                <td colspan="7" align="center"><div class="missing">没有什么发现</div></td>
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