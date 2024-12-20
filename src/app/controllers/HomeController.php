<?php

class HomeController {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index() {
        include __DIR__ . "/../views/Home/home.php";
    }

    public function choosePerfil(){
        include __DIR__ . "/../views/general/perfiles.php";
    }

    public function sobreNosotros(){
        include __DIR__ . "/../views/misc/sobrenosotros.php";
    }

    public function sucursales(){
        include __DIR__ . "/../views/misc/sucursal.php";
    }
}
