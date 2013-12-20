<?php

namespace deit\ffmpeg\stream;

/**
 * FFMPEG stream
 * @author James Newell <james@digitaledgeit.com.au>
 */
class Video extends AbstractStream {

	const PROFILE_HIGH  = 'High';

	const LEVEL_41      = 41;

	const SAR_1TO1 	    = '1:1';

	const DAR_4TO3 	    = '4:3';
	const DAR_16TO9     = '16:9';

	/**
	 * The profile
	 * @var 	string
	 */
	private $profile;

	/**
	 * The level
	 * @var 	int
	 */
	private $level;

	/**
	 * The frames rate
	 * @var 	int
	 */
	private $frameRate;
	
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
	 * Gets the profile
	 * @return 	string
	 */
	public function getProfile() {
		return $this->profile;
	}

	/**
	 * Sets the profile
	 * @param 	string $profile
	 * @return 	$this
	 */
	public function setProfile($profile) {
		$this->profile = (string) $profile;
		return $this;
	}

	/**
	 * Gets the level
	 * @return 	int
	 */
	public function getLevel() {
		return $this->level;
	}

	/**
	 * Sets the level
	 * @param 	int $level
	 * @return 	$this
	 */
	public function setLevel($level) {
		$this->level = (int) $level;
		return $this;
	}

	/**
	 * Gets the frame rate
	 * @return 	int
	 */
	public function getFrameRate() {
		return $this->frameRate;
	}
	
	/**
	 * Sets the frame rate
	 * @param 	int $rate
	 * @return 	$this
	 */
	public function setFrameRate($rate) {
		$this->frameRate = (int) $rate;
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