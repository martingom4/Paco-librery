<?php

require_once __DIR__ . '/../models/Administrador.php';

class AdministradorController {
    private $adminModel;

    public function __construct($db) {
        $this->adminModel = new Administrador($db);
    }

    public function mostrarLogin() {
        include __DIR__ . '/../views/admin/loginAdministrador.php';
    }

    public function loginExitoso() {
        include __DIR__ . '/../views/admin/loginExitoso.php';
    }

    public function loginFallido() {
        include __DIR__ . '/../views/admin/loginFallido.php';
    }

    public function procesarLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if ($this->validarCamposLogin($email, $password)) {
                $clienteExistente = $this->adminModel->buscarPorCorreo($email);
                if ($clienteExistente) {
                    if ($password === '1234') {
                        $this->iniciarSesion($clienteExistente);
                        header('Location: /admin/loginExitoso');
                        exit();
                    } else {
                        $error = 'Correo o contraseña incorrectos.';
                    }
                }
            } else {
                $error = 'Por favor, complete todos los campos.';
            }
            include __DIR__ . '/../views/admin/loginAdministrador.php';
        }
    }

    private function validarCamposLogin($correo, $password) {
        return !empty($correo) && !empty($password);
    }

    private function iniciarSesion($adminExistente) {
            session_start();
            $_SESSION['admin_id'] = $adminExistente['ID_admin'];
            $_SESSION['correo'] = $adminExistente['correo'];

            $ultimoAcceso = date("Y-m-d H:i:s");
            setcookie('ultimo_acceso', $ultimoAcceso, time() + 30*24*60*60, "/");


    }

    public function mostrarPerfil() {
        $this->verificarSesion();

        $admin = $this->adminModel->obtenerAdminPorId($_SESSION['admin_id']);
        include __DIR__ . '/../views/admin/PerfilAdmin.php';
    }

    public function cerrarSesion() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /home.php');
        exit();
    }

    public function verificarSesion() {
        session_start();
        if (!isset($_SESSION['admin_id'])) {
            header('Location: /admin/login');
            exit();
        }
    }
}
