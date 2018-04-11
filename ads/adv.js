var posid;


var src = document.scripts[document.scripts.length - 1].src;
var args = src.substr(src.indexOf("?") + 1).split("&");
for ( var i = 0; i < args.length; i++) {
    var j = args[i].indexOf("=");
    if (j > -1 && args[i].substr(0, j) == 'pos') {
        posid = args[i].substr(j + 1);
    }

}

function getRealDomain(domains){
	var redomain = '';
	var domainArray = new Array("com" , "net" , "org" , "gov" , "edu", "me", "us", 'info', 'la');
	var domains_array = domains.split('.');
	var domain_count = domains_array.length-1;
	var flag = false;
	
	return domains_array[domain_count-1]+"."+domains_array[domain_count];

}
domain = location.host;//getRealDomain(location.host);
/*console.log(location.host);
console.log(domain);*/
var containerWidth = parseInt($('.container').css('width').replace('px',''));
var adsurl = 'http://'+ domain + '/ads/adv.html?pos=' + posid + '&domain=' + getRealDomain(location.host) + '&time=' + new Date().getTime() + '&cwidth=' + containerWidth;
	
document.writeln("<iframe id=\"pos_"+posid+"\" frameborder=\"0\" height=\"0\" width=\"0\" scrolling=\"no\" src=\""+adsurl+"\"></iframe> ");
