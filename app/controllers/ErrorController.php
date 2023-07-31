<?php

namespace App\controllers;

use Core\controller\Action;

class ErrorController extends Action
{
    
    public function error404()
    {
        $this->view->title = "ERROR 404" ;
        $this->render("error404", "");
    }

    public function error401()
    {
        $this->view->title = "ERROR 401" ;
        $this->render("error401", "Login");
    }    
}

?>