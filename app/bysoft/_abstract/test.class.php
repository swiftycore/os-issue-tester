<?php
namespace bysoft\_abstract;

abstract class Test implements \bysoft\interfaces\Test {
    const STATUS_OK = 1;
    const STATUS_RUNNING = 0;
    const STATUS_FAIL = -1;
    const ASSERT_CONTAINING = 10;
    const ASSERT_NOT_CONTAINING = 11;

    protected $errMessage = null;
    protected $status = null;

    public function __construct(){
        $this->status = self::STATUS_RUNNING;
    }

    protected function isStringContainingNeedle($string,$needle){
        if(strpos($string,$needle)===false)
            return false;
        return true;
    }

    public function run(){
    }

    public function getStatus(){
        return $this->status;
    }

    public function __toString(){
        return $this->errMessage;
    }

    public function getName(){
        return get_class($this);
    }

}