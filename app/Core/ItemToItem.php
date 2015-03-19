<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 10/03/2015
 * Time: 22:02
 */

namespace Core;

class ItemToItem
{
    private $dot_product = array();
    private $length_1 = array();
    private $length_2 = array();

    public function insert($user_data)
    {
        foreach ($user_data as $k => $v) {
            foreach ($v as $k1 => $v1) {
                if (empty($this->dot_product[$k1])) $this->dot_product[$k1] = array();
                if (empty($this->length_1[$k1])) $this->length_1[$k1] = array();
                if (empty($this->length_2[$k1])) $this->length_2[$k1] = array();

                foreach ($v as $k2 => $v2) {

                    if ($k1 !== $k2) {
                        if (empty($this->dot_product[$k1][$k2])) $this->dot_product[$k1][$k2] = 0;
                        if (empty($this->length_1[$k1][$k2])) $this->length_1[$k1][$k2] = 0;
                        if (empty($this->length_2[$k1][$k2])) $this->length_2[$k1][$k2] = 0;

                        $this->dot_product[$k1][$k2] += $v1 * $v2;
                        $this->length_1[$k1][$k2] += $v1 * $v1;
                        $this->length_2[$k1][$k2] += $v2 * $v2;
                    }
                }
            }
        }

        foreach ($this->dot_product as $k => $v) {

            foreach ($v as $k1 => $v1) {
                if ($this->length_1[$k][$k1] == 0 || $this->length_2[$k][$k1] == 0) continue;

                $this->dot_product[$k][$k1] = $v[$k1] / (sqrt($this->length_1[$k][$k1]) * sqrt($this->length_2[$k][$k1]));
            }
        }
    }


    public function predict($name)
    {
        foreach ($this->dot_product as $k => $v) {
            if ($k == $name){
                return $v;
            }
        }
    }

}