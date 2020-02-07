<?php
set_time_limit(120);

require_once __DIR__ . '/simple-xlsx/simplexlsx.class.php';

// Файл xlsx
//$xlsx_full = new SimpleXLSX(__DIR__ . '/Kanji_N4.xlsx');
$xlsx_full = new SimpleXLSX($_FILES['userfile']['tmp_name']);
$xlsx_k = new SimpleXLSX(__DIR__ . '/Kana.Hiragana.Sheet.xlsx');

// Первый лист
$sheet_full = $xlsx_full->rows();
// Первый лист
$sheet_k = $xlsx_k->rows();

function is_Hiragana($h, $pos,$sheet)
{
    $h = substr($h, $pos, 3);
    // $xlsx = new SimpleXLSX(__DIR__ . '/Kana.Hiragana.Sheet.xlsx');
    // $sheet = $xlsx->rows();
    // $sheet = $sheet_k;
    $result = false;
    foreach ($sheet as $val) {

        if ($h == $val[0]) {
            $result = true;
        }
    }
    return $result;
}

$newSheet;

foreach ($sheet_full as $i => $row) {
    // echo "<br>";
    // echo $i . " " . $row[2] . "<br>";
    $find = false;
    $f = "s";
    foreach ($sheet_k as $row_k) {

        if (strpos($row[2], $row_k[0])) {

            $g = strpos($row[2], $row_k[0]);
            if ($g < $f || $f == "s") {
                $f = $g;
            }
        }
    }
    if ($f != "s") {
        $h_str = substr($row[2], $f);//строка хираганы
        $h_str_l = strlen($h_str);//длина хираганы

        /*Скрипт по считыванию нижнего подчеркивания*/
        /*Начало*/
        $j = 0;
       
        $g=false;

        while ($j < $h_str_l) {
            if ($h_str[$j] == " " && is_Hiragana($h_str, $j - 3,$sheet_k) && is_Hiragana($h_str, $j + 1,$sheet_k)) {
                $h_str = substr_replace($h_str, "%", $j, 0);
                $g=true;
            }
            $j++;
        }
        
        $h_str_l2 = $h_str_l;
        $ii = 0;
        while ($ii <= $h_str_l2) {
            if (is_Hiragana($h_str, $ii,$sheet_k) && !is_Hiragana($h_str, $ii + 3,$sheet_k) && $h_str[$ii + 3] != "%" && substr($h_str, $ii + 3, 3) != "・") {
                if(strpos($h_str,"%")){
                    $h_str = substr_replace($h_str, "&", $ii + 3, 0);
                
                    $h_str_l2++;
                }
                
               
            }
            $ii++;
        }

        $dot_sy = "s";
        $per_sy = "s";
        $dot_sy = strripos($h_str, "・");
        $per_sy = strripos($h_str, "%");
        if ($dot_sy != "s" && $per_sy != "s") {
            if ($dot_sy < $per_sy) {
                $h_str = substr_replace($h_str, "&", strlen($h_str) + 1, 0);
            }
        } elseif ($per_sy != "s") {
            $h_str = substr_replace($h_str, "&", $j + 1, 0);
            
        }
        /*Конец*/

        $h_str = str_replace(" ", "", $h_str); //удаление пробелов
        $h_str = str_replace("・", "、", $h_str); 
        $f_str_l = strlen($row[2]);//длина полной строки
        $k_str_l = ($f_str_l - $h_str_l);//длина строки катаканы
        $k_str = substr($row[2], 0, $k_str_l - 4);//строка катаканы
        $k_str = str_replace("・", "、", $k_str); 
        $k_str = str_replace(" ", "", $k_str); 
        // echo $k_str . "<br>";
        // echo $h_str . "<br>";

        $newSheet[$i][0] = $row[1];
        $newSheet[$i][1] = $k_str;
        $newSheet[$i][2] = $h_str;
        $newSheet[$i][3] = $row[3];

    } else {
        $row[2] = str_replace("・", "、", $row[2]); 
        $row[2] = str_replace(" ", "", $row[2]); 
        $newSheet[$i][0] = $row[1];
        $newSheet[$i][1] = $row[2];
        $newSheet[$i][2] = "";
        $newSheet[$i][3] = $row[3];
    }

    // echo "<br>";

}

/* запись в новый файл */

include_once "./xlsxwriter.class.php";

$writer = new XLSXWriter();
$writer->writeSheet($newSheet);
$writer->writeToFile('Kanji_N4_edit.xlsx');

$cb = $_POST['CB'];
//var_dump($cb);
if($cb == "on"){
    include 'test_t.php';
}else{
    include 'test.php';
}


