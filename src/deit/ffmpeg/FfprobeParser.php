<?php

namespace deit\ffmpeg;

use deit\ffmpeg\stream\Video;
use deit\ffmpeg\stream\Audio;
use deit\ffmpeg\stream\StreamInterface;

use deit\process\Process;
use deit\stream\StringOutputStream;

/**
 * FFPROBE wrapper
 * @author James Newell <james@digitaledgeit.com.au>
 */
class FfprobeParser {
	
	/**
	 * The FFMPEG command path
	 * @var 	string
	 */
	private $cmd;
	
	/**
	 * Constructs the wrapper
	 * @param 	string $cmd
	 */
	public function __construct($cmd = null) {
		
		if (is_null($cmd)) {
			
		} else {
			$this->cmd = $cmd;
		}
		
	}
	
	/**
	 * Parses information from multimedia streams
	 * @param 	string $stdout
	 * @return 	FfprobeResult
	 */
	public function parse($stdout) {
		$result = new FfprobeResult();
		
		//decode the JSON
		$json = json_decode($stdout);
		
		foreach ($json->streams as $jsonStream) {
			
			if ($jsonStream->codec_type == StreamInterface::TYPE_VIDEO) {
				$result->addStream($this->parseVideoStream($jsonStream));
			} else if ($jsonStream->codec_type == StreamInterface::TYPE_AUDIO) {
				$result->addStream($this->parseAudioStream($jsonStream));
			} else {
				throw new \InvalidArgumentException('Invalid stream type');
			}
			
		}
		
		
		return $result;
	}
	
	public function parseVideoStream($json) {
		$stream = new Video();
		return $stream;
	}
	
	public function parseAudioStream($json) {
		$stream = new Audio();
		return $stream;
	}
	
}