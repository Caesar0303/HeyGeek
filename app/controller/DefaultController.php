<?php 
namespace app\controller;
use app\controller\Controller;
require_once "Controller.php";
class DefaultController extends Controller 
{
    public function index() {
        // if (!isset($_SESSION['user'])) {
        //     return $this->render(__DIR__ . "/../view/authorization.php", []);
        // }

        $message = "Дорбо пожаловать в HeyGeek ";
        $vars = ['message' => $message];
        $message =$this->render(__DIR__ . "/../view/default.php", $vars);
        $vars = ['content' => $message];
        return $this->render(__DIR__ . "/../view/layout.php", $vars);
    }
}