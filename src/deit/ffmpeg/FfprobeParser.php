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
	 * @param 	string $output
	 * @return 	FfprobeResult
	 * @throws
	 */
	public function parse($output) {
		$result = new FfprobeResult();

		//decode the JSON
		if (empty($output) || ($json = json_decode($output)) == false) {
			throw new \InvalidArgumentException('Unable to parse ffprobe output');
		}

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

	/**
	 * Parses the audio stream
	 * @param   mixed $json
	 * @return  Audio
	 */
	public function parseAudioStream($json) {
		$stream = new Audio();

		//set the codec
		$stream
			->setCodec($json->codec_name)
		;

		//set the duration
		$stream->setDuration($json->duration);

		//set the channels
		$stream
			->setChannels($json->channels)
		;

		//set the sample rate
		$stream
			->setSampleRate($json->sample_rate)
		;

		//set the bit rate
		$stream
			->setBitRate($json->bit_rate)
		;

		return $stream;
	}

	/**
	 * Parses the video stream
	 * @param   mixed $json
	 * @return  Video
	 */
	public function parseVideoStream($json) {
		$stream = new Video();
		
		//set the codec
		$stream
			->setCodec($json->codec_name)
		;

		//set the duration
		$stream->setDuration($json->duration);

		//set the profile
		if (isset($json->profile)) {
			$stream->setProfile($json->profile);
		}

		//set the level
		if (isset($json->level)) {
			$stream->setLevel($json->level);
		}

		//set the frame rate
		$arg    = explode('/', $json->avg_frame_rate);
		if ($arg[1] != 0) { //fixme: warn for an invalid frame rate?
			$stream->setFrameRate((int) $arg[0] / (int) $arg[1]);
		}


		//set the width and height
		$stream
			->setWidth($json->width)
			->setHeight($json->height)
			->setDisplayAspectRatio($json->display_aspect_ratio)
		;

		return $stream;
	}
	
}