<?php 
namespace app\model;

class Points {
    public static function getPointsById($id) {
        $connect = Points::connect();
        $query = "SELECT points FROM users WHERE id = '$id'";
        $result = mysqli_query($connect, $query);
        return mysqli_fetch_assoc($result);
    }

    public static function connect() {
        $connect = mysqli_connect('localhost', 'root', '', 'HeyGeek');
        return $connect;
    }
}