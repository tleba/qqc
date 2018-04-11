<?php
class MEmbed_redtube
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
		//echo var_dump($this->url). '<br />';
		$count  = 0;
		$curl	= new VCurl();
                $html   = clean_html($curl->saveToString($this->url, 'iVisited=1; cookAV=1'));

                //for title, duration, thumb etc..
		if ($html) {
			preg_match_all('/<li> <div class="video">(.*?)<\/li>/', $html, $matches);
                if (isset($matches['1'])) {
                foreach ($matches['1'] as $match) {
                    ++$count;
                    if ($count > $this->overflow) {
                        $this->errors[] = 'Overflow reached (500)! Aborting!';
                        return FALSE;
                    }
					
					$video  = array(
						'user_id'	=> $this->user_id,
                        'site'      => 'redtube',
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
                         preg_match('/<h1 class="categoryHeading">(.*?)<\/h1>/', $html, $matchesxx);
                        if ( isset($matchesxx['1']) ) {
			 $video['category'] = $matchesxx['1'];
                        }

                    preg_match('/<a href="(.*?)" title="(.*?)">/', $match, $matches_url);
                    if (isset($matches_url['1']) && isset($matches_url['2'])) {
                  		$video['url']	= $matches_url['1'];
                  		if (strpos($video['url'], 'http://') === FALSE) {
                      		$video['url']   = 'http://www.redtube.com'.$matches_url['1'];
                      	}
                        $video['title'] = strip_tags(stripslashes($matches_url['2']));
                        $video['title'] = str_replace('" > ', '', $video['title']);
                        $video['title'] = str_replace('"', '', $video['title']);
                        $video['title'] = str_replace('>', '', $video['title']);					
                        if (already_added('redtube', $video['url'])) {
                            ++$this->video_already;
                            continue;
                        }
                    } else {
                        continue;
                    }
					
		    preg_match('/<span class="d">(.*?)<\/span>/', $match, $matches_duration);
                    if (isset($matches_duration['1'])) {
                        $video['duration'] = duration_to_seconds($matches_duration['1']);
                    }


					
                    preg_match('/class="t" src="(.*?)" onmouseout/', $match, $matches_thumb);
                    if (isset($matches_thumb['1'])) {
                        $thumb_url  = $matches_thumb['1'];
                        $thumb_url  = substr($thumb_url, 0, strrpos($thumb_url, '_'));
                        $video_id   = intval(substr($thumb_url, strrpos($thumb_url, '/')+1));
                        $video['thumbs'] = array(
                            $thumb_url.'_002.jpg',
                            $thumb_url.'_003.jpg',
                            $thumb_url.'_004.jpg',
                            $thumb_url.'_005.jpg',
                            $thumb_url.'_006.jpg',
                            $thumb_url.'_007.jpg',
                            $thumb_url.'_008.jpg',
                            $thumb_url.'_009.jpg',
                            $thumb_url.'_010.jpg',
                            $thumb_url.'_011.jpg',
                            $thumb_url.'_012.jpg',
                            $thumb_url.'_013.jpg',
                            $thumb_url.'_014.jpg',
                            $thumb_url.'_015.jpg'
                        );
                    }					
        
                    if ($video['title'] && $video['duration'] && $video['thumbs'] && isset($video_id)) {
						$tags       = array();
                        $tags_arr   = explode(' ', strtolower(prepare_string($video['title'], false)));
                        foreach ($tags_arr as $tag) {
                            if (strlen($tag) >= 5) {
                                $tags[] = $tag;
                            }
                        }
                        
                        $video['tags']  = implode(' ', $tags);

						$video['embed'] = '<object wmode="transparent" height="'.E_HEIGHT.'" width="'.E_WIDTH.'"><param name="movie" value="http://embed.redtube.com/player/"><param name="FlashVars" value="id='.$video_id.'&style=redtube"><embed src="http://embed.redtube.com/player/?id='.$video_id.'&style=redtube" wmode="transparent" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" height="'.E_HEIGHT.'" width="'.E_WIDTH.'" /></object>';
                        if (add_video($video, $this->category)) {
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
