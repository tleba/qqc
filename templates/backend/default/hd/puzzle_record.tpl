     <div id="rightcontent">
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
                <td align="center"><b>ID</b></td>
                <td align="center"><b>拼图名称</b></td>
                <td align="center"><b>拼图步数</b></td>
                <td align="center"><b>拼图时间</b></td>
                <td align="center"><b>拼图状态</b></td>
                <td align="center"><b>拼图难度</b></td>
                <td align="center"><b>拼图开始时间</b></td>
                <td align="center"><b>拼图结束时间</b></td>
            </tr>
            {if $rows}
            {section name=i loop=$rows}
            <tr bgcolor="{cycle values="#F8F8F8,#F2F2F2"}">
                <td align="center">{$rows[i].id}</td>
                <td align="center">{$rows[i].title}</td>
                <td align="center">{$rows[i].moves}</td>
                <td align="center">{$rows[i].seconds}</td>
                 <td align="center">{if $rows[i].status == 1}<font style="color:#373DF9">成功</font>{else}<font style="color:red;">失败</font>{/if}</td>
                <td align="center">{$rows[i].diff}</td>
                <td align="center">{$rows[i].stime}</td>
                <td align="center">{$rows[i].etime}</td>
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