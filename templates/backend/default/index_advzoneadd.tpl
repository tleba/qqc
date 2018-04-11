     <div id="rightcontent">
        {include file="errmsg.tpl"}
        <div id="right">
        <div align="center">
        <div id="simpleForm">
        <form name="add_adv_group" method="POST" action="index.php?m=advzoneadd">
        <fieldset>
        <legend>添加广告位置</legend>
            <label for="adv_width">Name: </label>
            <input name="name" type="text"/><br>
            <label for="adv_width">Width: </label>
            <input name="width" type="text"/><br>
            <label for="adv_height">Height: </label>
            <input name="height" type="text"/><br>
           
        </fieldset>
        <div style="text-align: center;">
            <input type="submit" name="add_adv_group" value="Add Advertise Zone" class="button">
        </div>
        </form>
        </div>
        </div>
        </div>
     </div>