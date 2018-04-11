<?php
class MEmbed_pornative
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
        $html   = clean_html($curl->saveToString($this->url));
		if ($html) {
			preg_match_all('/<div class="smallmovie">(.*?)<\/div>/', $html, $matches);
            if (isset($matches['1'])) {
                foreach ($matches['1'] as $match) {
                    ++$count;
                    if ($count > $this->overflow) {
                        $this->errors[] = 'Overflow reached (500)! Aborting!';
                        return FALSE;
                    }
					
					$video  = array(
						'user_id'	=> $this->user_id,
                        'site'      => 'pornative',
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
					
                    preg_match('/<span class="link"><a href="(.*?)"><b>play<\/b><\/a><\/span>/', $match, $matches_url);
                    if (isset($matches_url['1'])) {
                        $video['url']   = 'http://www.pornative.com'.$matches_url['1'];					
                        if (already_added('pornative', $video['url'])) {
                            ++$this->video_already;
                            continue;
                        }
                    } else {
                        continue;
                    }
					
					preg_match('/<h2>(.*?)<\/h2>/', $match, $matches_title);
                    if (isset($matches_title['1'])) {
                        $video['title'] = strip_tags(stripslashes($matches_title['1']));
                    }

					preg_match('/<span class="duration"><b>duration:<\/b>(.*?)<\/span>/', $match, $matches_duration);
                    if (isset($matches_duration['1'])) {
                        $video['duration'] = duration_to_seconds($matches_duration['1']);
                    }
					
                    preg_match('/<img class="thumb" src="(.*?)" alt="" \/>/', $match, $matches_thumb);
                    if (isset($matches_thumb['1'])) {
                        $thumb_url  = $matches_thumb['1'];
                        $thumb_url  = substr($thumb_url, 0, strrpos($thumb_url, '/'));
                        $video['thumbs'] = array(
                            $thumb_url.'/1.jpg',
                            $thumb_url.'/2.jpg',
                            $thumb_url.'/3.jpg',
                            $thumb_url.'/4.jpg',
                            $thumb_url.'/5.jpg',
                            $thumb_url.'/6.jpg',
                            $thumb_url.'/7.jpg',
                            $thumb_url.'/8.jpg'
                        );
                    }

					$video_id   = str_replace(array('http://www.pornative.com/', '.html'), '', $video['url']);
        
                    if ($video['title'] && $video['duration'] && $video['thumbs'] && isset($video_id)) {
                        $tags       = array();
                        $tags_arr   = explode(' ', strtolower(prepare_string($video['title'], false)));
                        foreach ($tags_arr as $tag) {
                            if (strlen($tag) >= 5) {
                                $tags[] = $tag;
                            }
                        }
                            
                        $video['tags']  = implode(' ', $tags);							
					
						$content        = clean_html($curl->saveToString($video['url']));
						preg_match('/Channels: <a href="(.*?)">(.*?)<\/a>/', $content, $matches_category);
                        if (isset($matches_category['2'])) {
                            $category = strip_tags(stripslashes(trim($matches_category['2'])));
                        }
						
						$video['embed'] = '<embed src="http://www.pornative.com/embed/player.swf" FlashVars="movie_id='.$video_id.'" quality="high" bgcolor="#000000" width="'.E_WIDTH.'" height="'.E_HEIGHT.'" allowScriptAccess="always"  wmode="transparent" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />';
						
                        if (add_video($video)) {
                      		++$this->video_added;
                        } else {
                      		$this->errors[] = 'Failed to add '.$video['url'].'!';
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
	
	private function duration_to_seconds($duration)
    {
        $duration   = str_replace(array(' min', ' sec'), array('m', 's'), $duration);
        $duration   = str_replace(array('m', 's'), '', $duration);
        $duration   = explode(' ', $duration);
        $seconds    = ((int) $duration['0'] * 60);
        $seconds    = (isset($duration['1'])) ? ($seconds + (int) $duration['1']) : $seconds;

        return $seconds;
    }

}
?>
