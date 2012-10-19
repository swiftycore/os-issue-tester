<?php
define('ROOT_DIR',dirname(__FILE__) . DIRECTORY_SEPARATOR );

include 'app/autoload.php';

use \bysoft;

$technos = parse_ini_file("websites.ini", true);

foreach($technos as $techno=>$websites){
    $urls = $websites['url'];
    foreach($urls as $url){
        \bysoft\Tester::run(array(
            'url' => $url,
            'techno' => $techno,
            'is_shell' => true
        ));
    }
}