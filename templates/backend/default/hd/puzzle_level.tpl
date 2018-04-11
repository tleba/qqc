     <div id="rightcontent">
        {include file="errmsg.tpl"}
        <div id="searchForm">
            <table width="100%" cellpadding="0" cellspacing="5" border="0">
            <tr>
            	 <td align="left">用户名：{$username}</td>
            	 <td align="left"></td>
                <td colspan="6" align="left"></td>
            </tr>
            </table>
        </div>
        <div id="right">
            <table width="100%" cellspacing="1" cellpadding="3" border="0">
            <tr>
                <td align="center"><b>闯关日期</b></td>
                <td align="center"><b>拼图数量</b></td>
                <td align="center"><b>闯到哪关</b></td>
                <td align="center"><b>所得色币数</b></td>
            </tr>
            {if $rows}
            {section name=i loop=$rows}
            <tr bgcolor="{cycle values="#F8F8F8,#F2F2F2"}">
                <td align="center">{$rows[i].playtime}</td>
                <td align="center">{$rows[i].completes}</td>
                <td align="center">{$rows[i].level}</td>
                <td align="center">{$rows[i].sebis}</td>
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