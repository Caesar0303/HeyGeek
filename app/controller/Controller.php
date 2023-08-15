<?php 
namespace app\controller;

class Controller
{
    public function render($template, $vars = []) {
        extract($vars);
        ob_start();
        include($template);
        return ob_get_clean();
    }
}