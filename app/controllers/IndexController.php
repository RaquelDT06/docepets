<?php

namespace App\controllers;

use Core\controller\Action;


class IndexController extends Action
{

    public function index()
    {
    
        $this->render("index", "template_normal");

    }

    public function quem_somos()
    {
    
        $this->render("quem_somos","template_normal");
        
    }

    public function contato()
    {
        
        $this->render("contato","template_normal");
 
    }

    public function nossas_lojas()
    {
        
        $this->render("nossas_lojas","template_normal");
 
    }

    public function login() {
        $this->view->login = isset($_GET['error']) ? $_GET['error'] : '';
        $this->render("login", "template_normal");
    }    
}

?>
