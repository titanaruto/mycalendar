<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 28.07.2019
 * Time: 22:59
 */

class DataMonth
{
    //show rus month date
    public function rdate($param, $time=0) {
        if(intval($time)==0)$time=time();
        $MonthNames=array("Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь");
        if(strpos($param,'M')===false) return date($param, $time);
        else return date(str_replace('M',$MonthNames[date('n',$time)-1],$param), $time);
    }
}