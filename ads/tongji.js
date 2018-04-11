function loadScript(url, callback){
	var script = document.createElement("script");
	script.type = "text/javascript"; 
	if (script.readyState){ //IE 
		script.onreadystatechange = function(){
			if (script.readyState == "loaded"||script.readyState == "complete"){
				script.onreadystatechange = null; 
				callback(); 
			}
		}; 
	} else { 
		script.onload = function(){ 
			callback(); 
		}; 
	}
	script.src = url;
	document.getElementById('tongji').appendChild(script);
	//document.body.appendChild(script); 
}
// setTimeout(function(){
// 	loadScript('http://js.users.51.la/16960647.js',function(){});
// },5000);
//var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
//document.write(unescape("%3Cspan id='cnzz_stat_icon_1268721080'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s22.cnzz.com/z_stat.php%3Fid%3D1268721080' type='text/javascript'%3E%3C/script%3E"));
//document.writeln("<div style=\"display:none\">");
///document.writeln("<script language=\"javascript\" type=\"text/javascript\" src=\"http://js.users.51.la/16960647.js\"></script>");
//document.writeln("<script language=\"javascript\" type=\"text/javascript\" src=\"http://s95.cnzz.com/z_stat.php?id=1254857401&web_id=1254857401\"></script>");
//document.writeln("</div>");
var _hmt = _hmt || [];
(function() {
    var hm = document.createElement("script");
    hm.src = "https://hm.baidu.com/hm.js?50c5b40dec0a2565fc305d222f8bac8b";
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(hm, s);
})();
