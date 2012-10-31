<?php
namespace bysoft\code\generic;

/**
 *  
 */
class Http_Disclosure extends \bysoft\_abstract\Test {
    
    /**
     * Detect if the response contains the word "Index" 
     * @param string $url
     * @return bool 
     */
    protected function folderIsReadable($url){
        $request = new \bysoft\code\Http_Request($url);
        $request->request();
        $response = $request->getResponse();
        return $this->isStringContainingNeedle($response->getContent(), 'Index');  // Index = directory listing
    }
    
    protected function fileIsContainingNeedle($url,$needle){
        $request = new \bysoft\code\Http_Request($url);
        $request->setReturnTransfer();
        $request->request();
        $response = $request->getResponse();
        return $this->isStringContainingNeedle($response->getContent(), $needle);
    }
    
    protected function fileIsNotContainingNeedle($url,$needle){
        if($this->fileIsContainingNeedle($url, $needle))
            return false;
        return true;
    }
    
    protected function setErrorMessage($test){
        $host = \bysoft\Tester::$config['url'];
        $this->errMessage .= "\t". $host. $test['url'] . "  => ".$test['message'].".\r\n";
        $this->status = self::STATUS_FAIL;
    }
    
    
    /**
     * Run this test
     * @return $this->status 
     */
    public function run(){

        $this->status = self::STATUS_RUNNING;
        $this->errMessage = "FILESYSTEM DISCLOSURE\r\n";
        
        $host = \bysoft\Tester::$config['url'];

        if(!empty($this->arrFiles)){
            foreach($this->arrFiles as $file){
                if(isset($file['assert'])){
                    switch($file['assert']){
                        case self::ASSERT_CONTAINING :
                            if($this->fileIsContainingNeedle($host . $file['url'], $file['needle'])){
                                $this->status = self::STATUS_OK;
                            }else{
                                $this->setErrorMessage($file);
                            }
                            break;
                        case self::ASSERT_NOT_CONTAINING :
                            if($this->fileIsNotContainingNeedle($host . $file['url'], $file['needle'])){
                                $this->status = self::STATUS_OK;
                            }else{
                                $this->setErrorMessage($file);
                            }
                            break;
                    }
                }
            }
        }
        if(!empty($this->arrFolders)){
            $arrFolder = array();
            foreach($this->arrFolders as $folder){
                $arrFolder['url'] = $folder;
                $arrFolder['message'] = 'Directory listing allowed';
                if($this->folderIsReadable($host.$folder)){
                    $this->setErrorMessage($arrFolder);
                }
            }
        }
        return $this->status;
    }
}