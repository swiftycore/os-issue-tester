<?php
namespace bysoft\helpers;

class StandardColors implements \bysoft\interfaces\colors {
    private $foreground_colors = array();
    private $background_colors = array();

    public function __construct() {
    }

    public function getColoredString($string, $foreground_color = null, $background_color = null) {
        return $string;
    }

    public function getForegroundColors() {
        return array_keys($this->foreground_colors);
    }

    public function getBackgroundColors() {
        return array_keys($this->background_colors);
    }
}