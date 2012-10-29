<?php
namespace bysoft\code;

class Http_Response {
    private $code = null;
    private $content = null;
    public function getContent(){
        return $this->content;
    }
    public function getCode(){
        return $this->code;
    }
    public function setContent($content){
        $this->content = $content;
    }
    public function setCode($code){
        $this->code = $code;
    }
}