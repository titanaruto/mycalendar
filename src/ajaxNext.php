<?php
$currenDate = htmlspecialchars($_POST["currentDate"]);
$event = htmlspecialchars($_POST["event"]);


require 'BL/DataMonth.php';
$DataMonth = new DataMonth();
if ($event == "next") {
    $tempTime = strtotime(date("Y-m-d", $currenDate) . '+ 1 months');
} else if ($event == "prev") {
    $tempTime = strtotime(date("Y-m-d", $currenDate) . '- 1 months');
}
$nextMonth = $DataMonth->rdate("M Y", $tempTime);

$countDayInMonth = date("t", $tempTime);
$nowDay = date("d");
$nowYear = date("Y");
$nowMonth = date("m");
$year =  date("Y",$tempTime);
$month =  date("m",$tempTime);
?>
    <caption class="datepicker-caption">
        <a href="javascript:void(0);" class="datepicker-prev">Previous</a>
        <span class="datepicker-title" data-time="<?= $tempTime; ?>"><?= $nextMonth; ?></span>
        <a href="javascript:void(0);" class="datepicker-next">Next</a>
    </caption>
    <thead class="datepicker-head">
    <tr>
        <th class="datepicker-th">Пн</th>
        <th class="datepicker-th">Вт</th>
        <th class="datepicker-th">Ср</th>
        <th class="datepicker-th">Чт</th>
        <th class="datepicker-th">Пт</th>
        <th class="datepicker-th">Сб</th>
        <th class="datepicker-th">Вс</th>
    </tr>
    </thead>
    <tbody class="datepicker-body">

    <?php
    $countDay = 1;
    $countBig = false;
    for($i = 0; $i < 5; $i++){

        echo "<tr>";

        for ($j = 0; $j< 7; $j++){
            if($countBig === false){
                if ($nowDay == $countDay && $month == $nowMonth && $year == $nowYear) {
                    $today = "today";
                } else {
                    $today = "";
                }
                $now = mktime(0, 0, 0, $month, $countDay,$year);
                $ID = date("Y-m-d", $now);
                if ($j == 5 || $j == 6) {
                    echo '<td class="datepicker-td ' . $today . ' day-off"><a href="javascript:void(0);" data-id="' . $ID . '">' . $countDay . '</a></td>';
                } else {
                    echo '<td class="datepicker-td ' . $today . '"><a href="javascript:void(0);" data-id="' . $ID . '">' .$countDay . '</a></td>';
                }
                if($countDay == $countDayInMonth){
                    $countBig = true;
                    $countDay = 0;
                }
                $countDay++;
            } else if($countBig === true) {
                $now = mktime(0, 0, 0, $month+1, $countDay,$year);
                $ID = date("Y-m-d", $now);
                echo '<td class="datepicker-td off"><a href="javascript:void(0);" data-id="' . $ID . '">' . $countDay . '</a></td>';
                $countDay++;
            }

        }


        echo "</tr>";

    }
    ?>

    <tr>
        <td colspan="7"><i class="datepicker-icon fa fa-plus-circle fa-4x" data-toggle="modal"
                           data-target="#note_Modal" aria-hidden="true"></i></td>
    </tr>
    <tbody class="result_hover"></tbody>
    </tbody>

<?php
function pre($arr)
{
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
}