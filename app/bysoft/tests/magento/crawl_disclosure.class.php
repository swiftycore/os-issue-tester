<?php
namespace bysoft\tests\magento;

class Crawl_Disclosure extends \bysoft\code\Http_Disclosure {
    
    protected $arrFolders = array();
    protected $arrFiles = array();
    
    public function __construct() {
        parent::__construct();
        $this->arrFiles = array(
           array(
               'url' => 'robots.txt',
               'needle' => 'Disallow *',
               'assert' =>  \bysoft\code\Http_Disclosure::ASSERT_CONTAINING,
               'message' => 'Site is crawlable' 
           )
        );
    }
}