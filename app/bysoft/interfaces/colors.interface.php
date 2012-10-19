<?php
namespace bysoft\interfaces;

interface Colors 
{
    public function getColoredString($string, $foreground_color = null, $background_color = null) ;
    public function getForegroundColors();
    public function getBackgroundColors();
}