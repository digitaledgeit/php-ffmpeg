<?php

namespace deit\ffmpeg;

/**
 * FFPROBE parser test
 * @author James Newell <james@digitaledgeit.com.au>
 */
class FfprobeParserTest extends \PHPUnit_Framework_TestCase {

	public function test() {
		
		$stdout = file_get_contents(__DIR__.'/../../fixtures/ffprobe-video.json');
		
		$parser = new FfprobeParser();
		$result = $parser->parse($stdout);
		$video	= $result->getVideoStream();
		
		$this->assertEquals(25, 		$video->getFramesPerSecond());
		$this->assertEquals('1:1', 		$video->getStorageAspectRatio());
		$this->assertEquals('16:9', 	$video->getDisplayAspectRatio());
		
		var_dump($result);
		
	}
	
}
 