<?php

$autoloader = require __DIR__.'/../vendor/autoload.php';
$autoloader->add('deit\\platform', array( __DIR__.'/../src', __DIR__.'/../tests' ));

define('TEST_FIXTURE_DIRECTORY', __DIR__.'/fixtures');