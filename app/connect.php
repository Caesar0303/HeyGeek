<?php
namespace app;

class Connect
{
    public static function connect() {
        $connect = mysqli_connect('localhost', 'root', '', 'HeyGeek');
        return $connect;
    }
}