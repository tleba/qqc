<?php
class MEmbed_empflix
{
	public $url;
	public $user_id;
	public $category;
	public $status;
	public $video;

	public $errors	= array();
	public $message;
	
	private $overflow = 500;
	
	public $video_already	= 0;
	public $video_added	= 0;
	public function __construct($url, $user_id, $category, $status)
	{
		$this->url		= $url;
		$this->user_id	= $user_id;
		$this->category	= $category;
		$this->status	= $status;
	}
	
	public function get_videos()
	{
		$count  = 0;
		$curl	= new VCurl();
                $html   = clean_html($curl->saveToString($this->url, 'video_type_preview=image'));
		if ($html) {
			preg_match_all('/<div id="remove(.*?)">(.*?)<div class="rate rate5">/', $html, $matches);
                        //echo "preg_match_all Started <br />";
                        //echo "xxx-match 0:".var_dump($matches['0'])."<br>";
                        //echo "xxx-match 1:".var_dump($matches['1'])."<br>";
                        //echo "xxx-match 2:".var_dump($matches['2'])."<br>";
                        //echo "xxx-match 3:".var_dump($matches['3'])."<br>";
            if (isset($matches['2'])) {
                
                foreach ($matches['2'] as $match) {
                    ++$count;
                    //echo "Count".$count."<br>";
                    if ($count > $this->overflow) {
                        $this->errors[] = 'Overflow reached (500)! Aborting!';
                        return FALSE;
                    }
					
					$video  = array(
						'user_id'	=> $this->user_id,
                        'site'      => 'empflix',
                        'url'       => '',
                        'title'     => '',
                        'desc'      => '',
                        'tags'      => '',
                        'category'  => '',
                        'thumbs'    => array(),
                        'duration'  => 0,
                        'embed'     => '',
                        'size'      => 0,
                        'file_url'  => '',
						'status'	=> $this->status
                    );
					
		    preg_match('/<a href="(.*?)" title="(.*?)"><img/', $match, $matches_url);
                    if (isset($matches_url['1']) && isset($matches_url['2'])) {
                        $video['url']   = trim($matches_url['1']);
                        //echo "VID URL: ".$video['url']."<br />";
                        if (strpos($video['url'], 'tnaflix') !== FALSE) {
                      		continue;
                        }
                        
			$video['title']	= strip_tags(stripslashes($matches_url['2']));
                        if (already_added('empflix', $video['url'])) {
                            ++$this->video_already;
                            continue;
                        }
                    } else {
                        continue;
                    }
					
		    preg_match('/<p class="length">(.*?)<\/p>/', $match, $matches_duration);
                    if (isset($matches_duration['1'])) {
                        $video['duration'] = duration_to_seconds($matches_duration['1']);
                    }
					
                    preg_match('/data-src="(.*?)"/', $match, $matches_thumb);
                    //echo var_dump($matches_thumb['0']);
                    //echo var_dump($matches_thumb['1']);
                    //echo var_dump($matches_thumb['2']);
                    if (isset($matches_thumb['1'])) {
                        $thumb_url  = trim($matches_thumb['1']);
                      	$thumb_url 	= str_replace('http://static.empflix.com', '', $thumb_url);
                        $thumb_url 	= str_replace('http://static-edge.empflix.com', '', $thumb_url);
                        $thumb_url 	= str_replace('http://s1.static.empflix.com', '', $thumb_url);
                        $thumb_url 	= str_replace('http://s2.static.empflix.com', '', $thumb_url);
                        $thumb_url 	= str_replace('http://s3.static.empflix.com', '', $thumb_url);
                        $thumb_url 	= str_replace('http://s4.static.empflix.com', '', $thumb_url);
                        $thumb_url 	= str_replace('http://s5.static.empflix.com', '', $thumb_url);
                        $thumb_url 	= str_replace('http://s6.static.empflix.com', '', $thumb_url);
                        $thumb_url 	= str_replace('http://s8.static.empflix.com', '', $thumb_url);
                        $thumb_url 	= str_replace('http://s9.static.empflix.com', '', $thumb_url);
                        $thumb_url 	= str_replace('http://s10.static.empflix.com', '', $thumb_url);
                        $thumb_url 	= str_replace('http://s11.static.empflix.com', '', $thumb_url);
                      	$thumb_arr 	= explode('-', $thumb_url);
                      	$thumb_left	= $thumb_arr['0'];
                        //echo var_dump($thumb_left)."<br>";
                      	$video['thumbs'] = array(
                      		'http://static-edge.empflix.com'.$thumb_left.'-1.jpg',
                      		'http://static-edge.empflix.com'.$thumb_left.'-2.jpg',
                      		'http://static-edge.empflix.com'.$thumb_left.'-3.jpg',
                      		'http://static-edge.empflix.com'.$thumb_left.'-4.jpg',
                      		'http://static-edge.empflix.com'.$thumb_left.'-5.jpg',
                      		'http://static-edge.empflix.com'.$thumb_left.'-6.jpg',
                      		'http://static-edge.empflix.com'.$thumb_left.'-7.jpg',
                      		'http://static-edge.empflix.com'.$thumb_left.'-8.jpg',
                      		'http://static-edge.empflix.com'.$thumb_left.'-9.jpg',
                      		'http://static-edge.empflix.com'.$thumb_left.'-10.jpg',
                      		'http://static-edge.empflix.com'.$thumb_left.'-11.jpg',
                      		'http://static-edge.empflix.com'.$thumb_left.'-12.jpg',
                      		'http://static-edge.empflix.com'.$thumb_left.'-13.jpg',
                      		'http://static-edge.empflix.com'.$thumb_left.'-14.jpg',
                      		'http://static-edge.empflix.com'.$thumb_left.'-15.jpg',
                      		'http://static-edge.empflix.com'.$thumb_left.'-16.jpg',
                      		'http://static-edge.empflix.com'.$thumb_left.'-17.jpg',
                      		'http://static-edge.empflix.com'.$thumb_left.'-18.jpg',
                      		'http://static-edge.empflix.com'.$thumb_left.'-19.jpg',
                      		'http://static-edge.empflix.com'.$thumb_left.'-20.jpg',
                      		'http://static-edge.empflix.com'.$thumb_left.'-21.jpg',
                      		'http://static-edge.empflix.com'.$thumb_left.'-22.jpg',
                      		'http://static-edge.empflix.com'.$thumb_left.'-23.jpg',
                      		'http://static-edge.empflix.com'.$thumb_left.'-24.jpg',
                      		'http://static-edge.empflix.com'.$thumb_left.'-25.jpg',
                      		'http://static-edge.empflix.com'.$thumb_left.'-26.jpg',
                      		'http://static-edge.empflix.com'.$thumb_left.'-27.jpg',
                      		'http://static-edge.empflix.com'.$thumb_left.'-28.jpg',
                      		'http://static-edge.empflix.com'.$thumb_left.'-29.jpg',
                      		'http://static-edge.empflix.com'.$thumb_left.'-30.jpg'
                      	);
					}
					
					
					
					$video_id  = explode('-', $matches_thumb['1']);
                    $video_id  = $video_id['0'];
                    $video_id  = end(explode('/', $video_id));
                    //echo $video_id."<br>";
                    if ($video['title'] && $video['duration'] && $video['thumbs'] && $video_id) {
						$content		= clean_html($curl->saveToString($video['url'], 'video_type_preview=image'));

						preg_match('/<span class="infoTitle">Categories:<\/span>(.*?)<\/li>/', $content, $matches_category);
						if (isset($matches_category['1'])) {
							preg_match('/<a href="(.*?)">(.*?)<\/a>/', $matches_category['1'], $match_category);
							if (isset($match_category['2'])) {
								$video['category'] = strip_tags(stripslashes($match_category['2']));
							}
						}
						
                        preg_match('/<span class="infoTitle">Tags:<\/span>(.*?)<\/li>/', $content, $matches_tags);
                        if (isset($matches_tags['1'])) {
                      		preg_match_all('/<a href="(.*?)" rel="nofollow">(.*?)<\/a>/', $matches_tags['1'], $matches_urls);
                            if (isset($matches_urls['2'])) {
                          		$tags = array();
                                foreach ($matches_urls['2'] as $tag) {
                              		$tags[] = prepare_string(strip_tags(stripslashes($tag)));
                                }

                          		$video['tags']  = strtolower(implode(' ', $tags));
                            }
                        }

                        preg_match('/<textarea id="embedCode"(.*?) >(.*?)<\/textarea>/', $content, $matches_embed);
                        if (isset($matches_embed['2'])) {
                                $match_embed = str_replace(array('&lt;', '&gt;', '&quot;'), array('<', '>', '"'), $matches_embed['2']);
                                //echo "--------------------------<br>";
                                //echo "zzz-Embed: ".$match_embed."<br>";
                                //echo "--------------------------<br>";
                      		preg_match('/<iframe src="(.*?)" width="__width__" height="__height__" frameborder="0"><\/iframe>/', $match_embed, $match_object);
                                //echo "--------------------------<br>";
                                //echo "xxx-Embed 0: ".var_dump($match_object['0'])."<br>";
                                //echo "xxx-Embed 1: ".var_dump($match_object['1'])."<br>";
                                //echo "xxx-Embed 2: ".var_dump($match_object['2'])."<br>";
                                echo "--------------------------<br>";                                
                      		if (isset($match_object['1'])) {
                      		$video['embed'] = '<iframe src="'.$match_object['1'].'" width="'.E_WIDTH.'" height="'.E_HEIGHT.'" frameborder="0"></iframe>';
                      		}
                        }
                        
						//echo var_dump($video). '<br />';
						if ($video['category'] && $video['embed']) {
                      		if (add_video($video)) {
                      			++$this->video_added;
                      		} else {
                      			$this->errors[] = 'Failed to add '.$video['url'].'!';
							}
						} else {
							$this->errors[]	= 'Failed to get video details for '.$video['url'].' (category, tags and embed)!';
						}
                    } else {
                  		$this->errors[] = 'Failed to get video details for '.$video['url'].'!';
                    }
				}
			} else {
				$this->errors[] = 'Failed to find video urls on the specified page!';
			}
		} else {
			$this->errors[] = 'Failed to get html code for specified url!';
		}
		
		if (!$this->errors) {
			return true;
		}
	
		return false;
	}
}
?>