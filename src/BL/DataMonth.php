<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 28.07.2019
 * Time: 22:59
 */

class DataMonth
{
    public function getCurrentDateRus($date = "")
    {
        if (!empty($date)) {
            $currentDate = $date;
        } else {
            $currentDate = date(".m.Y");
        }

        $_monthsList = array(
            ".01." => "Января",
            ".02." => "Февраля",
            ".03." => "Марта",
            ".04." => "Апреля",
            ".05." => "Мая",
            ".06." => "Июня",
            ".07." => "Июля",
            ".08." => "Августа",
            ".09." => "Сентября",
            ".10." => "Октября",
            ".11." => "Ноября",
            ".12." => "Декабря"
        );
        $_mD = date(".m."); //для замены
        $currentDate = str_replace($_mD, " " . $_monthsList[$_mD] . " ", $currentDate);
        return $currentDate;
    }

    public function GetMonthWeek()
    {
        $dayofmonth = date('t');

        // Счётчик для дней месяца

        $day_count = 1;
        // 1. Первая неделя
        $num = 0;
        for ($i = 0; $i < 7; $i++) {
            // Вычисляем номер дня недели для числа
            $dayofweek = date('w', mktime(0, 0, 0, date('m'), $day_count, date('Y')));

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