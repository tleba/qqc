<?php
class MEmbed_porn2
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
			preg_match_all('/<div class="video">(.*?)<\/div><\/div>/', $html, $matches);
            if (isset($matches['1'])) {
                foreach ($matches['1'] as $match) {
                    ++$count;
                    if ($count > $this->overflow) {
                        $this->errors[] = 'Overflow reached (500)! Aborting!';
                        return FALSE;
                    }
					
					$video  = array(
						'user_id'	=> $this->user_id,
                        'site'      => 'porn2',
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
					
					preg_match('/<a href="(.*?)" title="(.*?)" onmousedown=/', $match, $matches_url);
                    if (isset($matches_url['1']) && isset($matches_url['2'])) {
                        $video['url']   = 'http://www.porn2.com'.$matches_url['1'];
                        $video['title'] = strip_tags(stripslashes($matches_url['2']));
                        if (already_added('porn2', $video['url'])) {
                            ++$this->video_already;
                            continue;
                        }
                    } else {
                        continue;
                    }
					
					preg_match('/<div id="length">(.*?)<\/div>/', $match, $matches_duration);
                    if (isset($matches_duration['1'])) {
                        $video['duration'] = $this->duration_to_seconds($matches_duration['1']);
                    }
					
					preg_match('/<img src="(.*?)" width="160" height="120" alt=/', $match, $matches_thumb);
                    if (isset($matches_thumb['1'])) {
                        $thumb_url          = $matches_thumb['1'];
                        $thumb_url          = substr($thumb_url, 0, strrpos($thumb_url, '/'));
                        $video['thumbs']    = array(
                            $thumb_url.'/1.jpg',
                            $thumb_url.'/2.jpg',
                            $thumb_url.'/3.jpg'
                        );
                    }
					
					$video_arr  = explode('/', $thumb_url);
                    $video_id   = str_replace('g', '', $video_arr['4']);
                    if ($video['title'] && $video['duration'] && $video['thumbs'] && isset($video_id)) {
						$tags           = array();
                        $tags_arr       = explode(' ', strtolower(prepare_string($video['title'], false)));
                        foreach ($tags_arr as $tag) {
                            if (strlen($tag) >= 5) {
                                $tags[] = $tag;
                            }
                        }
                            
                        $video['tags']  = implode(' ', $tags);
					
						$content        = clean_html($curl->saveToString($video['url']));
						preg_match('/<div id="desc">(.*?)<\/div>/', $content, $matches_desc);
                        if (isset($matches_desc['1'])) {
                            $video['desc'] = strip_tags(stripslashes($matches_desc['1']));
                        }
						
						$video['embed'] = '<iframe src="http://www.porn2.com/embed/'.$video_id.'" width="'.E_WIDTH.'" height="'.E_HEIGHT.'" frameborder="0" scrolling="no"></iframe>';
						
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
