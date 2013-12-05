<?php

namespace Ffmpeg;
use Ffmpeg\Stream\Audio;
use Ffmpeg\Stream\Video;
use Ffmpeg\Stream\StreamInterface;

/**
 * FFMPEG metadata
 * @author James Newell <james@digitaledgeit.com.au>
 */
class Metadata {
		
	/**
	 * The metadata
	 * @var 	string[string]
	 */
	private $metadata = array();
	
	/**
	 * The streams
	 * @var 	Stream[]
	 */
	private $streams = array();
	
	public function getMetadata() {
		return $this->metadata;
	}
		
	public function setMetadata(array $metadata) {
		$this->metadata = $metadata;
		return $this;
	}
	
	public function getStreams() {
		return $this->streams;
	}
			
	public function hasAudioStream() {
		foreach ($this->streams as $stream) {
			if ($stream instanceof Audio) {
				return true;
			}
		}
		return false;
	}
	
	public function getAudioStream() {
		foreach ($this->streams as $stream) {
			if ($stream instanceof Audio) {
				return $stream;
			}
		}
		return null;
	}
	
	public function hasVideoStream() {
		foreach ($this->streams as $stream) {
			if ($stream instanceof Video) {
				return true;
			}
		}
		return false;
	}
	
	public function getVideoStream() {
		foreach ($this->streams as $stream) {
			if ($stream instanceof Video) {
				return $stream;
			}
		}
		return null;
	}

	public function addStream(StreamInterface $stream) {
		$this->streams[] = $stream;
		return $this;
	}
	
}