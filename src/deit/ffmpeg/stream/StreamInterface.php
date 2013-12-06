<?php

namespace deit\ffmpeg\stream;

/**
 * FFMPEG stream
 * @author James Newell <james@digitaledgeit.com.au>
 */
interface StreamInterface {
	
	const TYPE_AUDIO = 'Audio';
	const TYPE_VIDEO = 'Video';
	
	/**
	 * Gets the stream type
	 * @return 	string
	 */
	public function getType();
	
	/**
	 * Gets the metadata
	 * @return 	string[string]
	 */
	public function getMetadata();
	
	public function setMetadata(array $metadata);
	
}