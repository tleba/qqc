     <div id="rightcontent">
        {include file="errmsg.tpl"}
        <div id="searchForm">
            <form name="search_hd" method="POST" action="hd.php?m=tuiguang&a=cache">
                <table width="100%" cellpadding="0" cellspacing="5" border="0">
                    <tr>
                        <td align="right">每日体验币赠送总数：</td>
                        <td><input type="text" name="day_total_award" value="{$day_total_award}"></td>
                        <td align="right">用户单日赠送体验币上限：</td>
                        <td><input type="text" name="day_user_total_award" value="{$day_user_total_award}"></td>
                        <td align="right">每日邀请：</td>
                        <td><input type="text" name="min_invit_custom" value="{$min_invit_custom}">个用户总送1个体验币</td>
                        <td colspan="6" align="left">
                            <input type="submit" name="search_hd" value=" -- 更新 -- " class="button">
                        </td>
                    </tr>
            </table>
            </form>
        </div>
        <div id="right">
            <table width="100%" cellspacing="1" cellpadding="3" border="0">
            <tr>
                <td align="center"><b>日期</b></td>
                <td align="center"><b>体验币送出数</b></td>
                <td align="center"><b>邀请IP数</b></td>
                <td align="center"><b>用户参与数</b></td>
            </tr>
            {if $rows}
            {section name=i loop=$rows}
            <tr bgcolor="{cycle values="#F8F8F8,#F2F2F2"}">
                <td align="center">{$rows[i].day}</td>
                <td align="center">{$rows[i].totSeb}</td>
                <td align="center">{$rows[i].totIp}</td>
                <td align="center">{$rows[i].totUid}</td>
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