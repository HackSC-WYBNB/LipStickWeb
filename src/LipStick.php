<?php
namespace HackSC;
class LipStick{
    public string $brand;
    public string $series;
    public string $price;
    public int $r,$g,$b;
    public ?array $addtionalInfo;
    public function __construct(string $brand, string $series, int $r, int $g, int $b, string $price = '', ?array $additionalInfo = null)
    {
        $this->brand = $brand;
        $this->series = $series;
        $this->price = $price;
        $this->r = $r;
        $this->g = $g;
        $this->b = $b;
        $this->addtionalInfo = empty($additionalInfo) ? null : $additionalInfo;
    }
    public function serializeArr() : array{
        return array(
            'brand' => $this->brand,
            'series' => $this->series,
            'price' => $this->price,
            'color' => [$this->r,$this->g,$this->b],
            'additionalInfo' => $this->addtionalInfo
        );
    }
    public function serialize() : string{
        return json_encode($this->serializeArr());
    }
    public static function deserializeArr(array $data) : LipStick{
        return new LipStick($data['brand'],$data['series'],$data['color'][0],$data['color'][1],$data['color'][2],$data['price'],$data['additionalInfo']);
    }
    public static function desearialize(string $data) : LipStick{
        return self::deserializeArr(json_decode($data,true));
    }
}