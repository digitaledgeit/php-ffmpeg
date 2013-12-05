<?php

namespace Ffmpeg;

use Ffmpeg\Stream\Video;
use Ffmpeg\Stream\Audio;
use Ffmpeg\Stream\StreamInterface;

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
	 * Gets the metadata
	 * @param 	string $file
	 * @return 	Metadata
	 */
	public function getMetadata($file) {
		
		//don't check the exit code for success, it always returns a failure
		$exitCode = Process::exec(sprintf("ffmpeg -i %s 2>&1", escapeshellarg($file)), array(
			'stdout' => $stdout = new \deit\stream\StringOutputStream(),
			'stderr' => $stderr = new \deit\stream\StringOutputStream(),
		));

		//check for an unknown command - http://tldp.org/LDP/abs/html/exitcodes.html#EXITCODESREF
		if ($exitCode == 127) { 
			throw new \Exception('An error occured whilst fetching media metadata: '.$stdout);	
		}
		
		//split the output into
		$lines = explode(PHP_EOL, (string) $stdout);
		
		//skip to the start of the input
		for ($i=0; $i<count($lines); ++$i) {
			if (substr($lines[$i], 0, 7) == 'Input #') {
				break;
			}
		}
		
		if ($i>=count($lines)) {
			echo $stdout;
			exit('ERROR!!!');
		}
		
		//parse the input section
		return $this->parseInputSection($lines, $i);
	}
	
	/**
	 * Gets the line indent
	 * @param 	string $line
	 * @return 	int
	 */
	private function getIndentDepth($line) {
		return strlen($line)-strlen(ltrim($line, ' '));
	}
	
	/**
	 * Parses the input section
	 * @param 	string[] $lines
	 */
	private function parseInputSection($lines, &$i) {
		$md = new Metadata();
		
		//gets the input line
		$line = $lines[$i];
		++$i;
		
		while ($this->getIndentDepth($lines[$i]) > 0) {

			//gets the current line
			$line = $lines[$i];
			
			//parses the metadata section
			if (substr($line, 0, 11) == '  Metadata:') {
				$this->parseMetadataSection($lines, $i, $md);
				continue;
			}
			
			//parses the metadata section
			if (substr($line, 0, 11) == '  Duration:') {
				$this->parseDurationSection($lines, $i, $md);
				continue;
			}
			
			++$i;
		}
				
		return $md;
	}
		
	/**
	 * Parses the metadata section
	 * @param 	string[] $lines
	 */
	private function parseMetadataSection($lines, &$i, Metadata $md) {
		
		//gets the metadata line
		$line = $lines[$i];
		++$i;
		
		$metadata = array();
		while ($this->getIndentDepth($lines[$i]) > 2) {
			
			//gets the current line
			$line = $lines[$i];
			
			//split into name and val
			$cols = explode(':', $line, 2);
			
			//add the metadata
			$metadata[trim($cols[0])] = trim($cols[1]);
					
			++$i;
		}
		
		$md->setMetadata($metadata);
		
	}
			
	/**
	 * Parses the duration section
	 * @param 	string[] $lines
	 */
	private function parseDurationSection($lines, &$i, Metadata $md) {
		$indent = 2;
				
		//gets the duration line
		$line = $lines[$i];
		++$i;
		
		$metadata = array();
		while ($this->getIndentDepth($lines[$i]) > 2) {
			
			//gets the current line
			$line = $lines[$i];
		
			//parses the stream section
			if (substr($line, 0, 12) == '    Stream #') {
				$this->parseStreamSection($lines, $i, $md);
				continue;
			}
			
			++$i;
		}
		
	}
			
	/**
	 * Parses the stream section
	 * @param 	string[] $lines
	 */
	private function parseStreamSection($lines, &$i, Metadata $md) {
		$indent = 4;
		
		//gets the stream line
		$line = $lines[$i];
		++$i;
		
		if (preg_match('/^    Stream #([0-9]+:[0-9]+)(.+): (Audio|Video): (.+)/', $line, $matches) < 1) {
			throw new \InvalidArgumentException("Invalid stream line {$line}"); //(Audio|Video): .*
		}
		
		$name 	= $matches[1];
		$type 	= $matches[3];
		$details = explode(',', $matches[4]);
		
		if ($type == StreamInterface::TYPE_VIDEO) {
			$stream = new Video($name);
			Video::parseDetail($stream, $details);
		} else if ($type == StreamInterface::TYPE_AUDIO) {
			$stream = new Audio($name);
			Audio::parseDetail($stream, $details);
		} else {
			throw new \InvalidArgumentException('Invalid stream type');
		}
		
		$md->addStream($stream);
			
	}
		
}