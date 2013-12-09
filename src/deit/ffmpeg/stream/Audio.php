<?php

namespace deit\ffmpeg\stream;

/**
 * FFMPEG stream
 * @author James Newell <james@digitaledgeit.com.au>
 */
class Audio extends AbstractStream {

	/**
	 * The number of channels
	 * @var 	int
	 */
	private $channels;

	/**
	 * The sample rate in Hz - The number of samples per unit of time
	 * @var 	int
	 */
	private $sampleRate;

	/**
	 * The bit rate in bits per second - the number of bits per sample
	 * @var 	int
	 */
	private $bitRate;

	/**
	 * @inheritsdoc
	 */
	public function getType() {
		return self::TYPE_VIDEO;
	}

	/**
	 * Gets the number of channels
	 * @return 	int
	 */
	public function getChannels() {
		return $this->channels;
	}

	/**
	 * Sets the sample channels
	 * @param 	int $channels
	 * @return 	$this
	 */
	public function setChannels($channels) {
		$this->channels = (int) $channels;
		return $this;
	}

	/**
	 * Gets the sample rate
	 * @return 	int
	 */
	public function getSampleRate() {
		return $this->sampleRate;
	}

	/**
	 * Sets the sample rate
	 * @param 	int $rate
	 * @return 	$this
	 */
	public function setSampleRate($rate) {
		$this->sampleRate = (int) $rate;
		return $this;
	}

	/**
	 * Gets the bit rate
	 * @return 	int
	 */
	public function getBitRate() {
		return $this->bitRate;
	}

	/**
	 * Sets the bit rate
	 * @param 	int $rate
	 * @return 	$this
	 */
	public function setBitRate($rate) {
		$this->bitRate = (int) $rate;
		return $this;
	}

}