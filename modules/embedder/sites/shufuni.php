<?php
class MEmbed_shufuni
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
	    preg_match_all('/<div class="HomepageblockOneImage" style="margin-right: 3px !important;">(.*?)<\/table>/', $html, $matches);
        if (isset($matches['1'])) {
											foreach ($matches['1'] as $match) {
												++$count;
												if ($count > $this->overflow) {
													$this->errors[] = 'Overflow reached (500)! Aborting!';
													return FALSE;
												}
												
										$video  = array(
										'user_id'	=> $this->user_id,
													'site'      => 'shufuni',
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
												
										preg_match('/<a href="(.*?)" id="/', $match, $matches_url);
												if (isset($matches_url['1'])) {
													$video['url']   = 'http://www.shufuni.com'.trim($matches_url['1']);
													
													if (already_added('shufuni', $video['url'])) {
														++$this->video_already;
														continue;
													}
												} else {
													continue;
												}
										
										preg_match('/title="(.*?)"/', $match, $matches_title);
												if (isset($matches_title['1'])) {
										$video['title']  = $matches_title['1'];
												}


										preg_match('/<div class="TimeVideo"> (.*?)<\/div>/', $match, $matches_duration);
												if (isset($matches_duration['1'])) {
													$video['duration'] = duration_to_seconds($matches_duration['1']);
												}
												
										preg_match('/<img src="(.*?)" id="(.*?)" class="(.*?)" type="(.*?)" num="(.*?)" \/>/', $match, $matches_thumb);

										if (isset($matches_thumb['1'])) {
													
													$thumb_url       = $matches_thumb['1'];
													$thumb_url       = substr($thumb_url, 0, (strrpos($thumb_url, '.')-2));
													$video['thumbs'] = array(
														$thumb_url.'01.jpg',
														$thumb_url.'02.jpg',
														$thumb_url.'03.jpg',
														$thumb_url.'04.jpg',
														$thumb_url.'05.jpg',
														$thumb_url.'06.jpg',
														$thumb_url.'07.jpg',
														$thumb_url.'08.jpg',
														$thumb_url.'09.jpg',
														$thumb_url.'10.jpg',
														$thumb_url.'11.jpg',
														$thumb_url.'12.jpg',
														$thumb_url.'13.jpg',
														$thumb_url.'14.jpg',
														$thumb_url.'15.jpg',
														$thumb_url.'16.jpg',
														$thumb_url.'17.jpg',
														$thumb_url.'18.jpg',
														$thumb_url.'19.jpg',
														$thumb_url.'20.jpg',
														$thumb_url.'21.jpg',
														$thumb_url.'22.jpg',
														$thumb_url.'23.jpg',
														$thumb_url.'24.jpg',
														$thumb_url.'25.jpg',
														$thumb_url.'26.jpg',
														$thumb_url.'27.jpg',
														$thumb_url.'28.jpg',
														$thumb_url.'29.jpg',
														$thumb_url.'30.jpg'
													);
												}


							if ($video['title'] && $video['duration'] && $video['thumbs']) {
							$content		= clean_html($curl->saveToString($video['url']));

							preg_match('/id="cphBody_TextBoxEmbedCode" class="inputShare" value="(.*?)&lt;div>&lt;a/', $content, $matches_code);
							if (isset($matches_code['1']) && $matches_code['1']) {
								$video_code = $matches_code['1'];
							}
                                                        $video_code = html_entity_decode($video_code);
							$video_code = str_replace('603', '630', $video_code);
							$video_code = str_replace('475', '500', $video_code);
											
							$tags   = array();                            
							$video['embed'] = $video_code;



									if (add_video($video, $this->category)) {
														++$this->video_added;
									} else {
														$this->errors[] = 'Failed to add '.$video['url'].'!';
									}
													
												} else {
													$this->errors[] = 'Failed to get video details for '.$video['url'].'!';
												}
											}
											
			
				
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