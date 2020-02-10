<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Контакты</title>

    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Main Style -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="row">
        <div class="col-lg-5"></div>
        <div class="col-lg-2 form-group">
            <form enctype="multipart/form-data" action="jp.php" method="POST">
                <!-- Поле MAX_FILE_SIZE должно быть указано до поля загрузки файла -->
                <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                <!-- Название элемента input определяет имя в массиве $_FILES -->

                <!-- <input type="checkbox" name = "CB">С переводом<br> -->

                <h3>Загрузите файл .xlsx: </h3><input name="userfile" type="file" /><br>
                <input class="btn btn-primary" type="submit" value="Создать таблицу" />
            </form>
            <p>Загрузиться страница с таблицей. Для создания pdf файла надо(в Google Chrome): Правая кнопка мыши→«Печать...» → «Сохранить как pdf».</p>
        </div>

        <div class="col-lg-5"></div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>
<?php
// echo $_FILES['userfile']['tmp_name'];
// echo php_ini_loaded_file(); ?>