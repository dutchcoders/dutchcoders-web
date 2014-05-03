<?php
$dir = dirname(__FILE__).'/assets/cache/';
$url = 'https://api.github.com/orgs/dutchcoders/repos';
$cacheFile = $dir . 'repos.json';

//See if cache file exists
if(file_exists($cacheFile)){
    $age =  filemtime($cacheFile);
}else{
    $age = 0;
}

//If file is older then 5 minutes, get a new one :)
if(time() - $age >  360){
    
    //If we have cache, chuck it
    if(file_exists($cacheFile)){
        unlink($cacheFile);
    }
    
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $url);
    
    //GitHub demands a user agent, maybe IE1 would be funny..
    curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    $output = curl_exec($ch); 
    curl_close($ch);

    $file = fopen($cacheFile,'w+');
    fwrite($file,$output);
    fclose($file);
}

//Output file directly
echo file_get_contents($cacheFile);
exit;