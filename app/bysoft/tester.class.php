<?php
namespace bysoft;

class Tester {

    public $tests = array();
    public static $config = null;
    private $oColor = null;
    private static $_instance = null;
    private $outputStream = null;
    private static $failedTests = false;
    
    const STREAM_WRITER = "php://output";
    
    const LEVEL_INFO = 0;
    const LEVEL_OK = 1;
    const LEVEL_WARN = 2;
    const LEVEL_ERR = 3;

    private function __construct($outputStream = self::STREAM_WRITER, $isShell = true) {
        $this->outputStream = fopen($outputStream,'w+');
        if($isShell)
            $this->oColor = new \bysoft\helpers\ShellColors();
        else
            $this->oColor = new \bysoft\helpers\StandardColors();
        
        $this->loadTests();
    }
    
    public function __destruct(){
        fclose($this->outputStream);
    }
    
    public function output($level,$message){
        $bgColor = 'black';
        switch($level){
            case self::LEVEL_ERR:
                $strColor = 'red';
                break;
            case self::LEVEL_WARN:
                $strColor = 'orange';
                break;
            case self::LEVEL_INFO:
                $strColor = 'yellow';
                break;
            case self::LEVEL_OK:
            default:
                $strColor = 'green';
                break;
        }
        
        fwrite($this->outputStream,$this->oColor->getColoredString($message,$strColor,$bgColor));
    }
    public function outputTestResult($test){
        switch($test->getStatus()){
            case \bysoft\_abstract\Test::STATUS_FAIL :
                self::$failedTests = true;
                $this->output(self::LEVEL_ERR,"\r\n\r\nFAILED TEST : " . $test);
                break;
            case \bysoft\_abstract\Test::STATUS_OK :
                //$this->output(self::LEVEL_OK,"YEAH");
                break;
        }
    }
    public function loadTests() {
        $this->output(self::LEVEL_OK,"Loading tests...\r\n");
        foreach (glob(ROOT_DIR . 'app/bysoft/tests/'.self::$config['techno'].'/*.class.php') as $test) {
            $test = '\bysoft\tests\\' . self::$config['techno'] .'\\' . str_replace('.class.php','',basename($test));
            $this->output(self::LEVEL_OK,"\r\nLoading test : [".$test."] ");
            $this->tests[] = new $test;
        }
    }

    public static function run($config) {
        self::$config = $config;
        self::$failedTests = false;
        $tester = self::getSingleton();
        
        $tester->output(self::LEVEL_INFO,"\r\n============================================\r\n");
        
        $tester->output(self::LEVEL_OK,"\r\nStarting tests for : ".self::$config['url']."\r\n");
        foreach($tester->tests as $test){
            $test->run();
            $tester->outputTestResult($test);
        }
        if(!self::$failedTests)
            $tester->output(self::LEVEL_OK,"\r\n[ OK ] End of tests for : ".self::$config['url']."\r\n\r\n");
        else
            $tester->output(self::LEVEL_ERR,"\r\n[ ERR ] End of tests for : ".self::$config['url']."\r\n\r\n");
        
        
    }
    
    public static function getSingleton() {
        if (is_null(self::$_instance)) {
            self::$_instance = new \bysoft\Tester(self::STREAM_WRITER, self::$config['is_shell']);
        }
        return self::$_instance;
    }

}