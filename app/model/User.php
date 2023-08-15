<?php
namespace app\model;

use mysqli;

class User {
    public static function checkLogin($result) {
        return mysqli_num_rows($result) > 0;
    }

    public static function checkRegistration($connect, $name) {
        $check = mysqli_query($connect, "SELECT name FROM users WHERE name = '$name'");
        return mysqli_num_rows($check) > 0;
    }

    public static function saveNewUser($connect, $name, $password) {
        $query = "INSERT INTO users (name, password, level_id, role, points) VALUES ('$name', '$password', 1, 0, 0)";
        mysqli_query($connect, $query);
    }

    public static function getUserByNameAndPassword($connect, $name, $password) {
        $query = "SELECT * FROM users WHERE name = '$name' AND password = '$password'";
        $result = mysqli_query($connect, $query);
        return mysqli_fetch_assoc($result);
    }

    public static function getUserByID($id) {
        $connect = User::connect();
        $query = "SELECT * from users WHERE id = '$id'";
        $result = mysqli_query($connect, $query);
        return mysqli_fetch_assoc($result);
    }

    public static function setSessionUser($user) {
        session_start();
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['user_level_id'] = $user['level_id'];
        $_SESSION['user_id'] = $user['id'];
    }

    public static function setTeacherAccess($user) {
        if ($user['role'] == 1) {
            $_SESSION['teacher'] = true;
        }
    }

    public static function connect() {
        $connect = mysqli_connect('localhost', 'root', '', 'HeyGeek');
        return $connect;
    }
}