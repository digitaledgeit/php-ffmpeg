<?php

namespace deit\ffmpeg\stream;

/**
 * FFMPEG stream
 * @author James Newell <james@digitaledgeit.com.au>
 */
class Audio extends AbstractStream {
				
	public static function parseDetail(Audio $video, array $details) {
		
	}
		
	/**
	 * @inheritsdoc
	 */
	public function getType() {
		return self::TYPE_VIDEO;
	}
	
}