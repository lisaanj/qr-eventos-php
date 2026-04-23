<?php

class Util {

    public static function getDataParaBD($data) {
        if ($data == '') {
            return $data;
        } else {
            return date('Y-m-d', strtotime(str_replace('/', '-', $data)));
        }
    }

    public static function getDataDoBD($data) {
        if ($data == '') {
            return $data;
        } else {
            return date('d/m/Y', strtotime($data));
        }
    }

}
