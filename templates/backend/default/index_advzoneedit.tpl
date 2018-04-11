     <div id="rightcontent">
        {include file="errmsg.tpl"}
        <div id="right">
        <div align="center">
        <div id="simpleForm">
        <form name="edit_adv_group" method="POST" action="index.php?m=advzoneedit&AGID={$zone[0].id}">
        <fieldset>
        <legend>Editing Zone: {$zone[0].name}</legend>
            <label for="adv_width">Name: </label>
            <input name="name" type="text" value="{$zone[0].name}"/><br>
            <label for="adv_width">Width: </label>
            <input name="width" type="text" value="{$zone[0].width}"><br>
            <label for="adv_height">Height: </label>
            <input name="height" type="text" value="{$zone[0].height}"><br>
           
        </fieldset>
        <div style="text-align: center;">
            <input type="submit" name="edit_adv_group" value="Update Advertise Zone" class="button">
        </div>
        </form>
        </div>
        </div>
        </div>
     </div>