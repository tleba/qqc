<?php
class MEmbed_pornhub
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
		//codebreaker's change
			$html=explode('<div class="section_wrapper auto">',$html);
			$html=$html[0];
		// end change;
			preg_match_all('/<div class="wrap">(.*?)<\/li>/', $html, $matches);
            if (isset($matches['1'])) {
                foreach ($matches['1'] as $match) {
                    ++$count;
                    if ($count > $this->overflow) {
                        $this->errors[] = 'Overflow reached (500)! Aborting!';
                        return FALSE;
                    }
					
					$video  = array(
						'user_id'	=> $this->user_id,
                        'site'      => 'pornhub',
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
					
		    preg_match('/<a href="(.*?)"/', $match, $matches_url);
                    if (isset($matches_url['1'])) {
                        $video['url']   = trim($matches_url['1']);
                        $video_url = $video['url'];
                        
                        preg_match( '/\?viewkey=([0-9]+)/', $video_url, $matches_vid);
                        if (isset($matches_vid[1])){
                        $video_id = $matches_vid[1];
                        }  

                        if (already_added('pornhub', $video['url'])) {
                            ++$this->video_already;
                            continue;
                        }
						
						$parse = parse_url($video['url']);
                        
						if ($parse['host'] != 'www.pornhub.com')
						{
						   continue;
						}
						
                    } else {
                        continue;
                    }
					
		    preg_match('/<var class="duration">(.*?)<\/var>/', $match, $matches_duration);
                    if (isset($matches_duration['1'])) {
                        $video['duration'] = duration_to_seconds($matches_duration['1']);
                    }

		    preg_match('/<a href="(.*?)" target="" title="(.*?)" class="img">/', $match, $matches_title);
                    if (isset($matches_title['2'])) {
                        $video['title'] = $matches_title['2'];
                    }
					
		   
		
		    preg_match('/<img src="(.*?)" alt="(.*?)" data-smallthumb="(.*?)" data-mediumthumb="(.*?)" class="rotating" id="(.*?)" onmouseover="(.*?)" onmouseout="(.*?)" \/>/', $match, $matches_thumb);
                    if (isset($matches_thumb['4']) && isset($matches_thumb['5'])) {
                        $thumb_url      = $matches_thumb['4'];
                        $thumb_url      = substr($thumb_url, 0, strrpos($thumb_url, '?'));
                        $thumb_url      = substr($thumb_url, 0, strrpos($thumb_url, '/'));

							
													
                        

							$remoteFile = $thumb_url.'/small1.jpg';
							$ch = curl_init($remoteFile);
							curl_setopt($ch, CURLOPT_NOBODY, true);
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
							curl_setopt($ch, CURLOPT_HEADER, true);
							curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); //not necessary unless the file redirects (like the PHP example we're using here)
							$data = curl_exec($ch);
							curl_close($ch);
							if ($data === false) {
							  echo 'cURL failed';
							  exit;
							}

							$contentLength = 'unknown';
							$status = 'unknown';
							if (preg_match('/^HTTP\/1\.[01] (\d\d\d)/', $data, $matches)) {
							  $status = (int)$matches[1];
							}
							if (preg_match('/Content-Length: (\d+)/', $data, $matches)) {
							  $contentLength = (int)$matches[1];
							}

							
													
                       

                        $video['title']     = strip_tags(stripslashes($matches_thumb['2']));
						
						if ($contentLength == 5134)
						{
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
						} else
						{
                        $video['thumbs']    = array(
                            $thumb_url.'/small.jpg',
                            $thumb_url.'/small1.jpg',
                            $thumb_url.'/small2.jpg',
                            $thumb_url.'/small3.jpg',
                            $thumb_url.'/small4.jpg',
                            $thumb_url.'/small5.jpg',
                            $thumb_url.'/small6.jpg',
                            $thumb_url.'/small7.jpg',
                            $thumb_url.'/small8.jpg',
                            $thumb_url.'/small9.jpg',
                            $thumb_url.'/small10.jpg',
                            $thumb_url.'/small11.jpg',
                            $thumb_url.'/small12.jpg',
                            $thumb_url.'/small13.jpg',
                            $thumb_url.'/small14.jpg',
                            $thumb_url.'/small15.jpg',
                            $thumb_url.'/small16.jpg',
                        );						
						}
						
                    }
//echo 'VID: ' .$video_id;
//echo var_dump($video);
//echo "==========================================================";
        
                    if ($video['title'] && $video['duration'] && $video['thumbs'] && isset($video_id)) {
						$content		= clean_html($curl->saveToString($video['url']));
						
						preg_match('/Tags: (.*?)<\/span>/', $content, $matches_tags);
                        if (isset($matches_tags['1'])) {
                            preg_match_all('/<a href="\/video\/search\?search=(.*?)">(.*?)<\/a>/', $matches_tags['1'], $matches_tag);
                            $tags   = array();
                            if (isset($matches_tag['1'])) {
                                foreach ($matches_tag['1'] as $tag) {
                                    $tags[] = prepare_string($tag, false);
                                }
                                
                                $video['tags'] = strtolower(implode(' ', $tags));
                            }
                        }
						
						$video['embed'] = '<iframe src="http://www.pornhub.com/embed/'.$video_id.'" frameborder=0 height="500" width="630" scrolling="no" name="ph_embed_video"></iframe>';




       






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