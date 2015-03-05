<?php
/**
 * Created by PhpStorm.
 * User: nghia
 * Date: 2/7/15
 * Time: 7:56 PM
 */

namespace Core;


/**
 * Class ZScore
 * @package Core
 */
class ZScore
{
    /**
     * @var
     */
    protected $day;

    /**
     * @var
     */
    protected $interaction;

    /**
     * @var
     */
    protected $sqr_interaction;

    /**
     * @param $day
     * @param $interaction
     * @param $sqr_interaction
     */
    function __construct($day, $interaction, $sqr_interaction)
    {
        $this->day = $day;
        $this->interaction = $interaction;
        $this->sqr_interaction = $sqr_interaction;
    }

    /**
     * @return float|int
     */
    protected function avg()
    {
        if ($this->day == 0){
            return 0;
        } else return $this->interaction / $this->day;
    }

    /**
     * @return float|int
     */
    protected function std()
    {
        if ($this->day == 0){
            return 1;
        } else
        return sqrt(
            ($this->sqr_interaction / $this->day) - pow($this->avg(), 2)
        );
    }

    /**
     * @param $interaction_now
     * @return float
     */
    public function score($interaction_now){
        if ($this->std() == 0) return $interaction_now - $this->avg();
        else return (($interaction_now - $this->avg()) / $this->std());
    }
} 