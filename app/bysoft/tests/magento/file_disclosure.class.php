<?php
namespace bysoft\tests\magento;

class File_Disclosure extends \bysoft\_abstract\Http_Disclosure {
    
    protected $arrFolders = array();
    protected $arrFiles = array();
    
    public function __construct() {
        parent::__construct();
        
        $this->arrFiles = array(
           array(
               'url' => 'app/etc/local.xml',
               'needle' => '<username>',
               'message' => 'Password found' 
           )
        );
        
        $this->arrFolders = array(
            'app/',
            'app/etc/',
            'var/',
            'var/export/',
            'var/import/',
            'var/report/'
        );
    }
}