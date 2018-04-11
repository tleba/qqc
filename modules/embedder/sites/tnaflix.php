<?php
class MEmbed_tnaflix
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
	     preg_match_all('/<div class="video(.*?)" id="video(.*?)">(.*?)<\/ul><\/div><\/div><\/div>/', $html, $matches);
            if (isset($matches['3'])) {
                foreach ($matches['3'] as $match) {
                    ++$count;
                    if ($count > $this->overflow) {
                        $this->errors[] = 'Overflow reached (500)! Aborting!';
                        return FALSE;
                    }
					
			$video  = array(
						'user_id'	=> $this->user_id,
                        'site'      => 'tnaflix',
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
		    
			
		    preg_match('/<a href="(.*?)" class="videoThumb" title="(.*?)">/', $match, $matches_url);
                    if (isset($matches_url['1'])) {
                        $video['url']   = 'http://www.tnaflix.com'.trim($matches_url['1']);
                        $video['title'] = trim($matches_url['2']);
                        if (already_added('tnaflix', $video['url'])) {
                            ++$this->video_already;
                            continue;
                        }
                    } else {
                        continue;
                    }


                    
                    preg_match('/<span class="duringTime">(.*?)<\/span>/', $match, $matches_duration);
	
                    
                    if (isset($matches_duration['1'])) {
                        $video['duration'] = duration_to_seconds($matches_duration['1']);
                    }
					
                   preg_match('/data-src="(.*?)"/', $match, $matches_thumb);
                    
                    
                    if (isset($matches_thumb['1'])) {
                        $thumb_url  = explode('_', $matches_thumb['1']);
                        $url_left   = substr($thumb_url['0'], 0, strrpos($thumb_url['0'], '/'));
                        $video['thumbs']    = array(
                            $url_left.'/1_'.$thumb_url['1'],
                            $url_left.'/2_'.$thumb_url['1'],
                            $url_left.'/3_'.$thumb_url['1'],
                            $url_left.'/4_'.$thumb_url['1'],
                            $url_left.'/5_'.$thumb_url['1'],
                            $url_left.'/6_'.$thumb_url['1'],
                            $url_left.'/7_'.$thumb_url['1'],
                            $url_left.'/8_'.$thumb_url['1'],
                            $url_left.'/9_'.$thumb_url['1'],
                            $url_left.'/10_'.$thumb_url['1'],
                            $url_left.'/11_'.$thumb_url['1'],
                            $url_left.'/12_'.$thumb_url['1'],
                            $url_left.'/13_'.$thumb_url['1'],
                            $url_left.'/14_'.$thumb_url['1'],
                            $url_left.'/15_'.$thumb_url['1'],
                            $url_left.'/16_'.$thumb_url['1'],
                            $url_left.'/17_'.$thumb_url['1'],
                            $url_left.'/18_'.$thumb_url['1'],
                            $url_left.'/19_'.$thumb_url['1'],
                            $url_left.'/20_'.$thumb_url['1'],
                            $url_left.'/21_'.$thumb_url['1'],
                            $url_left.'/22_'.$thumb_url['1'],
                            $url_left.'/23_'.$thumb_url['1'],
                            $url_left.'/24_'.$thumb_url['1'],
                            $url_left.'/25_'.$thumb_url['1'],
                            $url_left.'/26_'.$thumb_url['1'],
                            $url_left.'/27_'.$thumb_url['1'],
                            $url_left.'/28_'.$thumb_url['1'],
                            $url_left.'/29_'.$thumb_url['1'],
                            $url_left.'/30_'.$thumb_url['1']
                        );
                    }					
      				

                    $video_id  = explode('video', $video['url']);
                    $video_id  = $video_id['1'];

					
                    if ($video['title'] && $video['duration'] && $video['thumbs'] && isset($video_id)) {
			
                      	$video['category'] = '';
                        $video['embed'] = '<iframe src="http://player.tnaflix.com/video/'.$video_id.'" width="630" height="500" frameborder="0"></iframe>';



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