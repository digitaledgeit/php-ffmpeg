<?php

namespace deit\ffmpeg\stream;

/**
 * FFMPEG stream
 * @author James Newell <james@digitaledgeit.com.au>
 */
abstract class AbstractStream implements StreamInterface {

	/**
	 * The codec
	 * @var 	string
	 */
	private $codec;

	private $metadata;

	/**
	 * Gets the codec
	 * @return 	string
	 */
	public function getCodec() {
		return $this->codec;
	}

	/**
	 * Sets the codec
	 * @param 	int $codec
	 * @return 	$this
	 */
	public function setCodec($codec) {
		$this->codec = (string) $codec;
		return $this;
	}

	public function getMetadata() {
		return $this->metadata;
	}
		
	public function setMetadata(array $metadata) {
		$this->metadata = $metadata;
		return $this;
	}
	
}