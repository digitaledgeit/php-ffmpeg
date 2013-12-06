<?php

namespace deit\ffmpeg\stream;

/**
 * FFMPEG stream
 * @author James Newell <james@digitaledgeit.com.au>
 */
interface StreamInterface {
	
	const TYPE_AUDIO = 'audio';
	const TYPE_VIDEO = 'video';
	
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