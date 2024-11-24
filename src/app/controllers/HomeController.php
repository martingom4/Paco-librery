<?php

class HomeController {
    public function index() {
        include __DIR__ . "/../views/Home/home.php";
    }

    public function choosePerfil(){
        include __DIR__ . "/../views/general/perfiles.php";
    }
}
