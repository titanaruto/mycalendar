<?php

include('views/includes/head.php'); ?>
</head>
<body>
<table class="datepicker">
    <caption class="datepicker-caption">
        <a href="index.html" class="datepicker-prev">Previous</a>
        <span class="datepicker-title"><?= date("F Y"); ?></span>
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
    <tr>
        <td class="datepicker-td"><a href="index.html">1</a></td>
        <td class="datepicker-td"><a href="index.html">2</a></td>
        <td class="datepicker-td"><a href="index.html">3</a></td>
        <td class="datepicker-td"><a href="index.html">4</a></td>
        <td class="datepicker-td"><a href="index.html">5</a></td>
        <td class="datepicker-td day-off"><a href="index.html">6</a></td>
        <td class="datepicker-td day-off"><a href="index.html">7</a></td>
    </tr>
    <tr>
        <td class="datepicker-td"><a href="index.html">8</a></td>
        <td class="datepicker-td"><a href="index.html">9</a></td>
        <td class="datepicker-td "><a href="index.html">10</a></td>
        <td class="datepicker-td"><a href="index.html">11</a></td>
        <td class="datepicker-td"><a href="index.html">12</a></td>
        <td class="datepicker-td day-off"><a href="index.html">13</a></td>
        <td class="datepicker-td day-off"><a href="index.html">14</a></td>
    </tr>
    <tr>
        <td class="datepicker-td"><a href="index.html">15</a></td>
        <td class="datepicker-td"><a href="index.html">16</a></td>
        <td class="datepicker-td"><a href="index.html">17</a></td>
        <td class="datepicker-td"><a href="index.html">18</a></td>
        <td class="datepicker-td"><a href="index.html">19</a></td>
        <td class="datepicker-td day-off"><a href="index.html">20</a></td>
        <td class="datepicker-td day-off"><a href="index.html">21</a></td>
    </tr>
    <tr>
        <td class="datepicker-td"><a href="index.html">22</a></td>
        <td class="datepicker-td"><a href="index.html">23</a></td>
        <td class="datepicker-td"><a href="index.html">24</a></td>
        <td class="datepicker-td"><a href="index.html">25</a></td>
        <td class="datepicker-td"><a href="index.html">26</a></td>
        <td class="datepicker-td day-off"><a href="index.html">27</a></td>
        <td class="datepicker-td today day-off"><a href="index.html">28</a></td>
    </tr>
    <tr>
        <td class="datepicker-td"><a href="index.html">29</a></td>
        <td class="datepicker-td"><a href="index.html">30</a></td>
        <td class="datepicker-td off"><a href="index.html">1</a></td>
        <td class="datepicker-td off"><a href="index.html">2</a></td>
        <td class="datepicker-td off"><a href="index.html">3</a></td>
        <td class="datepicker-td off"><a href="index.html">4</a></td>
        <td class="datepicker-td off"><a href="index.html">5</a></td>
    </tr>
    <tr>
        <td colspan="7"><i class="datepicker-icon fa fa-plus-circle fa-4x" data-toggle="modal"
                           data-target="#exampleModal" aria-hidden="true"></i></td>
    </tr>
    </tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
