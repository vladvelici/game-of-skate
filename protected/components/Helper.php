<?php
class Helper {
    public function randomString($len) {
        $chars="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $max=strlen($chars)-1;
        $result="";
        for ($i=1;$i<=$len;$i++) {
            $result.=$chars[mt_rand(0,$max)];
        }
        return $result;
    }
    public function uniqueFileName($folder,$ext=".flv") {
        do {
            $fisier = self::randomString(10).$ext;
        } while(file_exists($folder."/".$fisier));
        return $fisier;
    }
}