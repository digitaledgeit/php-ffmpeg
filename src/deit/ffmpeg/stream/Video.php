<?php

namespace deit\ffmpeg\stream;

/**
 * FFMPEG stream
 * @author James Newell <james@digitaledgeit.com.au>
 */
class Video extends AbstractStream {

	const SAR_1TO1 	= '1:1';
	const DAR_4TO3 	= '4:3';
	const DAR_16TO9 = '16:9';
	
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
			
			if (preg_match('#([0-9]+)x([0-9]+) \[SAR ([0-9]+:[0-9]+) DAR ([0-9]+:[0-9]+)\]#', $detail, $matches) > 0) {
				$video
					->setWidth($matches[1])
					->setHeight($matches[2])
					->setStorageAspectRatio($matches[3])
					->setDisplayAspectRatio($matches[4])
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
	 * Gets the storage aspect ratio
	 * @var 	string
	 */
	private $sar;
		
	/**
	 * Gets the display aspect ratio
	 * @var 	string
	 */
	private $dar;
	
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
	 * Sets the width
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
	 * Sets the height
	 * @param 	int $height
	 * @return 	$this
	 */
	public function setHeight($height) {
		$this->height = (int) $height;
		return $this;
	}
					
	/**
	 * Gets the storage aspect ratio
	 * @return 	string
	 */
	public function getStorageAspectRatio() {
		return $this->sar;
	}
		
	/**
	 * Sets the storage aspect ratio
	 * @param 	string $sar
	 * @return 	$this
	 */
	public function setStorageAspectRatio($sar) {
		$this->sar = (string) $sar;
		return $this;
	}
		
	/**
	 * Gets the display aspect ratio
	 * @return 	string
	 */
	public function getDisplayAspectRatio() {
		return $this->dar;
	}
		
	/**
	 * Sets the display aspect ratio
	 * @param 	string $dar
	 * @return 	$this
	 */
	public function setDisplayAspectRatio($dar) {
		$this->dar = (string) $dar;
		return $this;
	}
	
}