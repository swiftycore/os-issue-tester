<?php
namespace bysoft\_abstract;
class Http_Disclosure extends \bysoft\_abstract\Test {
    
    private function checkUrl($url,$needle){
        // @TODO : validate url / validate needle
        $r = \bysoft\helpers\cURL_Helper::getHTTPStatusCode( $url );

        if($r['result']){
            // 'return' is true, we got a HTTP 200 status
            if(strpos($r['content'],$needle)!==false){
                return true;
            }else{
                return false;
            }
        }
    }
    
    protected function folderIsReadable($url){
        return $this->checkUrl($url,'Index'); // Index = directory listing
    }
    protected function fileIsReadable($url,$needle){
        return $this->checkUrl($url,$needle);
    }
    
    final function run(){
        parent::run();
        $this->status = self::STATUS_RUNNING;
        $this->errMessage = "FILESYSTEM DISCLOSURE\r\n";
        
        $host = \bysoft\Tester::$config['url'];

        if(!empty($this->arrFiles)){
            foreach($this->arrFiles as $file){
                if($this->fileIsReadable($host.$file['url'], $file['needle'])){
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