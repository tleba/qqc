     <div id="rightcontent">
        {include file="errmsg.tpl"}
        <div id="right">
        <div align="center">
        <div id="simpleForm">
		<form name="addServer" id="addServer" method="post" action="servers.php?m=add">
        <fieldset>
        <legend>Add Server</legend>
            <label for="url" style="width: 15%;">URL: </label>
			<input name="url" type="text" class="large" value="{$server.url}" /><small>Eg. http://www.domain.com</small><br />			
            <label for="video_url" style="width: 15%;">Video URL: </label>
            <input name="video_url" type="text" class="large" value="{$server.video_url}" /><small>Eg. http://www.domain.com/media/videos</small><br />
			<label for="server_ip" style="width: 15%;">FTP IP / Hostname: </label>
			<input name="server_ip" type="text" class="large" value="{$server.server_ip}" /><small>Eg. ftp.domain.com</small><br />
			<label for="ftp_username" style="width: 15%;">FTP Username: </label>
			<input name="ftp_username" type="text" class="large" value="{$server.ftp_username}" /><br />
			<label for="ftp_password" style="width: 15%;">FTP Password: </label>
			<input name="ftp_password" type="text" class="large" value="{$server.ftp_password}" /><br />
			<label for="ftp_root" style="width: 15%;">FTP Path to Videos Directory: </label>
			<input name="ftp_root" type="text" class="large" value="{$server.ftp_root}" /><small>Eg. /public_html/media/videos</small><br />
        </fieldset>
        <div style="text-align: center;">
            <input name="add_server" type="submit" value="-- Add Server --" class="button">
        </div>        
        </form>
        </div>
        </div>
        </div>
     </div>
