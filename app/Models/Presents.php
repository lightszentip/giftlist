<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presents extends Model
{
    use HasFactory;

    public function links()
    {
        return $this->hasMany(PresentLinks::class);
    }

    public function usePresent(bool $isCodeActive = false)
    {
        $this->status = 1;
        if($isCodeActive) {
            $code = "";
            $count = 0;
            while($count > 0) {
                $code = $this->getCodeValue();
                $count = Presents::whereCode($code)->count();
            }
            $this->code = $code;
        }
    }

    public function shortDescription(int $size = 100) {
        // strip tags to avoid breaking any html
        $string = strip_tags($this->description);
        if (strlen($string) > $size) {
            $stringCut = substr($string, 0, $size);
            $posWhitespace = strrpos($stringCut, ' ');
            $string = substr($stringCut, 0, $posWhitespace) . '...';
        }
        return $string;
    }

    public function isImageExists() {
        return !empty($this->imagepath) &&  $this->imagepath != " ";
    }

    public function releasePresent()
    {
        $this->status = 1;
    }

    private function getCodeValue() {
        $signs =  array_merge(range('A', 'Z'), range(0, 9), array('$', '%', '/', '(', '_', '-', ';'));
        $int_array = count($signs);
        $dates = array(date("Hmsdi"), date("Hdims"), date("msHdi"));
        $code = hash("crc32b", $dates[rand(0, count($dates) - 1)] . rand(0, 99));
        for ($i = 0; $i < 35; $i++) {
            $code .= $signs[rand(0, $int_array - 1)];
        }
        return $code;
    }
}
