     <div id="rightcontent">
        {include file="errmsg.tpl"}
        <div id="searchForm">
            <form name="search_advertise" method="POST" action="index.php?m=advs">
            <table width="100%" cellpadding="0" cellspacing="5" border="0">
            <tr>
                <td align="right">Sort</td>
                <td>
                    <select name="sort">
                    <option value="a.adv_id"{if $option.sort == 'a.adv_id'} selected="selected"{/if}>ID</option>
                    <option value="a.adv_name"{if $option.sort == 'a.adv_name'} selected="selected"{/if}>Name</option>
                    <option value="a.adv_status"{if $option.sort == 'a.adv_status'} selected="selected"{/if}>Status</option>
                    </select>
                </td>
                <td align="right">Order</td>
                <td>
                    <select name="order">
                    <option value="DESC"{if $option.order == 'DESC'} selected="selected"{/if}>DESC</option>
                    <option value="ASC"{if $option.order == 'ASC'} selected="selected"{/if}>ASC</option>
                    </select>
                </td>
                <td colspan="2" align="center">
                    <input type="submit" name="search_advertise" value=" -- Search -- " class="button">
                    <input type="reset" name="reset_search" value=" -- Clear -- " class="button">
                </td>
				
				<td colspan="2" align="center">
                    <input type="button" name="" value="Clear Advertise cache" class="button" onclick="location.href='index.php?m=new_advs&a=clearcache'">
					
					&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="button" name="" value="Add Advertise" class="button" onclick="location.href='index.php?m=new_advsadd'">
                </td>
            </tr>
            </table>
            </form>
        </div>
        <div id="right">
            <table width="100%" cellspacing="2" cellpadding="3" border="0">
            <tr>
                <td align="center"><b>ID</b></td>
                <td align="center"><b>排序</b></td>
                <td align="center"><b>Advertise Zone</b></td>
                 <td align="center"><b>Name</b></td>
				 <td align="center"><b>Url</b></td>
				 <td align="center"><b>Image</b></td>
                 <td align="center"><b>Action</b></td>
            </tr>
            {if $advs}
            {section name=i loop=$advs}
            <tr bgcolor="{cycle values="#F8F8F8,#F2F2F2"}">
                <td align="center">{$advs[i].id}</td>
                <td align="center">{$advs[i].orderby}</td>
				  <td align="center">{$advs[i].zone_name}</td>    
                <td align="center"><a href="index.php?m=advedit&AID={$advs[i].adv_id}">{$advs[i].name}</a></td>
                <td align="center">{$advs[i].url}</td>       
				  <td align="center">
				  	<img src="{if $advs[i].localpic}{$advs[i].localpic}{else}{$advs[i].relogopic}{/if}" alt="{$advs[i].zone_name}" height="40%" width="40%">
				  	<br/>
					<a href="{if $advs[i].localpic}{$advs[i].localpic}{else}{$advs[i].relogopic}{/if}" target="_blank" >{if $advs[i].localpic}{$advs[i].localpic}{else}{$advs[i].relogopic}{/if}</a>
				  </td>           				
                <td align="center">
                    <a href="index.php?m=new_advsedit&AID={$advs[i].id}">Edit</a>&nbsp;&nbsp;
    
                    <a href="javascript:void(0);" onclick="del('{$advs[i].id}');">Delete</a>
                </td>
            </tr>
            {/section}
            {else}
            <tr>
                <td colspan="8" align="center"><div class="missing">NO ADVERTISE  FOUND</div></td>
            </tr>
            {/if}
            </table>
        </div>
     </div>
     <script type="text/javascript">
     {literal}
     	function del(id){
     		if(confirm('确定要删除？')){
     			window.location.href = 'index.php?m=new_advs&a=delete&AID='+id;
     		}
     	}
     {/literal}
     </script>