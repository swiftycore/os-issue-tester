<?php
namespace bysoft\code\generic;

/**
 *  
 */
class XmlRpc_Disclosure extends \bysoft\_abstract\Test {
    
    public function postString($url,$string){
        $request = new \bysoft\code\Http_Request($url);
        $request->setXMLRPC();
        $request->post($string);
        $request->request();
        return $request;
    }
    
    public function run(){

    }
}