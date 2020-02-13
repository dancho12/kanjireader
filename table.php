<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>JLPT</title>
    <meta name="description" content="JLPT">
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

    <div class="main">
        <!-- <h1>JLPT N4</h1> -->


        <?php

if (!empty($newSheet)) {
    $sheet = $newSheet;

} else {
    require_once __DIR__ . '/simple-xlsx/simplexlsx.class.php';
    // Файл xlsx
    $xlsx = new SimpleXLSX(__DIR__ . '/Kanji_N4_edit.xlsx');
//$xlsx = new SimpleXLSX($_FILES['userfile']['tmp_name']);

// Первый лист
    $sheet = $xlsx->rows();

}

$full = count($sheet);
$last_row = (intval($full / 12) * 12);
$left_side = 12;
$right_side = 23;
$row_val = 0;
$row_h = 0;
if (isset($_POST['title'])) {
    $N = $_POST['title'];
} else {
    $N = count($sheet);
    if ($N > 0 && $N < 150) {
        $N = 5;
    } elseif ($N > 150 && $N < 200) {
        $N = 4;
    } elseif ($N > 200 && $N < 400) {
        $N = 3;
    }
    $N = "JLPT N" . $N;
}

$first_page = true;
$page = true;
foreach ($sheet as $i => $row) {
//   foreach($row as $i=>$val){
    //       echo $val." ";
    //   }
    if ($page) {
        ?><div class="page"> <?php
$page = false;
        if ($i == 0) {

            ?> <h1><?php echo $N ?></h1><?php
}
    }
    $stl;

    // if ($i == 0) {
    //     $stl = ' border-left: solid 1px grey;
    // border-top: solid 1px grey;/*1*/';
    // } elseif ($i > 0 && $i < 11) {
    //     $stl = 'border-top: solid 1px grey;/*2*/';
    // } elseif ($i == 11) {
    //     $stl = ' border-right: solid 1px grey;
    // border-top: solid 1px grey;/*3*/';
    // } elseif ($i == $left_side) {
    //     $stl = ' border-left: solid 1px grey;/*4*/';
    //     if ($left_side < $last_row - 24) {
    //         $left_side = $left_side + 12;
    //     }
    // } elseif ($i == $right_side) {
    //     $stl = ' border-right: solid 1px grey;/*5*/';
    //     if ($right_side < $last_row - 13) {
    //         $right_side = $right_side + 12;
    //     }
    // } elseif ($i > $last_row - 12 && $i < $last_row - 1) {
    //     $stl = 'border-bottom: solid 1px grey;/*6*/';
    // } elseif ($i > $last_row && $i < $full - 1) {
    //     $stl = 'border-top: solid 0px grey;
    // border-bottom: solid 1px grey;/*7*/';
    // } elseif ($i == $last_row - 12) {
    //     $stl = 'border-bottom: solid 1px grey;
    // border-left: solid 1px grey;/*8*/';
    // } elseif ($i == $last_row - 1) {
    //     $stl = 'border-bottom: solid 1px grey;
    // border-right: solid 1px grey;/*9*/';
    // } elseif ($i == $last_row) {
    //     $stl = 'border-top: solid 0px grey;
    // border-bottom: solid 1px grey;
    // border-left: solid 1px grey;/*10*/';
    // } elseif ($i == $full - 1) {
    //     $stl = 'border-top: solid 0px grey;
    // border-bottom: solid 1px grey;
    // border-right: solid 1px grey;/*11*/';
    // }

    ?>
        <div class="kanji" style="<?php echo $stl;
    $stl = ""; ?>">
            <h2 style="height: 4mm;">
                <?php echo $row[1]; ?>
            </h2>
            <h1>
                <?php echo $row[0]; ?>
            </h1>
            <h2 ><?php
$h_str = $row[2];
    $h_str = str_replace(" ", "", $h_str);
/*эксперементы*/
    if (strlen($h_str) > 22) {
        $l = strpos($h_str, "、");
        $mas_pos = $l;
        if (strlen(substr($h_str, $l + 3)) > 22) {
            $l = strpos($h_str, "、", $l + 4);
            $h_str = substr_replace($h_str, "<br>", $l + 3, 0);
        }
        $h_str = substr_replace($h_str, "<br>", $mas_pos + 3, 0);
    }
/*эксперементы*/

    $h_str = str_replace("%", '<span style="text-decoration: underline; ">', $h_str);
    $h_str = str_replace("&", '</span>', $h_str);
    echo $h_str;?></h2>
        </div>
        <?php

    $row_h++;
    if ($row_h == 10) {
        $row_val++;
        $row_h = 0;
    }
    if ($row_val == 9 && $row_h == 0 && $first_page == true) {

        ?>
    <!-- <div class="space"> -->
    </div>
    <?php
$row_val = 0;
        $page = true;
        $first_page = false;
    } elseif ($row_val == 10 && $row_h == 0 && $first_page == false) {

        ?>
    <!-- <div class="space"> -->
    </div>
    <?php
$row_val = 0;
        $page = true;
    }
}

?>
    <p style = "margin-top: 4mm;
	width: 62mm;
    float: left;
    font-size: 0.6em;">このテーブルはタニイルによって作られました。</p>
    </div>

</body>

</html>