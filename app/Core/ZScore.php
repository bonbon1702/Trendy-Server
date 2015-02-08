<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 2/7/15
 * Time: 7:56 PM
 */

namespace Core;


class ZScore
{
    protected $day;

    protected $interaction;

    protected $sqr_interaction;

    function __construct($day, $interaction, $sqr_interaction)
    {
        $this->day = $day;
        $this->interaction = $interaction;
        $this->sqr_interaction = $sqr_interaction;
    }

    protected function avg()
    {
        if ($this->day == 0){
            return 0;
        } else return $this->interaction / $this->day;
    }

    protected function std()
    {
        if ($this->day == 0){
            return 1;
        } else
        return sqrt(
            ($this->sqr_interaction / $this->day) - pow($this->avg(), 2)
        );
    }

    public function score($interaction_now){
        if ($this->std() == 0) return $interaction_now - $this->avg();
        else return (($interaction_now - $this->avg()) / $this->std());
    }
} 