<?php
namespace bysoft\helpers;

class cURL_Helper {

    public static function checkHTTPStatusCode($url, $code = 200) {
        ob_start();
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        $c = curl_exec($ch);
        $content = ob_get_contents();
        $retCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        ob_end_clean();
        if ($retCode == $code)
            return array('result' =>true, 'content' => $content);
        return array('result' =>false, 'content' => $content);
    }
    
    /**
     * Used to check XML string when calling an XMLRPC service
     * @param string $url
     * @param string $request XML string
     * @return string XMLRPC Response 
     */
    public static function postXMLRPC($url,$request){
        // Using the cURL extension to send it off,  first creating a custom header block
        $headers = array();
        array_push($headers,"Content-Type: text/xml");
        array_push($headers,"Content-Length: ".strlen($request));
        array_push($headers,"\r\n");

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
        $c = curl_exec($ch);
        return $c;

    }

}