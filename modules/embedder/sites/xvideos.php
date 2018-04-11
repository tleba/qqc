<?php
class MEmbed_xvideos
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
//echo $html;
		if ($html) {


		preg_match_all('/<div class="thumbBlock" id="video_(.*?)">(.*?)Porn quality:/', $html, $matches);
            if (isset($matches['2'])) {
                foreach ($matches['2'] as $match) {
              		
                
                    ++$count;
                    if ($count > $this->overflow) {
                        $this->errors[] = 'Overflow reached (500)! Aborting!';
                        return FALSE;
                    }
					
			$video  = array(
			'user_id'	=> $this->user_id,
                        'site'      => 'xvideos',
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

preg_match_all('/<h3 class="blackTitle"> <strong>(.*?)<\/strong>(.*?)<\/h3>/', $html, $matches);
if (isset($matches['1'])) {
$video['category']   = $matches['1'];
}
					
	            preg_match('/<p><a href="(.*?)">(.*?)<\/a><\/p>/', $match, $matches_url);
                    if (isset($matches_url['1']) && isset($matches_url['2'])) {
                        $video['url']   = 'http://www.xvideos.com'.trim($matches_url['1']);
                        $video['title'] = trim($matches_url['2']);
                        if (already_added('xvideos', $video['url'])) {
                            ++$this->video_already;
                            continue;
                        }
                    } else {
                        continue;
                    }
					

                    
                    preg_match('/<span class="duration">\((.*?) min\)<\/span>/', $match, $matches_duration);
                           
                    if (isset($matches_duration['1'])) {
                        $video['duration'] = $this->duration_to_seconds($matches_duration['1']);
                    }
					
		    preg_match('/<img src="(.*?)" id="pic_(.*?)" \/>/', $match, $matches_thumb);					
                    if (isset($matches_thumb['1']) && isset($matches_thumb['2'])) {
                        $thumb_url       = $matches_thumb['1'];
                        $thumb_url       = str_replace('.jpg', '', $thumb_url);
                        $thumb_url       = substr($thumb_url, 0, strrpos($thumb_url, '.'));
                        $video['thumbs'] = array(
                            $thumb_url.'.1.jpg',
                            $thumb_url.'.2.jpg',
                            $thumb_url.'.3.jpg',
                            $thumb_url.'.4.jpg',
                            $thumb_url.'.5.jpg',
                            $thumb_url.'.6.jpg',
                            $thumb_url.'.7.jpg',
                            $thumb_url.'.8.jpg',
                            $thumb_url.'.9.jpg',
                            $thumb_url.'.10.jpg',
                            $thumb_url.'.11.jpg',
                            $thumb_url.'.12.jpg',
                            $thumb_url.'.13.jpg',
                            $thumb_url.'.14.jpg',
                            $thumb_url.'.15.jpg',
                            $thumb_url.'.16.jpg',
                            $thumb_url.'.17.jpg',
                            $thumb_url.'.18.jpg',
                            $thumb_url.'.19.jpg',
                            $thumb_url.'.20.jpg'

                        );
                     $video_id = $matches_thumb['2'];
                    }
      


                    if ($video['title'] && $video['duration'] && $video['thumbs']) {
                        $tags           = array();
                        $tags_arr       = explode(' ', strtolower(prepare_string($video['title'], false)));
                        foreach ($tags_arr as $tag) {
                            if (strlen($tag) >= 5) {
                          		$tags[] = $tag;
                            }
                        }

                        $video['tags']  = implode(' ', $tags);
                        $video['embed'] = '<iframe src="http://flashservice.xvideos.com/embedframe/'.$video_id.'" frameborder=0 width=630 height=500 scrolling=no></iframe>';

						
//echo var_dump($video);
//echo "==========================================================";




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