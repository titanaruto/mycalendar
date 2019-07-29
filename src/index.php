<?php

include('views/includes/head.php'); ?>
</head>
<body>
<table class="datepicker">
    <?php
    require 'BL/DataMonth.php';
    $DataMonth = new DataMonth();
    $currentDate = $DataMonth->rdate("M Y");
    $nowDay = date("d");
    $countDayInMonth = date("t");
    $year =  date("Y");
    $month =  date("m");
    ?>

    <caption class="datepicker-caption">
        <a href="javascript:void(0);" class="datepicker-prev">Previous</a>
        <span class="datepicker-title" data-time="<?=strtotime(date('Y-m-01'));?>"><?= $currentDate; ?></span>
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
                    if ($nowDay == $countDay) {
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


</table>
<!-- Modal -->
<div class="modal fade" id="note_Modal" tabindex="-1" role="dialog" aria-labelledby="note_Modal"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Добавления заметки</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" class="form_note">
                <div class="modal-body">

                    <div class="form-group">
                        <div class='input-group date'>

                            <input type="date" id="date_note" required class="form-control fa fa-calendar"
                                   name="date_note">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description_note">Описание</label>
                        <textarea class="form-control" name="description_note" required id="description_note"
                                  rows="3"></textarea>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <input type="submit" class="btn btn-primary" id="save_note" value="Сохранить"/>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
