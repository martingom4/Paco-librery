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

    public function procesarLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if ($this->validarCamposLogin($email, $password)) {
                $clienteExistente = $this->adminModel->buscarPorCorreo($email);
                if ($clienteExistente && password_verify($password, $clienteExistente['contrasena'])) {
                    $this->iniciarSesion($clienteExistente);
                    header('Location: /cliente/loginExitoso');
                    exit();
                } else {
                    $error = 'Correo o contraseña incorrectos.';
                    header('Location: /cliente/registroFallido');
                }
            }
        }
    }

    private function validarCamposLogin($correo, $password) {
        if (empty($correo) || empty($password)) {
            return 'Por favor, complete todos los campos.';
        }
        return null;
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
