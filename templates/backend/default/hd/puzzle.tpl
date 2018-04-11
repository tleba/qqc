     <div id="rightcontent">
        {include file="errmsg.tpl"}
        <div id="searchForm">
            <form name="search_hd" method="POST" action="hd.php?m=puzzle">
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
                <td align="center"><b>游戏者</b></td>
                <td align="center"><b>名次</b></td>
                <td align="center"><b>总步数</b></td>
                <td align="center"><b>总秒数</b></td>
                <td align="center"><b>总完成拼图</b></td>
                <td align="center"><b>操作</b></td>
            </tr>
            {if $rows}
            {section name=i loop=$rows}
            <tr bgcolor="{cycle values="#F8F8F8,#F2F2F2"}">
                <td align="center">{$rows[i].uid}</td>
                <td align="center">{$rows[i].username}</td>
                <td align="center">{$rows[i].urank}</td>
                <td align="center">{$rows[i].moves}</td>
                <td align="center">{$rows[i].seconds}</td>
                <td align="center">{$rows[i].finishpics}</td>
                <td align="center"><a href="hd.php?m=puzzle_level&uid={$rows[i].uid}">每天拼图情况</a><a style="margin-left:20px;" href="hd.php?m=puzzle_record&uid={$rows[i].uid}">拼图详细</a></td>
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