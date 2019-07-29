<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 28.07.2019
 * Time: 22:59
 */

class DataMonth
{


    public function rdate($param, $time=0) {
        if(intval($time)==0)$time=time();
        $MonthNames=array("Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь");
        if(strpos($param,'M')===false) return date($param, $time);
        else return date(str_replace('M',$MonthNames[date('n',$time)-1],$param), $time);
    }



    public function GetMonthWeek($month = null,$year = null)
    {

        if(!empty($month)){
            $m = $month;
        } else{
            $m = date('m');
        }
        if(!empty($year)){
            $y = $year;
        } else{
            $y = date('Y');
        }


        $dayofmonth = date('t');

        // Счётчик для дней месяца

        $day_count = 1;
        // 1. Первая неделя
        $num = 0;
        for ($i = 0; $i < 7; $i++) {
            // Вычисляем номер дня недели для числа
            $dayofweek = date('w', mktime(0, 0, 0, $m, $day_count, $y));

            // Приводим к числа к формату 1 - понедельник, ..., 6 - суббота
            $dayofweek = $dayofweek - 1;
            if ($dayofweek == -1) $dayofweek = 6;
            if ($dayofweek == $i) {
                // Если дни недели совпадают,
                // заполняем массив $week
                // числами месяца
                $week[$num][$i] = $day_count;
                $day_count++;
            } else {
                $week[$num][$i] = "";
            }
        }

        // 2. Последующие недели месяца
        while (true) {
            $num++;
            for ($i = 0; $i < 7; $i++) {
                $week[$num][$i] = $day_count;
                $day_count++;
                // Если достигли конца месяца - выходим
                // из цикла
                if ($day_count > $dayofmonth) break;
            }
            // Если достигли конца месяца - выходим
            // из цикла
            if ($day_count > $dayofmonth) break;
        }
        return $week;
    }
}