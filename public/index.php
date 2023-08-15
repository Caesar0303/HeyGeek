<?php 
require "../app/controller/DefaultController.php";
require "../app/controller/RegisterController.php";
require "../app/controller/CardController.php";

$action = 'index';
$controller_name = 'default';
if(isset($_GET['controller'])) {
    $controller_name = $_GET['controller'];
} 

if($controller_name == 'default') {
    $controller = new app\controller\DefaultController;
}else if ($controller_name == 'register') {
    $controller = new app\controller\RegisterController;
}else if ($controller_name == 'card') {
    $controller = new app\controller\CardController;
}

if (isset($_GET['action'])){
    $action = $_GET['action'];
}
if ($action == 'index') {
    echo $controller->index();
} elseif ($action =='gotoauthorization') {
    echo $controller->goToAuthorization();
} elseif ($action =='gotoregistration') {
    echo $controller->goToRegistration();
} elseif ($action == 'authorization') {
    echo $controller->authorization();
} elseif ($action == 'registration') {
    echo $controller->registration();
} elseif ($action == 'exit') {
    echo $controller->exit();
} elseif ($action == 'showAllCards') {
    echo $controller->showAllCards();
} elseif ($action == 'showCard') {
    echo $controller->showCard($_GET['id']);
} elseif ($action == 'newCard') {
    echo $controller->newCard();
} elseif ($action == 'createNewCard') {
    echo $controller->createNewCard();
} elseif ($action == 'startTask') {
    echo $controller->startTask();
} elseif ($action == 'userCards') {
    echo $controller->userCards();
} elseif ($action == 'addSolution') {
    echo $controller->addsolution();
} elseif ($action == 'showAllStudentsCards') {
    echo $controller->showAllStudentsCards();
} elseif ($action == 'rate') {
    echo $controller->rate();
} elseif ($action == 'rateCard') {
    echo $controller->rateCard();
} elseif ($action == 'statistic') {
    echo $controller->statistic();
}