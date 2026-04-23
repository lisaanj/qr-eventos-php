<?php

include_once dirname(__FILE__) . '/Classes/Foto.php';

function saveImage($base64, $imageName) {

    $localImagens = 'img/';

    $base64 = str_replace("data:image/png;base64", '', $base64);
    $base64 = str_replace(' ', '+', $base64);
    $data = base64_decode($base64);
    $file = $localImagens . $imageName . '.png';
    file_put_contents($file, $data);
//    if (preg_match('/^data:image\/(\w+);base64,/', $base64, $type)) {
//        $base64 = substr($base64, strpos($base64, ','));
//        $type = strtolower($type[1]);
//        if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
//            throw new \Exception('invalid image type');
//        }
//        $data = base64_decode($base64);
//
//        if ($data === false) {
//            throw new \Exception('can`t convert it');
//        }
//    } else {
//        return'image not found';
//    }
//    $file = "$localImagens$imageName.$type";
//    file_put_contents($file, $data);
    return Foto::salvarFoto($file);
}

function sendImage() {
    
}
