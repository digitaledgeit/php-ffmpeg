<?php

namespace Ffmpeg\Stream;

/**
 * FFMPEG stream
 * @author James Newell <james@digitaledgeit.com.au>
 */
class Video extends AbstractStream {
			
	/**
	 * Parses the detail line
	 * @param 	Video $video
	 * @param 	string[]
	 */
	public static function parseDetail(Video $video, array $details) {
		
		foreach ($details as $detail) {
			
			if (preg_match('#([0-9]+) fps#', $detail, $matches) > 0) {
				$video->setFramesPerSecond($matches[1]);
			}
			
			if (preg_match('#([0-9]+)x([0-9]+)#', $detail, $matches) > 0) {
				$video
					->setWidth($matches[1])
					->setHeight($matches[2])
				;
			}
			
		}
		
	}
	
	/**
	 * The frames per second
	 * @var 	int
	 */
	private $fps;
	
	/**
	 * The width
	 * @var 	int
	 */
	private $width;
		
	/**
	 * The height
	 * @var 	int
	 */
	private $height;
	
	/**
	 * @inheritsdoc
	 */
	public function getType() {
		return self::TYPE_VIDEO;
	}
	
	/**
	 * Gets the FPS
	 * @return 	int
	 */
	public function getFramesPerSecond() {
		return $this->fps;
	}
	
	/**
	 * Sets the FPS
	 * @param 	int $fps
	 * @return 	$this
	 */
	public function setFramesPerSecond($fps) {
		$this->fps = (int) $fps;
		return $this;
	}
	
	/**
	 * Gets the width
	 * @return 	int
	 */
	public function getWidth() {
		return $this->width;
	}
	
	/**
	 * Gets the width
	 * @param 	int $width
	 * @return 	$this
	 */
	public function setWidth($width) {
		$this->width = (int) $width;
		return $this;
	}
		
	/**
	 * Gets the height
	 * @return 	int
	 */
	public function getHeight() {
		return $this->height;
	}
		
	/**
	 * Gets the height
	 * @param 	int $height
	 * @return 	$this
	 */
	public function setHeight($height) {
		$this->height = (int) $height;
		return $this;
	}
	
}