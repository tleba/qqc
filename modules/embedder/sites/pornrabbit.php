<?php
class MEmbed_pornrabbit
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
        $html   = clean_html($curl->saveToString($this->url, 'iVisited=1; cookAV=1'));
		if ($html) {
			preg_match_all('/<div class="video">(.*?)<\/div>/', $html, $matches);
            if (isset($matches['1'])) {
                foreach ($matches['1'] as $match) {
                    ++$count;
                    if ($count > $this->overflow) {
                        $this->errors[] = 'Overflow reached (500)! Aborting!';
                        return FALSE;
                    }
					
					$video  = array(
						'user_id'	=> $this->user_id,
                        'site'      => 'pornrabbit',
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
					
					preg_match('/<span class="link"><a href="(.*?)"><b>/', $match, $matches_url);
                    if (isset($matches_url['1'])) {
                        $video['url']   = 'http://www.pornrabbit.com'.trim($matches_url['1']);
                        if (already_added('pornrabbit', $video['url'])) {
                            ++$this->video_already;
                            continue;
                        }
                    } else {
                        continue;
                    }
					
					preg_match('/<h3>(.*?)<\/h3>/', $match, $matches_title);
                    if (isset($matches_title['1'])) {
                        $video['title'] = strip_tags(htmlspecialchars($matches_title['1']));
                    }

					preg_match('/<span class="runtime"><b>runtime:<\/b> (.*?)<\/span>/', $match, $matches_duration);
                    if (isset($matches_duration['1'])) {
                        $video['duration'] = $this->duration_to_seconds($matches_duration['1']);
                    }
					
					preg_match('/<img src="(.*?)" class="thumb">/', $match, $matches_thumb);
                    if (isset($matches_thumb['1'])) {
                        $thumb_url       = substr($matches_thumb['1'], 0, strrpos($matches_thumb['1'], '/'));
                        $video['thumbs'] = array(
                            $thumb_url.'/1_medium.jpg',
                            $thumb_url.'/2_medium.jpg',
                            $thumb_url.'/3_medium.jpg',
                            $thumb_url.'/4_medium.jpg',
                            $thumb_url.'/5_medium.jpg',
                            $thumb_url.'/6_medium.jpg',
                            $thumb_url.'/7_medium.jpg',
                            $thumb_url.'/8_medium.jpg'
                        );
                    }
					
                    $video_arr  = explode('/', $video['url']);
                    $video_id   = $video_arr['3'];
                    if ($video['title'] && $video['duration'] && $video['thumbs'] && isset($video_id)) {
						$tags       = array();
                        $tags_arr   = explode(' ', strtolower(prepare_string($video['title'], false)));
                        foreach ($tags_arr as $tag) {
                            if (strlen($tag) >= 5) {
                                $tags[] = $tag;
                            }
                        }
                        
                        $video['tags']  = implode(' ', $tags);
						
						$video['embed'] = '<object height="'.E_HEIGHT.'px" width="'.E_WIDTH.'px"><param name="movie" value="http://embed.pornrabbit.com/player.swf"><param name="FlashVars" value="movie_id='.$video_id.'"><param name="AllowScriptAccess" value="always"><embed src="http://embed.pornrabbit.com/player.swf?movie_id='.$video_id.'" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" wmode="transparent" height="495px" width="630px" AllowScriptAccess="always"></object>';
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
        $duration   = str_replace(array('m', 's'), array(':', ''), $duration);
        $duration   = explode(':', $duration);
        $minutes    = sprintf('%01d', $duration['0']);
        $seconds    = sprintf('%01d', $duration['1']);

        return (($minutes * 60) + $seconds);
    }
}
?>
