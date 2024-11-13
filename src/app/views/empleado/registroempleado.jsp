<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%@ page import="java.sql.*" %>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Empleado</title>
    <link rel="shortcut icon" href="../images/LOGO.png" alt="logo">
    <!--Documentos CSS utilizados-->
    <link rel="stylesheet" href="../css/registro.css">
    <!--Fuente Nunito de Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <!--Fuente Playwrite England SemiJoined de Google Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+GB+S:wght@100..400&display=swap" rel="stylesheet">
</head>
<body>
    <!--HEADER-->
    <header>
        <!--LOGO Y REDES-->
        <div class="LogoRedes">
            <div class="logo">
                <img src="../images/LOGO.png" alt="Librería ¡Donde Paco!">
            </div>
            <div class="Redes">
                <ul>
                    <li><a href="https://www.instagram.com"><img src="../images/Instagram.png" alt="Instagram"></a></li>
                    <li><a href="https://www.facebook.com"><img src="../images/Facebook.png" alt="Facebook"></a></li>
                    <li><a href="https://www.google.com/webhp?hl=es&sa=X&ved=0ahUKEwjdofSloIGHAxVQmYQIHetICooQPAgI"><img src="../images/Buscar.png" alt="Buscar"></a></li>
                </ul>
            </div>
        </div>
        <!--MENU-->
        <div class="Menu">
            <ul>
                <li><a href="home.html">Home</a></li>
                <li><a href="sobrenosotros.html">Sobre Nosotros</a></li>
                <li><a href="sucursal.html">Contacto</a></li>
            </ul>
            <div class="Usuario">
                <a href="perfiles.html"><img src="../images/Usuario.png" alt="Usuario"></a>
                <a href="perfiles.html">Iniciar Sesión</a>
            </div>
        </div>
    </header>

    <!--MAIN-->
    <main>
        <div class="registro-container">
            <div class="registro-box">
                <h2>Registro de Empleado</h2>
                <hr>
                <% 
                    boolean registroExitoso = false;
                    if (request.getMethod().equalsIgnoreCase("POST")) {
                        // Obtener los parámetros del formulario
                        String nombre = request.getParameter("nombre");
                        String segundo_nombre = request.getParameter("segundo_nombre");
                        String apellido = request.getParameter("apellido");
                        String segundo_apellido = request.getParameter("segundo_apellido");
                        String contrasena = request.getParameter("contrasena");
                        String email = request.getParameter("email");
                        String fecha_nac = request.getParameter("fecha_nacimiento");
                        String cargo = request.getParameter("cargo");
                        String cod_libreria = request.getParameter("codigo_libreria");

                        if (nombre != null && apellido != null && contrasena != null && email != null && fecha_nac != null && cargo != null && cod_libreria != null) {
                            Connection conexion = null;
                            CallableStatement llamada = null;

                            try {
                                // Cargar el driver de Oracle
                                Class.forName("oracle.jdbc.driver.OracleDriver");

                                // Establecer la conexión con la base de datos Oracle
                                String jdbcUrl = "jdbc:oracle:thin:@localhost:1521:xe";
                                String username = "martin1"; // se ingresa el nombre del usuario de tu base de datos oracle 
                                String password = "1234"; // se ingresa la contraseña de tu usuario 
                                conexion = DriverManager.getConnection(jdbcUrl, username, password);

                                // Llamar al procedimiento almacenado
                                String procedimiento = "{call registrar_empleado(?, ?, ?, ?, ?, ?, ?, ?, ?)}";
                                llamada = conexion.prepareCall(procedimiento);

                                // Establecer los parámetros del procedimiento
                                llamada.setString(1, email);
                                llamada.setString(2, nombre);
                                llamada.setString(3, segundo_nombre);
                                llamada.setString(4, apellido);
                                llamada.setString(5, segundo_apellido);
                                llamada.setString(6, contrasena);
                                llamada.setDate(7, Date.valueOf(fecha_nac));
                                llamada.setString(8, cargo);
                                llamada.setInt(9, Integer.parseInt(cod_libreria));

                                // Ejecutar el procedimiento almacenado
                                llamada.execute();
                                
                                // Marcar el registro como exitoso
                                registroExitoso = true;
                            } catch (Exception e) {
                                out.println("<h2>Error en el registro: " + e.getMessage() + "</h2>");
                            } finally {
                                if (llamada != null) try { llamada.close(); } catch (SQLException e) { e.printStackTrace(); }
                                if (conexion != null) try { conexion.close(); } catch (SQLException e) { e.printStackTrace(); }
                            }
                        }
                    }
                %>
                <% if (registroExitoso) { %>
                <div class="mensaje-exito">
                    <h2>REGISTRO EXITOSO</h2>
                    <p>Su registro se ha completado exitosamente.</p>
                    <a href="PerfilEmpleado.html">Ir a mi cuenta</a>
                </div>
                <% } else { %>
                <form method="post">
                    <div class="input-group">
                        <input type="text" name="nombre" placeholder="Nombre" required>
                        <input type="text" name="segundo_nombre" placeholder="Segundo nombre">
                    </div>
                    <div class="input-group">
                        <input type="text" name="apellido" placeholder="Apellido" required>
                        <input type="text" name="segundo_apellido" placeholder="Segundo apellido">
                    </div>
                    <input type="password" name="contrasena" placeholder="Contraseña" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                    <input type="date" name="fecha_nacimiento" required>
                    <div class="input-group">
                        <input type="text" name="cargo" placeholder="Cargo" required>
                        <input type="text" name="codigo_libreria" placeholder="Codigo librería" required>
                    </div>
                    <button type="submit" class="btn">Confirmar</button>
                </form>
                <% } %>
            </div>
        </div>
    </main>

    <footer>
        <!--MENU-->
        <div class="Menu-footer">
            <ul>
                <li><a href="home.html">Home</a></li>
                <li><a href="sobrenosotros.html">Sobre Nosotros</a></li>
                <li><a href="sucursal.html">Contacto</a></li>
            </ul>
            <div class="Usuario-footer">
                <a href="perfiles.html"><img src="../images/Usuario.png" alt="Usuario"></a>
                <a href="perfiles.html">Iniciar Sesión</a>
            </div>
        </div>
        <!--COPYRIGHT-->
        <div class="Copyright">
            <p>© 2024, Libreria ¡Donde Paco!</p>
        </div>
    </footer>
</body>
</html>