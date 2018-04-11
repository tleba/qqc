     <div id="rightcontent">
        {include file="errmsg.tpl"}
        <div id="searchForm">
         <form name="batch" method="POST" action="users.php?m=batchRegister" enctype="multipart/form-data">
        	<label for="relogo" style="margin-left:20px;">上传CSV文件:</label>
			<input name="csv" type="file"><input type="submit" name="batch_insert" value=" -- 上传 -- " class="button"/><a href="/siteadmin/batchRegister.csv" target="_blank" style="margin-left:15px;">下载CSV文件(提示：文件中性别，男用“Male”，女用“Female”)</a>
		</form>	
		
        </div>
        <div id="right">
        <div align="center">
        <div id="simpleForm">
        <table width="100%" cellspacing="1" cellpadding="3" border="0">
            <tr>
                <td align="center"><b>用户名</b></td>
                <td align="center"><b>密码</b></td>
                <td align="center"><b>邮箱</b></td>
                <td align="center"><b>性别</b></td>
            </tr>
            {if $arr}
            {section name=i loop=$arr}
            <tr bgcolor="{cycle values="#F8F8F8,#F2F2F2"}">
            <td align="center"><b>{$arr[i].0}</b></td>
            <td align="center"><b>{$arr[i].1}</b></td>
            <td align="center"><b>{$arr[i].2}</b></td>
            <td align="center"><b>{$arr[i].3}</b></td>
            </tr>
            {/section}
            {/if}
        </table>
        </div>
        </div>
        </div>
     </div>