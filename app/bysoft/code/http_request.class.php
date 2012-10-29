<?php
namespace bysoft\code;

class Http_Request {
    protected $response = null;
    protected $headers = null;
    protected $curlHandler = null;
    protected $content = null;
    protected $code = null;
    protected $isXMLRPC = false;
    
    public function addHeader($header){
        $this->headers[] = $header;
    }
    
    private function setHeaders(){
        if(empty($this->headers))
            return;
        curl_setopt($this->curlHandler, CURLOPT_HTTPHEADER, $this->headers);    
    }
    public function setXMLRPC($bool = true){
        $this->isXMLRPC = $bool;
        if($bool){
            $this->addHeader("Content-Type: text/xml");
        }
    }
    public function setReturnTransfer(){
        //curl_setopt($this->curlHandler, CURLOPT_RETURNTRANSFER, 1);
    }
    public function __construct($url){
        $this->curlHandler = curl_init($url);
        $this->response = new \bysoft\code\Http_Response();
    }
    public function request(){
        ob_start();
        $this->setHeaders();
        curl_setopt($this->curlHandler, CURLOPT_HEADER, 1);
        curl_setopt($this->curlHandler, CURLOPT_TIMEOUT, 5);
        curl_exec($this->curlHandler);
        $this->response->setContent(ob_get_contents());
        $this->response->setCode(curl_getinfo($this->curlHandler, CURLINFO_HTTP_CODE));
        ob_end_clean();
    }
    public function post($postString){
        curl_setopt($this->curlHandler, CURLOPT_POSTFIELDS, $postString);
        if($this->isXMLRPC)
            $this->addHeader("Content-Length: ".strlen($postString));
    }
    public function getResponse(){
        return $this->response;
    }
    public function __destruct(){
        
    }
}