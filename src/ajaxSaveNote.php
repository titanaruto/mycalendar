<?php
require 'BL/DataMapper.php';
$DataMapper = new DataMapper();

$date = htmlspecialchars($_POST["date"]);
$description = htmlspecialchars($_POST["description"]);
?>
<tr>
    <th colspan="7"
        class="datepicker-th"><?php if ($DataMapper->AddNote($date, $description)) echo "Заметка успешно добавлена,</br> наведите на дату."; ?></th>
</tr>