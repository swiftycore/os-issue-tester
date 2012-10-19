<?php
namespace bysoft\helpers;

class StandardColors implements \bysoft\interfaces\colors {
    private $foreground_colors = array();
	private $background_colors = array();

	public function __construct() {
		// Set up shell colors

	}

	// Returns colored string
	public function getColoredString($string, $foreground_color = null, $background_color = null) {
		return $string;
	}

	// Returns all foreground color names
	public function getForegroundColors() {
		return array_keys($this->foreground_colors);
	}

	// Returns all background color names
	public function getBackgroundColors() {
		return array_keys($this->background_colors);
	}
}