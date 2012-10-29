<?php
namespace bysoft\tests\magento;

class File_Disclosure extends \bysoft\code\Http_Disclosure {
    
    protected $arrFolders = array();
    protected $arrFiles = array();
    
    public function __construct() {
        parent::__construct();
        
        $this->arrFiles = array(
           array(
               'url' => 'app/etc/local.xml',
               'needle' => '<username>',
               'message' => 'Password found',
               'assert' => \bysoft\code\Http_Disclosure::ASSERT_NOT_CONTAINING
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