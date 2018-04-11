<?php
function get_pagination($page, $total_pages, $url)
{
	
	global $config;
	$prev_page	 = $page-1;
	if($prev_page<1) $prev_page=1;
	$next_page	 = $page+1;
	$output      = array();


	if ($page >1 && $total_pages >= 2) {
		$output[]	= '<a href="'.get_url($prev_page,$url).'" data-role="button" data-theme="b" data-inline="true" rel="external">&lt;</a>';
	}
	
	for ($i=1; $i<=$total_pages; $i++) {
		if ($page == $i) {
			$output[] 	= '<a href="'.$config['BASE_URL'].'/'.$url.'?page='.$page.'" data-role="button" rel="external">'.$page.'</a>';
		}
	}
	

	if ($page !== $total_pages && $total_pages > $page) {
		$output[]	= '<a href="'.get_url($page+1,$url).'" data-role="button" data-theme="b" data-inline="true" rel="external">&gt;</a>';
	}

    return implode('', $output);
}

function get_url($page,$module)
{
	global $config;
	//return $config['BASE_URL'].'/'.$module.'?page='.$page;
	return $config['BASE_URL'].'/'.$module.((strpos($module, '?')) ? '&' : '?').'page='.$page;
}

?>
