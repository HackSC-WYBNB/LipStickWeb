<?php
namespace HackSC;
class Makeup{
    public static function getDealtImageB64($photoB64, $rgba, $remoteURI = 'http://localhost:5000/') : ?string{
        $photoB64 = urlencode($photoB64);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$remoteURI);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
                "image={$photoB64}&r={$rgba[0]}&g={$rgba[1]}&b={$rgba[2]}&a={$rgba[3]}");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);
        $result = json_decode($server_output,true);
        curl_close($ch);
        if($result['errno'] == 0){
            return $result['data'];
        }else{
            return null;
        }
    }
    public static function imageAsTag($imageB64){
        return '<img src="data:image/jpeg;base64, ' . $imageB64 . '" />';
    }
}