<?php

namespace deit\ffmpeg;

use deit\ffmpeg\stream\Video;
use deit\ffmpeg\stream\Audio;
use deit\ffmpeg\stream\StreamInterface;

use deit\process\Process;
use deit\stream\StringOutputStream;

/**
 * FFMPEG wrapper
 * @author James Newell <james@digitaledgeit.com.au>
 */
class Ffmpeg {
	
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
	 * Gathers information from multimedia streams
	 * @param 	string $file
	 * @return 	Metadata
	 */
	public function probe($file) {
		
		//don't check the exit code for success, it always returns a failure
		$exitCode = Process::exec(sprintf("ffprobe -v quiet -print_format json -show_format -show_streams %s", escapeshellarg($file)), array(
			'stdout' => $stdout = new \deit\stream\StringOutputStream(),
			'stderr' => $stderr = new \deit\stream\StringOutputStream(),
		));

		//check for an unknown command - http://tldp.org/LDP/abs/html/exitcodes.html#EXITCODESREF
		if ($exitCode == 127) { 
			throw new \Exception('An error occured whilst fetching media metadata: '.$stdout);	
		}

		$parser = new FfProbeParser();
		return $parser->parse((string)$stdout);
	}
	
}