<?php
namespace bysoft\_abstract;

/**
 *  
 */
class Http_Disclosure extends \bysoft\_abstract\Test {
    /**
     * Check if an needle is in a response of an url
     * @param string $url
     * @param string $needle
     * @return boolean 
     */
    private function checkUrl($url, $needle){
        // @TODO : validate url / validate needle
        $r = \bysoft\helpers\cURL_Helper::checkHTTPStatusCode( $url );

        if($r['result']){
            // 'result' is true, we got a HTTP 200 status
            if(strpos($r['content'],$needle)!==false){
                return true;
            }else{
                return false;
            }
        }
    }
    
    /**
     * Detect if the response contains the word "Index" 
     * @param string $url
     * @return bool 
     */
    protected function folderIsReadable($url){
        return $this->checkUrl($url,'Index'); // Index = directory listing
    }
    
    
    /**
     * Run this test
     * @return $this->status 
     */
    final function run(){
        parent::run();
        $this->status = self::STATUS_RUNNING;
        $this->errMessage = "FILESYSTEM DISCLOSURE\r\n";
        
        $host = \bysoft\Tester::$config['url'];

        if(!empty($this->arrFiles)){
            foreach($this->arrFiles as $file){
                if($this->checkUrl($host.$file['url'], $file['needle'])){
                    $this->errMessage .= "\t". $host. $file['url'] . " => ".$file['message'].".\r\n";
                    $this->status = self::STATUS_FAIL;
                }
            }
        }
        if(!empty($this->arrFolders)){
            foreach($this->arrFolders as $folder){
                if($this->folderIsReadable($host.$folder)){
                    $this->errMessage .= "\t".$host . $folder . " readable.\r\n";
                    $this->status = self::STATUS_FAIL;
                }
            }
        }
        return $this->status;
    }
}