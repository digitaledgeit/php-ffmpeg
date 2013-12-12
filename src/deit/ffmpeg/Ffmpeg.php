<?php

namespace deit\ffmpeg;

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
	 * @param 	string  $file
	 * @return 	FfprobeResult
	 * @throws
	 */
	public function probe($file) {

		//run ffprobe
		$cmd = sprintf("ffprobe -print_format json -show_format -show_streams %s", escapeshellarg($file));
		$exitCode = Process::exec($cmd, array(
			'stdout' => $stdout = new StringOutputStream(),
			'stderr' => $stderr = new StringOutputStream(),
		));

		//check the command was successful
		if ($exitCode != Process::EXIT_SUCCESS) {
			throw new \Exception('An error occured whilst inspecting the media: '.$stderr);
		}

		$parser = new FfProbeParser();
		return $parser->parse((string) $stdout);
	}
	
}