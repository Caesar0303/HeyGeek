<?php
namespace app\model;

use mysqli;

class Card {
    public static function connect() {
        $connect = mysqli_connect('localhost', 'root', '', 'HeyGeek');
        return $connect;
    }

    public static function addNewCard($name, $description, $points, $image, $author_id, $level_id) {
        $connect = Card::connect();
        
        $insertQuery = "INSERT INTO cards (name, level_id, description, image, points, author_id, file) VALUES ('$name', '$level_id', '$description', 0, '$points', '$author_id', 0)";
        mysqli_query($connect, $insertQuery);
    
        $createdArticleId = mysqli_insert_id($connect);
        $targetDirectory = __DIR__ . "/../../public/storage/images/";
        $imageFileType = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
        $imageName = $createdArticleId . '.' . $imageFileType;
        $targetFile = $targetDirectory . $imageName;
    
        if (isset($image) && is_uploaded_file($image['tmp_name']) && move_uploaded_file($image['tmp_name'], $targetFile)) {
            $updateQuery = "UPDATE cards SET image = '$imageName' WHERE id = $createdArticleId";
            mysqli_query($connect, $updateQuery);
        }
    }

    public static function sendSolution($file,$id) {
        $connect = Card::connect();
        $end_time = date("Y-m-d");
        $targetDirectory = __DIR__ . "/../../public/storage/files/";
        $targetFile = $targetDirectory . basename($file['name']);
        
        if (isset($file) && is_uploaded_file($file['tmp_name']) && move_uploaded_file($file['tmp_name'], $targetFile)) {
            $filename = basename($file['name']);
            $insertQuery = "UPDATE student_cards SET file = '$filename', end_time = '$end_time', status = 1 WHERE id = '$id';
            ";
            mysqli_query($connect, $insertQuery);
            return true; // Возвращаем успешное завершение
        } else {
            return false; // Возвращаем неудачу
        }
    }
    
    public static function getAllCards($connect) {
        $query = "SELECT * FROM cards";
        $result = mysqli_query($connect, $query);
        $cards = [];
        
        while ($row = mysqli_fetch_assoc($result)) {
            $cards[] = $row;
        }
        
        return $cards;
    }

    public static function getAllStudentsCards() {
        $connect = Card::connect();
        $query = "SELECT * FROM student_cards";
        $result = mysqli_query($connect, $query);
        $cards = [];
        
        while ($row = mysqli_fetch_assoc($result)) {
            $cards[] = $row;
        }
        
        return $cards;
    }

    public static function startCard($student_id,$card_id) {
        $connect = Card::connect();
        $start_time = date("Y-m-d");
        $query = "INSERT INTO student_cards (start_time, end_time, help, in_time, status, student_id, card_id, file) VALUES ('$start_time', '$start_time', 0, 0, 0, '$student_id', '$card_id', 0)";
        mysqli_query($connect,$query);
    }

    public static function getUserCards($id) {
        $connect = Card::connect();
        $query = "SELECT * FROM student_cards WHERE student_id = '$id'";
        $result = mysqli_query($connect, $query);
    
        $cards = []; // Создаем пустой массив для хранения карточек
    
        while ($row = mysqli_fetch_assoc($result)) {
            $cards[] = $row; // Добавляем текущую карточку в массив
        }
    
        return $cards; // Возвращаем массив всех карточек
    }

    public static function getCardByID($id) {
        $connect = Card::connect();
        $query = "SELECT * from cards WHERE id = '$id'";
        $result = mysqli_query($connect, $query);
        return mysqli_fetch_assoc($result);
    }

    public static function checkForAvailability($student_id, $card_id) {
        $connect = Card::connect(); 
        $check = mysqli_query($connect, "SELECT * FROM student_cards WHERE student_id = '$student_id' AND card_id = '$card_id'");
    
        if (mysqli_num_rows($check) > 0) {
            return false;
        } else {
            return true;
        }
    }

    public static function setRate($student_id, $points, $card) {
        $connect = Card::connect();
        mysqli_query($connect, "UPDATE users SET points = points + $points WHERE id = $student_id");
        mysqli_query($connect, "UPDATE student_cards SET status = 2 WHERE id = $card");
    }

    public static function checkLevel($student_id) {
        $connect = Card::connect();
        $levels = mysqli_query($connect, "SELECT * FROM levels");
        $levels = mysqli_fetch_all($levels);
        $user = User::getUserByID($student_id);
        $points = $user['points'];
        var_dump($levels[0]);
        foreach ($levels as $level) {
            if ($points >= $level[2]) {
                $level_id = $level[0];
                mysqli_query($connect, "UPDATE users SET level_id = $level_id WHERE id = $student_id");
            }
        }
    }

    public static function getStudentsStatistic() {
        $connect = Card::connect();
        $users = mysqli_query($connect, 'SELECT * FROM users ORDER BY points DESC');
        $userData = array();
        
        while ($row = mysqli_fetch_assoc($users)) {
            $levelId = $row['level_id'];
            $query = "SELECT name FROM levels WHERE id = $levelId";
            $result = mysqli_query($connect, $query);
            $row['level_id'] = mysqli_fetch_assoc($result)['name'];
            $userData[] = $row;
        }

        return $userData;
    }
}