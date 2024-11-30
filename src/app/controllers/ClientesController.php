<?php

require_once __DIR__ . '/../models/Cliente.php';

class ClientesController {

    private $clienteModel;

    public function __construct($db){
        $this->clienteModel = new Cliente($db);
    }

    public function mostrarRegistro() {
        include __DIR__ ."/../views/cliente/registrocliente1.php";
    }

    public function crearCliente() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $apellido = trim($_POST['apellido'] ?? '');
            $correo = trim($_POST['correo'] ?? '');
            $contrasena = password_hash(trim($_POST['contrasena'] ?? ''),PASSWORD_BCRYPT);
            $telefono = trim($_POST['telefono'] ?? '');

            if ($this->validarCamposRegistro($nombre, $apellido, $correo, $contrasena)) {
                $clienteExistente = $this->clienteModel->buscarPorCorreo($correo);
                if ($clienteExistente) {
                    $error = 'Este correo ya está registrado.';
                    include __DIR__ . '/../views/cliente/registrocliente1.php';
                    return;
                }
                $registroExitoso = $this->clienteModel->registrarCliente($nombre, $apellido, $contrasena, $telefono, $correo);
                $this->mostrarResultadoRegistro($registroExitoso);
            } else {
                $error = 'Por favor, complete todos los campos obligatorios.';
                include __DIR__ . '/../views/cliente/registrocliente1.php';
            }
        }
    }

    private function validarCamposRegistro($nombre, $apellido, $correo, $contrasena) {
        if (empty($nombre) || empty($apellido) || empty($correo) || empty($contrasena)) {
            return false;
        }
        return true;
    }

    private function mostrarResultadoRegistro($registroExitoso) {
        if ($registroExitoso) {
            include __DIR__ . '/../views/cliente/registroExitoso.php';
        } else {
            $error = 'Hubo un problema al registrar el cliente.';
            include __DIR__ . '/../views/cliente/registroFallido.php';
        }
    }

    public function mostrarLogin() {
        include __DIR__ ."/../views/cliente/logincliente.php";
    }

    public function procesarLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if ($this->validarCamposLogin($email, $password)) {
                $clienteExistente = $this->clienteModel->buscarPorCorreo($email);
                if ($clienteExistente && password_verify($password, $clienteExistente['contrasena'])) {
                    $this->iniciarSesion($clienteExistente);
                    header('Location: /cliente/perfil'); // Redirigir a /cliente/perfil
                    exit();
                } else {
                    $error = 'Correo o contraseña incorrectos.';
                    include __DIR__ . "/../views/cliente/logincliente.php";
                }
            }
        }
    }

    private function validarCamposLogin($correo, $password) {
        if (empty($correo) || empty($password)) {
            $error = 'Por favor, complete todos los campos.';
            include __DIR__ . "/../views/cliente/logincliente.php";
            return false;
        }
        return true;
    }

    private function iniciarSesion($clienteExistente) {
        session_start();
        $_SESSION['cliente_id'] = $clienteExistente['ID_cliente'];
        $_SESSION['nombre'] = $clienteExistente['nombre'];
        $_SESSION['email'] = $clienteExistente['correo'];
        $_SESSION['telefono'] = $clienteExistente['telefono'];
        $_SESSION['apellido'] = $clienteExistente['apellido'];

        $ultimoAcceso = date("Y-m-d H:i:s");
        setcookie('ultimo_acceso', $ultimoAcceso, time() + 30*24*60*60, "/");
    }

    public function mostrarPerfil(){
        session_start();
        if (!isset($_SESSION['cliente_id'])) {
            header('Location: /cliente/login');
            exit;
        }

        $clienteId = $_SESSION['cliente_id'];
        $historialCompras = $this->clienteModel->obtenerHistorialCompras($clienteId);

        include __DIR__ . '/../views/cliente/PerfilCliente.php';
    }

    public function mostrarUpdate(){
        include __DIR__ . '/../views/cliente/actualizarCliente.php';
    }

    public function actualizarPerfil(){
        session_start();

        if (!isset($_SESSION['cliente_id'])) {
            header('Location: /cliente/login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_SESSION['cliente_id'];
            $nombre = trim($_POST['nombre']);
            $email = trim($_POST['correo']);
            $telefono = trim($_POST['telefono']);
            $apellido = trim($_POST['apellido']);

            if ($this->validarCamposActualizacion($nombre, $email, $telefono, $apellido)) {
                $perfilActualizado = $this->clienteModel->actualizarCliente($id, $nombre, $apellido, $telefono, $email);
                $this->manejarResultadoActualizacion($perfilActualizado, $nombre, $apellido, $email, $telefono);
            } else {
                $_SESSION['error'] = 'Todos los campos son obligatorios.';
                header('Location: /cliente/actualizar');
                exit();
            }
        }
    }

    private function validarCamposActualizacion($nombre, $email, $telefono, $apellido) {
        if (empty($nombre) || empty($email) || empty($telefono) || empty($apellido)) {
            return false;
        }
        return true;
    }

    private function manejarResultadoActualizacion($perfilActualizado, $nombre, $apellido, $email, $telefono) {
        if ($perfilActualizado) {
            $_SESSION['nombre'] = $nombre;
            $_SESSION['apellido'] = $apellido;
            $_SESSION['email'] = $email;
            $_SESSION['telefono'] = $telefono;

            $_SESSION['mensaje'] = 'Datos actualizados con éxito.';
            header('Location: /cliente/perfil');
        } else {
            $_SESSION['error'] = 'Hubo un problema al actualizar los datos.';
            header('Location: /cliente/actualizar');
        }
        exit();
    }

    public function eliminarCliente() {
        session_start();
        if (!isset($_SESSION['cliente_id'])) {
            header("Location: /cliente/login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_SESSION['cliente_id'];
            $correo = $_SESSION['email'];

            if ($id && $correo) {
                $this->clienteModel->eliminarCliente($id, $correo);
                $this->cerrarSesion();
                header("Location: /");
                exit();
            } else {
                echo "No se pudieron encontrar los datos necesarios para eliminar la cuenta.";
            }
        }
    }

    private function cerrarSesion() {
        session_unset();
        session_destroy();
        if (isset($_COOKIE['ultimo_acceso'])) {
            setcookie('ultimo_acceso', '', time() - 3600, '/');
        }
    }

    public function logout(){
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['cliente_id'])) {
                header("Location: /cliente/login");
                exit();
            }
            $this->cerrarSesion();
            header('Location: /');
            exit();
        } else {
            header("Location: /cliente/login");
            exit();
        }
    }

    public function listarClientes() {
        $clienteExistente = $this->clienteModel->obtenerClientes();
        include __DIR__ . '/../views/empleado/listaClientes.php';
    }

    public function mostrarFormsActualizar($cliente_id) {
        $cliente = $this->clienteModel->obtenerClientePorId($cliente_id);
        if ($cliente) {
            include __DIR__ . '/../views/empleado/formsActualizar.php';
        } else {
            echo "Cliente no encontrado.";
        }
    }

    public function actualizarClientAdmin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cliente_id = $_POST['cliente_id'] ?? null;
            $nombre = $_POST['nombre'] ?? null;
            $apellido = $_POST['apellido'] ?? null;
            $telefono = $_POST['telefono'] ?? null;
            $correo = $_POST['correo'] ?? null;

            if ($this->validarCamposActualizacion($nombre, $correo, $telefono, $apellido)) {
                $this->clienteModel->actualizarCliente($cliente_id, $nombre, $apellido, $telefono, $correo);
                header("Location: /registros/clientes");
                exit();
            } else {
                echo "Error al actualizar cliente";
            }
        }
    }

    public function mostrarInfoClientes() {
        $clientes = $this->clienteModel->obtenerClientes();
        include __DIR__ . '/../views/empleado/infoCliente.php';
    }
}
