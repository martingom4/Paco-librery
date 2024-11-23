<?php

require_once __DIR__ . '/../models/Cliente.php';

class ClientesController {

    private $clienteModel;

    public function __construct($db){
        $this->clienteModel=new Cliente($db);

    }

    public function index() {
        // Código para mostrar la lista de clientes
    }

    public function mostrarRegistro() {
        // Código para mostrar el formulario de registro de cliente
        include __DIR__ ."/../views/cliente/registrocliente1.php";
    }

    public function crearCliente() {
        // Código para crear un nuevo cliente
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recoger datos del formulario
            $nombre = trim($_POST['nombre'] ?? '');
            $apellido = trim($_POST['apellido'] ?? '');
            $correo = trim($_POST['correo'] ?? '');
            $contrasena = password_hash(trim($_POST['contrasena'] ?? ''),PASSWORD_BCRYPT);
            $telefono = trim($_POST['telefono'] ?? '');

            // Validaciones básicas
            if (empty($nombre) || empty($apellido) || empty($correo) || empty($contrasena)) {
                $error = 'Por favor, complete todos los campos obligatorios.';
                include __DIR__ . '/../views/cliente/registrocliente1.php';
                return;
            }

            // Validar que el correo sea único
            $clienteExistente = $this->clienteModel->buscarPorCorreo($correo);
            if ($clienteExistente) {
                $error = 'Este correo ya está registrado.';
                include __DIR__ . '/../views/cliente/registrocliente1.php';  // Mostrar formulario con error
                return;
            }
            // Crear un nuevo cliente
            $registroExitoso= $this->clienteModel->registrarCliente($nombre, $apellido, $contrasena, $telefono, $correo);
            
            if ($registroExitoso) {
                include __DIR__ . '/../views/cliente/registroExitoso.php';
            } else {
                include __DIR__ . '/../views/cliente/registroFallido.php';
            }
        }
    }

    public function mostrarLogin() {
        include __DIR__ ."/../views/cliente/logincliente.php";
    }
    public function procesarLogin() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $correo = trim($_POST['email'] ?? '');
                $password = trim($_POST['password'] ?? '');
    
                // Validación de campos vacíos
                if (empty($correo) || empty($password)) {
                    $error = 'Por favor, complete todos los campos.';
                    include __DIR__ . "/../views/cliente/logincliente.php";
                    return;
                }
    
                // Verificar si el cliente existe en la base de datos
                $clienteExistente = $this->clienteModel->buscarPorCorreo($correo);
    
                if ($clienteExistente && password_verify($password, $clienteExistente['contrasena'])) {
                    // Si las credenciales son correctas, iniciar sesión
                    session_start();  // Iniciar la sesión
                    $_SESSION['cliente_id'] = $clienteExistente['ID_cliente'];  // Almacenar ID del cliente en la sesión
                    $_SESSION['nombre']= $clienteExistente['nombre'];
    
                    // Redirigir al catálogo o a cualquier página deseada
                    include __DIR__ . "/../views/cliente/loginExitoso.php";
                } else {
                    // Si las credenciales no son correctas
                    $error = 'Correo o contraseña incorrectos.';
                    include __DIR__ . "/../views/cliente/logincliente.php";
                }
            }
        }
    }
