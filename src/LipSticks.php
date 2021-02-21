<?php
namespace HackSC;
class LipSticks{
    public static ?array $lipStickData = null;
    public static ?array $parsedLipSticks = null;
    public static function getLipstickLists() : array{
        if(empty(self::$lipStickData)){
            self::$lipStickData = json_decode(file_get_contents(__DIR__ . '/../data/lipstick_enus.json'),true);
        }
        if(!empty(self::$parsedLipSticks)){
            return self::$parsedLipSticks;
        }
        $resultArr = [];
        foreach(self::$lipStickData['brands'] as $brandData){
            $currentBrand = $brandData['Brand'];
            foreach($brandData['series'] as $seriesData){
                $currentSeriesName = !empty($seriesData['SeriesName']) ? $seriesData['SeriesName'] : $seriesData['Series'];
                $currentPrice = $seriesData['price'];
                if(empty($currentSeriesName)){
                    $currentSeriesName = '';
                }
                if(empty($currentPrice)){
                    $currentPrice = '';
                }
                foreach($seriesData['lipsticks'] as $lipstickData){
                    $currentColorStr = $lipstickData['color'];
                    $currentIDStr = $lipstickData['id'];
                    $currentID = intval($currentIDStr);
                    $currentColorRStr = substr($currentColorStr,1,2);
                    $currentColorGStr = substr($currentColorStr,3,2);
                    $currentColorBStr = substr($currentColorStr,5,2);
                    $colorR = hexdec($currentColorRStr);
                    $colorG = hexdec($currentColorGStr);
                    $colorB = hexdec($currentColorBStr);
                    $resultArr[] = new LipStick($currentBrand,$currentSeriesName,$colorR,$colorG,$colorB,$currentPrice,array('id'=>$currentID));
                }
            }
        }
        self::$parsedLipSticks = $resultArr;
        return $resultArr;
    }
}