<?php
namespace bysoft\tests\joomla;

class File_Disclosure extends \bysoft\_abstract\Http_Disclosure {
    
    protected $arrFolders = array();
    protected $arrFiles = array();
    
    public function __construct() {
        parent::__construct();
        
        $this->arrFolders = array(
            'administrator/',
            'cli/',
            'components/',
            'installation/',
            'tmp/',
            'modules/',
            'plugins/'
        );
    }
}