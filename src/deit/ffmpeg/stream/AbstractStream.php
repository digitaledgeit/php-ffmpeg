<?php

namespace deit\ffmpeg\stream;

/**
 * FFMPEG stream
 * @author James Newell <james@digitaledgeit.com.au>
 */
abstract class AbstractStream implements StreamInterface {

	private $name;
	private $metadata;
	
	public function getName() {
		return $this->name;
	}
	
	public function getMetadata() {
		return $this->metadata;
	}
		
	public function setMetadata(array $metadata) {
		$this->metadata = $metadata;
		return $this;
	}
	
}