<?php
namespace bysoft\tests\magento;

class Status_Disclosure extends \bysoft\code\generic\Http_Disclosure {

    protected $arrUrlCode = array();

    public function __construct() {
        parent::__construct();

        $this->arrUrlCode = array(
            array(
                'queryString' => '/',
                'message' => 'Homepage is 404',
            ),
            array(
                'queryString' => '123456TestErrorCode',
                'goodCode' => '404',
                'message' => '404 page return bad status',
            )
        );
    }
}