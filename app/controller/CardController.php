<?php 
namespace app\controller;
use app\controller\Controller;
use app\model\Card;
use app\model\User;
session_start();
require_once "Controller.php";
require_once dirname(__DIR__) . "/model/User.php";
require_once dirname(__DIR__) . "/model/Card.php";

class CardController extends Controller {
    public function showAllCards() {
        $connect = Card::connect();
        $cards = Card::getAllCards($connect);
    
        $availability = [];
        if (isset($_SESSION['user_id'])) {
            foreach ($cards as $card) {
                $availability[$card['id']] = Card::checkForAvailability($_SESSION['user_id'], $card['id']);
            }
        }
    
        $vars = ['cards' => $cards, 'availability' => $availability];
        $allCards = $this->render(__DIR__ . "/../view/cards/list.php", $vars);
        $vars = ['content' => $allCards];
        return $this->render(__DIR__ . "/../view/layout.php", $vars);
    }
    

    public function newCard() {
        $newCard = $this->render(__DIR__ . "/../view/cards/newCard.php", []);
        $vars = ['content' => $newCard];
        return $this->render(__DIR__ . "/../view/layout.php", $vars);
    }

    public function createNewCard() {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $points = $_POST['points'];
        $image = $_FILES['image']; 
        $author_id = $_POST['author_id'];
        $level_id = $_POST['level_id'];

        Card::addNewCard($name, $description, $points, $image, $author_id, $level_id);
        header("Location: ?action=showAllCards&controller=card");
    }

    public function userCards() {
        $id = $_SESSION['user_id'];
        $cards = Card::getUserCards($id);
    
        // Создаем пустые массивы для хранения данных
        $students = [];
        $cardDetails = [];
        $submittedCards = [];
    
        foreach ($cards as $card) {
            $student = User::getUserByID($card['student_id']);
            $cardDetail = Card::getCardByID($card['card_id']);
    
            // Добавляем данные в соответствующие массивы
            $students[] = $student;
            $cardDetails[] = $cardDetail;
    
            if ($card['status'] == 1) {
                $submittedCards[] = $card;
            }
        }
    
        // Передаем все данные в шаблон
        $vars = [
            'cards' => $cards,
            'students' => $students,
            'cardDetails' => $cardDetails,
            'submittedCards' => $submittedCards
        ];
        $content = $this->render(__DIR__ . "/../view/cards/myCards.php", $vars);
        $vars = ['content' => $content];
        return $this->render(__DIR__ . "/../view/layout.php", $vars);
    }
    
    public function showAllStudentsCards() {
        $cards = Card::getAllStudentsCards(); // Передайте соединение с базой данных

        // Создаем пустые массивы для хранения данных
        $students = [];
        $cardDetails = [];

        foreach ($cards as $card) {
            $student = User::getUserByID($card['student_id']);
            $cardDetail = Card::getCardByID($card['card_id']);

            // Добавляем данные в соответствующие массивы
            $students[] = $student;
            $cardDetails[] = $cardDetail;
        }

        // Передаем все данные в шаблон
        $vars = [
            'cards' => $cards,
            'students' => $students,
            'cardDetails' => $cardDetails
        ];
        $content = $this->render(__DIR__ . "/../view/cards/allStudentsCards.php", $vars);
        $vars = ['content' => $content];
        return $this->render(__DIR__ . "/../view/layout.php", $vars);
    }


    public function startTask() {
        $student_id = $_SESSION['user_id']; 
        $card_id = $_GET['id'];
        Card::startCard($student_id,$card_id);
        header("Location: ?action=userCards&controller=card");
    }
    
    public function showCard($id) {
        $card = Card::getCardByID($id);
        $vars = ['card' => $card];
        $card = $this->render(__DIR__ . "/../view/cards/show.php", $vars);
        $vars = ['content' => $card];
        return $this->render(__DIR__ . "/../view/layout.php", $vars);
    }
    
    public function addSolution() {
        $card_id = $_POST['id'];
        $file = $_FILES['solution'];
        
        Card::sendSolution($file,$card_id);
        header("Location: ?action=userCards&controller=card");
    }

    public function rate() {
        $newCard = $this->render(__DIR__ . "/../view/cards/rate.php", []);
        $vars = ['content' => $newCard];
        return $this->render(__DIR__ . "/../view/layout.php", $vars);
    }

    public function rateCard() {
        $task = Card::getCardByID($_POST['task_id']);
        $card = Card::getCardByID($_POST['card_id']);
        $user = User::getUserByID($_POST['student_id']);
        
        $points = $task['points'];
        if($_POST['in_time'] == NULL) {
            $points -= $points * 0.1;
        }
        if($_POST['help'] == NULL) {
            $points -= $points * 0.15;
        }
        Card::setRate($_POST['student_id'], $points, $_POST['card_id']);
        Card::checkLevel($_POST['student_id']);
        header("Location: http://heygeek/?action=showAllStudentsCards&controller=card");
    }

    public function statistic() {
        $users = Card::getStudentsStatistic();
        $vars = ['users' => $users];
        $statistic = $this->render(__DIR__ . "/../view/cards/statistic.php", $vars);
        $vars = ['content' => $statistic];
        return $this->render(__DIR__ . "/../view/layout.php", $vars); 
    }
}