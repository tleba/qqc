<?php
class MEmbed_keezmovies
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
        $html   = clean_html($curl->saveToString($this->url, 'age_verified=1'));
		if ($html) {
			preg_match_all('/<li class="videoblock(.*?)<\/li>/', $html, $matches);
            if (isset($matches['1'])) {
                foreach ($matches['1'] as $match) {
                    ++$count;
                    if ($count > $this->overflow) {
                        $this->errors[] = 'Overflow reached (500)! Aborting!';
                        return FALSE;
                    }
					
                    if (strpos($match, 'style="display: none;"') !== FALSE OR
                        strpos($match, 'target="_blank"') !== FALSE) {
                        continue;
                    }					
					
					$video  = array(
						'user_id'	=> $this->user_id,
                        'site'      => 'keezmovies',
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
					
                    preg_match('/<a href="(.*?)" class="img" title="(.*?)">/', $match, $matches_url);
                    if (isset($matches_url['1']) && $matches_url['1'] &&
                        isset($matches_url['2']) && $matches_url['2']) {
//                        $video_url = $matches_url['1'];
//                        if ($video_url['0'] != '/') {
//                          continue;
//                        }
        
                        $video['url']   = trim($matches_url['1']);
                        $video['title'] = strip_tags(stripslashes($matches_url['2']));					
                        if (already_added('keezmovies', $video['url'])) {
                            ++$this->video_already;
                            continue;
                        }
                    } else {
                        continue;
                    }
					
					preg_match('/<var class="duration">(.*?)<\/var>/', $match, $matches_duration);
                    if (isset($matches_duration['1'])) {
                        $video['duration'] = duration_to_seconds($matches_duration['1']);
                    }
					
                    preg_match('/<img src="(.*?)" alt/', $match, $matches_thumb);
                    if (isset($matches_thumb['1']) && $matches_thumb['1']) {
                        $thumb_url          = explode('?', $matches_thumb['1']);
                        $thumb_url          = $thumb_url['0'];
                        $thumb_url          = substr($thumb_url, 0, strrpos($thumb_url, '/'));
                        $video['thumbs']    = array(
                            $thumb_url.'/1.jpg',
                            $thumb_url.'/2.jpg',
                            $thumb_url.'/3.jpg',
                            $thumb_url.'/4.jpg',
                            $thumb_url.'/5.jpg',
                            $thumb_url.'/6.jpg',
                            $thumb_url.'/7.jpg',
                            $thumb_url.'/8.jpg',
                            $thumb_url.'/9.jpg',
                            $thumb_url.'/10.jpg',
                            $thumb_url.'/11.jpg',
                            $thumb_url.'/12.jpg',
                            $thumb_url.'/13.jpg',
                            $thumb_url.'/14.jpg',
                            $thumb_url.'/15.jpg',
                            $thumb_url.'/16.jpg',
                        );
                    }
					
                    if ($video['title'] && $video['duration'] && $video['thumbs']) {
						$content        = clean_html($curl->saveToString($video['url'], 'age_verified=1'));
						preg_match('/Tags:(.*?)<\/h2>/', $content, $matches_tags);
                        if (isset($matches_tags['1']) && $matches_tags['1']) {
                            preg_match_all('/<a href="(.*?)">(.*?)<\/a>/', $matches_tags['1'], $matches_tag);
                            $tags   = array();
                            if (isset($matches_tag['2']) && $matches_tag['2']) {
                                foreach ($matches_tag['2'] as $tag) {
                                    $tags[] = strtolower(prepare_string($tag));
                                }
                                
                                $video['tags'] = implode(' ', $tags);
                            }
                        }
                        
                        preg_match('/new Rater\(\$\(\'\#video_rating_(.*?)\'\)/', $content, $matches_id);
                        if (isset($matches_id['1']) && $matches_id['1']) {
                            $video_id   = $matches_id['1'];
                        } else {
                            preg_match('/function IlikeVideo\(\)\{ rateVideo\([0-9]+, [0-9]+\)\;\}/', $content, $matches_id);
                            if (isset($matches_id['1']) && $matches_id['1']) {
                                $video_id = $matches_id['1'];
                            } else {
                                preg_match('/<a href="javascript:rateVideo\((.*?), (.*?)\)"/', $content, $matches_id);
                                if (isset($matches_id['1']) && $matches_id['1']) {
                                    $video_id = $matches_id['1'];
                                }
                            }
                        }
                                                
                        if (isset($video_id) && $video_id) {
							$video['embed'] = '<object type="application/x-shockwave-flash" data="http://cdn1.static.keezmovies.phncdn.com/flash/player_embed.swf?cache=005" width="'.E_WIDTH.'" height="'.E_HEIGHT.'"><param name="bgColor" value="#000000" /><param name="allowfullscreen" value="true" /><param name="allowScriptAccess" value="always" /><param name="FlashVars" value="options=http://www.keezmovies.com/embed_player.php?id='.$video_id.'" <param name="movie" value="http://cdn1.static.keezmovies.phncdn.com/flash/player_embed.swf?cache=005" wmode="transparent"/></object>';
                      		if (add_video($video)) {
                      	  		++$this->video_added;
                      		} else {
                      			$this->errors[] = 'Failed to add '.$video['url'].'!';
							}
						} else {
							$this->errors[] = 'Failed to get video details for '.$video['url'].' (video_id)!';
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
