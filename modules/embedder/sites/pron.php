<?php
class MEmbed_pron
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
			preg_match_all('/<!--- mianitura--><script(.*?)<\/strong><\/span><\/div> <\/li>/', $html, $matches);
            if (isset($matches['1'])) {
                foreach ($matches['1'] as $match) {
                    ++$count;
                    if ($count > $this->overflow) {
                        $this->errors[] = 'Overflow reached (500)! Aborting!';
                        return FALSE;
                    }
					
					$video  = array(
						'user_id'	=> $this->user_id,
                        'site'      => 'pron',
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
					
					preg_match('/<a href="(.*?)" target="_self"/', $match, $matches_url);
                    if (isset($matches_url['1'])) {
                        $video['url']   = 'http://www.pron.com'.$matches_url['1'];					
                        if (already_added('pron', $video['url'])) {
                            ++$this->video_already;
                            continue;
                        }
                    } else {
                        continue;
                    }
					
					preg_match('/<span class="duration">(.*?)<\/span>/', $match, $matches_duration);
                    if (isset($matches_duration['1'])) {
                        $video['duration'] = duration_to_seconds($matches_duration['1']);
                    }
					
					preg_match('/<img src="(.*?)" alt="(.*?)" name/', $match, $matches_thumb);
                    if (isset($matches_thumb['1']) && isset($matches_thumb['2'])) {
                        $video['title']  = strip_tags(stripslashes($matches_thumb['2']));
                        $thumb_url       = $matches_thumb['1'];
                        $thumb_url       = explode('-', $thumb_url);
                        $thumb_url       = $thumb_url['0'];
                        $video['thumbs'] = array(
                            $thumb_url.'-1.jpg',
                            $thumb_url.'-2.jpg',
                            $thumb_url.'-3.jpg',
                            $thumb_url.'-4.jpg',
                            $thumb_url.'-5.jpg'
                        );
                    }
					
//					echo var_dump($video). '<br />';
                    if ($video['title'] && $video['duration'] && $video['thumbs']) {
						$content        = clean_html($curl->saveToString($video['url']));
						preg_match('/<strong>Tags:<\/strong>(.*?)<\/div><\/td>/', $content, $matches_tags);
                        if (isset($matches_tags['1'])) {
                            preg_match_all('/<a href=\'(.*?)\'>(.*?)<\/a>/', $matches_tags['1'], $matches_tag);
                            $tags   = array();
                            if (isset($matches_tag['2'])) {
                                foreach ($matches_tag['2'] as $tag) {
                                    $tags[] = prepare_string($tag);
                                }
                                
                                $video['tags'] = implode(' ', $tags);
                            }
                        }
                        
                        preg_match('/<strong>Description:<\/strong><br \/>(.*?)<\/label>/', $content, $matches_desc);
                        if (isset($matches_desc['1'])) {
                            $video['desc'] = strip_tags(stripslashes(trim($matches_desc['1'])));
                        }
                        
						preg_match('/readonly="readonly" value=\'<script(.*?)<\/script>/', $content, $matches_embed);
                    	if (isset($matches_embed['1'])) {
                      		$video['embed'] = '<script '.str_replace('width=425&height=344', 'width='.E_WIDTH.'&height='.E_HEIGHT, $matches_embed['1']).'</script>';
                        }
						
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
