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
                    $_SESSION['email']=$clienteExistente['correo'];
                    $_SESSION['telefono']=$clienteExistente['telefono'];
                    $_SESSION['apellido']=$clienteExistente['apellido'];

                    //cookie de ultimo acceso
                    $ultimoAcceso = date("Y-m-d H:i:s"); // La fecha y hora actual
                    setcookie('ultimo_acceso', $ultimoAcceso, time() + 30*24*60*60, "/");  // La cookie durará 30 días
        
    
                    // Redirigir al catálogo o a cualquier página deseada
                    include __DIR__ . "/../views/cliente/loginExitoso.php";
                } else {
                    // Si las credenciales no son correctas
                    $error = 'Correo o contraseña incorrectos.';
                    include __DIR__ . "/../views/cliente/logincliente.php";
                }
            }
        }

    public function mostrarPerfil(){

        include __DIR__ . '/../views/cliente/PerfilCliente.php';
    }

    public function mostrarUpdate(){
        include __DIR__ . '/../views/cliente/actualizarCliente.php';
    }

    public function actualizarPerfil(){
        session_start();

        if (!isset($_SESSION['cliente_id'])) {
            header('Location: /cliente/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_SESSION['cliente_id'];
            $nombre = trim($_POST['nombre']);
            $email = trim($_POST['correo']);
            $telefono = trim($_POST['telefono']);
            $apellido = trim($_POST['apellido']);

            // Validar datos
            if (empty($nombre) || empty($email) || empty($telefono) || empty($apellido)) {
                $_SESSION['error'] = 'Todos los campos son obligatorios.';
                header('Location: /cliente/actualizar');
                exit;
            }

             // Actualizar en la base de datos
            $perfilActualizado = $this->clienteModel->actualizarCliente($id, $nombre, $apellido, $telefono, $email);

            if ($perfilActualizado) {
                // Actualizar datos en la sesión
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
            exit;
        }
    }
    public function logout(){
        session_start();
        if (!isset($_SESSION['cliente_id'])) {
            header("Location: /cliente/login");
            exit();
        }
        session_unset();
        session_destroy();
        header('Location: /');
        exit(); 
    }
}
