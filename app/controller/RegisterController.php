<?php 

namespace app\controller;
use app\controller\Controller;
use app\model\User;

require_once "Controller.php";
require_once dirname(__DIR__) . "/model/User.php";

class RegisterController extends Controller {
    public function goToRegistration() {
        return $this->render(__DIR__ . "/../view/register.php", []);
    }

    public function goToAuthorization() {
        return $this->render(__DIR__ . "/../view/authorization.php", []);
    }
    
    public function exit() {
        session_start();
        $_SESSION['user_name'] = NULL;
        $_SESSION['user_role'] = NULL;
        $_SESSION['user_level_id'] = NULL;
        $_SESSION['user_id'] = NULL;
        return $this->render(__DIR__ . "/../view/authorization.php", []);
    }

    public function authorization() {
        $connect = User::connect();
        if (isset($_POST['login']) && isset($_POST['password'])) {
            $name = $_POST['login'];
            $password = $_POST['password'];
            $result = User::getUserByNameAndPassword($connect, $name, $password);
        }

        if (isset($result)) {
            User::setSessionUser($result);
            User::setTeacherAccess(($result));
            $message = "Добро пожаловать в HeyGeek, ";
            $vars = ['message' => $message];
            $message = $this->render(__DIR__ . "/../view/default.php", $vars);
            $vars = ['content' => $message];
            return $this->render(__DIR__ . "/../view/layout.php", $vars);
        } else {
            $message = "Неправильный логин или пароль";
            $vars = ['message' => $message];
            return $this->render(__DIR__ . "/../view/authorization.php", $vars);
        }   
    }

    public function registration() {
        $connect = User::connect();
        $name = $_POST['login'];
        $password = $_POST['password'];
        
        if (User::checkRegistration($connect, $name)) {
            $message = "Пользователь с таким именем уже зарегистрирован";
            $vars = ['message' => $message];
            return $this->render(__DIR__ . "/../view/register.php", $vars);
        } else {
            User::saveNewUser($connect, $name, $password);
            $result = User::getUserByNameAndPassword($connect, $name, $password);
            User::setSessionUser($result);
            User::setTeacherAccess(($result));
            $message = "Добро пожаловать в HeyGeek, ";
            $vars = ['message' => $message];
            $message = $this->render(__DIR__ . "/../view/default.php", $vars);
            $vars = ['content' => $message];
            return $this->render(__DIR__ . "/../view/layout.php", $vars);
        }
    }
}



// <?php 
// namespace app\controller;
// use app\controller\Controller;
// use app\Connect;
// use mysqli;

// require_once "Controller.php";
// require dirname(__DIR__) . "/connect.php";
// class RegsiterController extends Controller 
// {
//     public function goToRegistration() {
//         return $this->render(__DIR__ . "/../view/register.php", []);
//     }

//     public function goToAuthorization() {
//         return $this->render(__DIR__ . "/../view/authorization.php", []);
//     }
    
//     public function exit() {
//         $_SESSION['user'] = NULL;
//         return $this->render(__DIR__ . "/../view/authorization.php", []);
//     }

//     public function authorization() {
//         $connect = Connect::connect();
//         $name = $_POST['login'];
//         $password = $_POST['password'];
//         $query = "SELECT * FROM users WHERE name = '$name' AND password = '$password'";
//         $result = mysqli_query($connect, $query);

//         if ($result && mysqli_num_rows($result) > 0) {
//             $user = mysqli_fetch_assoc($result);
//             $_SESSION['user_name'] = $user['name'];
//             $_SESSION['user_role'] = $user['role'];
//             $_SESSION['user_level_id'] = $user['level_id'];
//             $_SESSION['user_id'] = $user['id'];
//             $message = "Добро пожаловать в HeyGeek, ";
//             $vars = ['message' => $message];
//             $message =$this->render(__DIR__ . "/../view/default.php", $vars);
//             $vars = ['content' => $message];
//             return $this->render(__DIR__ . "/../view/layout.php", $vars);
//         } else {
//             $message = "Неправильный логин или пароль";
//             $vars = ['message' => $message];
//             return $this->render(__DIR__ . "/../view/authorization.php", $vars);
//         }   

//     }

//     public function registration() {
//         $connect = Connect::connect();
//         $name = $_POST['login'];
//         $_SESSION['user'] = $name;
//         $password = $_POST['password'];
//         $check = mysqli_query($connect, "SELECT name FROM users WHERE name = '$name'");
//         if (mysqli_num_rows($check) > 0) {
//             $message = "Пользователь с таким именем уже зарегестрирован";
//             $vars = ['message' => $message];
//             return $this->render(__DIR__ . "/../view/register.php", $vars);
//         } else {
//             $query = "INSERT INTO users (name, password, level_id, role) VALUES ('$name', '$password', 0, 0)";
//             mysqli_query($connect, $query);
//             $query = "SELECT * FROM users WHERE name = '$name' AND password = '$password'";
//             $result = mysqli_query($connect, $query);
//             $user = mysqli_fetch_assoc($result);
//             $_SESSION['user_name'] = $user['name'];
//             $_SESSION['user_role'] = $user['role'];
//             $_SESSION['user_level_id'] = $user['level_id'];
//             $_SESSION['user_id'] = $user['id'];
//             $message = "Добро пожаловать в HeyGeek, ";
//             $vars = ['message' => $message];
//             $message =$this->render(__DIR__ . "/../view/default.php", $vars);
//             $vars = ['content' => $message];
//             return $this->render(__DIR__ . "/../view/layout.php", $vars);
//         }
//     }
// }