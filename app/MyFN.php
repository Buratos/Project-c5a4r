<?php


namespace App;


class MyFN {
    /*
     * считает количество файлов ТОЛЬКО указанной в папке, т.е. на первом уровне, внутрь папок не заходит
     */
    static public function count_files($path) {
        $dir = scandir($path);
        $count = 0;
        foreach ($dir as $elem) if (!is_dir($elem)) $count++;
        return $count;
    }

    /*
     * удаляет ВСЁ внутри указанной папки path, саму папку не трогает
     */
    static public function erase_dir_tree_inside($path) {
        static $start_path = "";
        if (!$start_path) $start_path = $path;
        $dir = opendir($path);
        while ($file = readdir($dir)) {
            if (($file != ".") && ($file != "..")) {
                $full_path = $path . "/" . $file;
                if (is_dir($full_path)) self::erase_dir_tree_inside($full_path);
                else unlink($full_path);
            }
        }
        closedir($dir);
        if ($start_path != $path) rmdir($path);
        else $start_path = "";
    }
}
