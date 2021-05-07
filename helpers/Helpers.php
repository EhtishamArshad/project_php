<?php

namespace Project\Helpers;
require 'assets/blade/lib/BladeOne.php';
use eftec\bladeone;

class Helpers 
{

	/**
	 * Load blade templating library
	 *
	 * @return bladeone\BladeOne
	 */
	function loadBladeLibrary() {
		$views = dirname( __DIR__, 1 ) . DIRECTORY_SEPARATOR . 'views'; // it uses the folder /views to read the templates
		$cache = dirname( __DIR__, 1 ) . DIRECTORY_SEPARATOR . 'cache'; // it uses the folder /cache to compile the result.

		return new bladeone\BladeOne( $views, $cache );
	}
}
	