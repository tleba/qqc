     <div id="rightcontent">
        {include file="errmsg.tpl"}
        <div id="right">
        <div align="center">
        <div id="simpleForm">
        <form name="add_adv" method="POST" action="index.php?m=new_advsadd" enctype="multipart/form-data">
        {if $adv.text != ''}
        <fieldset>
        <legend>Preview:</legend>
        <div style="width: 100%; text-align: center;">{$adv.text}</div>
        </fieldset>
        {/if}
        <fieldset>
        <legend>Add Advertise</legend>
                  
            <label for="group">Advertise Zone: </label>
            <select name="zone_id">
            <option value="0"{if $adv.group == '0'} selected="selected"{/if}>Select Advertise Zone</option>
            {section name=i loop=$advzones}
            <option value="{$advzones[i].id}"{if $adv.zone_id == $advzones[i].id} selected="selected"{/if}>{$advzones[i].name}</option>
            {/section}
            </select><br>
   
			 <label for="name">Name: </label>
            <input name="name" type="text" value="{$adv.name}" class="large"><br />
			
            <label for="desc">Description: </label>
            <input name="title" type="text" value="{$adv.title}" class="large"><br />
			
			
            <label for="url">Url: </label>
            <input name="url" type="text" value="{$adv.url}" class="large"><br />

            <label for="video">Image: </label>

            <input name="media" type="text" value="{$adv.media}" class="large"><br />
          
            <label for="rename">跳转页名称:</label>
          	<input name="rename" type="text" value="{$adv.rename}" class="large"><br />
          	<label for="relogo">广告图片:</label>
			<input name="relogopic" type="file"><br>
			<label for="ismobile">是否显示手机端:</label>
			<input name="ismobile" type="checkbox" value="1"><br />
			<label for="margin">广告边距:</label>
          	<input name="margin" type="text" value="{$adv.margin}" class="large"><br />
          	<label for="isbtn">是否显示关闭按钮:</label>
			<input name="isbtn" type="checkbox" value="1"><br />
        </fieldset>
        <div style="text-align: center;">
            <input type="submit" name="adv_add" value="Add Advertise" class="button">
        </div>
        </form>
        </div>
        </div>
        </div>
     </div>