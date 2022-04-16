<?php
count_files("public/img/__tmp/car_photos/audi")
/*var_dump(scandir("."), "*******************", "КОЛИЧЕСТВО ФАЙЛОВ opendir " . count_files("."), "КОЛИЧЕСТВО ФАЙЛОВ scandir " . count_files__scandir("."))*/;

/*
 * считает количество файлов ТОЛЬКО указанной в папке, т.е. на первом уровне, внутрь папок не заходит
 */
/*function count_files($path) {
    $dir = scandir($path);
    $count = 0;
    foreach ($dir as $elem) if (is_file($elem)) $count++;
    return $count;
}*/

function count_files($path) {
    $dir = scandir($path);
    $count = 0;
    foreach ($dir as $elem) if (!is_dir($elem)) $count++;
    return $count;
}
