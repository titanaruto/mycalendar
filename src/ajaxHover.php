<?php
require 'BL/DataMapper.php';
$DataMapper = new DataMapper();


$notes = $DataMapper->getAllNote();

$date = htmlspecialchars($_POST["date"]);
foreach ($notes as $note):
    if ($date === $note->date) {
        ?>
        <tr>
            <th colspan="7" class="datepicker-th"><?= $note->date; ?></th>
        </tr>
        <tr>
            <td colspan="7" class="datepicker-td"><?= $note->description; ?></td>
        </tr>
    <?php }
endforeach; ?>