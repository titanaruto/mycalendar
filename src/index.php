<?php

include('views/includes/head.php'); ?>
</head>
<body>
<table class="datepicker">
    <?php
    require 'BL/DataMonth.php';
    $DataMonth = new DataMonth();
    $currentDate = $DataMonth->getCurrentDateRus();
    $week = $DataMonth->GetMonthWeek();


    require 'BL/DataMapper.php';
    $DataMapper = new DataMapper();
    $notes = $DataMapper->getAllNote();
//    print_r($notes);
    ?>

    <caption class="datepicker-caption">
        <a href="index.html" class="datepicker-prev">Previous</a>
        <span class="datepicker-title"><?= $currentDate; ?></span>
        <a href="index.html" class="datepicker-next">Next</a>
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
    $count = 1;
    for ($i = 0; $i < count($week); $i++) {
        echo "<tr>";
        for ($j = 0; $j < 7; $j++) {
            if (!empty($week[$i][$j])) {
                // Если имеем дело с субботой и воскресенья
                // подсвечиваем их
                if ($j == 5 || $j == 6) {
                    echo '<td class="datepicker-td day-off"><a href="#" data-id="'.$week[$i][$j].'weak'.$i.'">' . $week[$i][$j] . '</a></td>';
                } else  echo '<td class="datepicker-td "><a href="#" data-id="'.$week[$i][$j].'weak'.$i.'">' . $week[$i][$j] . '</a></td>';
            } else {
                echo '<td class="datepicker-td off"><a href="#" data-id="'.$count.'weak'.$i.'">' . $count . '</a></td>';
                $count++;
            }
        }
        echo "</tr>";
    }
    ?>

    <tr>
        <td colspan="7"><i class="datepicker-icon fa fa-plus-circle fa-4x" data-toggle="modal"
                           data-target="#note_Modal" aria-hidden="true"></i></td>
    </tr>
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
