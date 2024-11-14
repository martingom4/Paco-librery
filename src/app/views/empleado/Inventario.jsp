<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%@ page import="java.sql.*, oracle.jdbc.OracleTypes" %>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario</title>
    <link rel="shortcut icon" href="../images/LOGO.png" alt="logo">
    <link rel="stylesheet" href="../css/header_footerEmpleado.css">
    <link rel="stylesheet" href="../css/style_inventario.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+GB+S:wght@100..400&display=swap" rel="stylesheet">
</head>
<body>
    <!--HEADER-->
    <header>
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
        <div class="Menu">
            <ul>
                <li><a href="home.html">Home</a></li>
                <li><a href="Inventario.html">Inventario</a></li>
                <li><a href="HistorialVentas.html">Ventas</a></li>
                <li><a href="sobrenosotros.html">Sobre Nosotros</a></li>
                <li><a href="sucursal.html">Contacto</a></li>
            </ul>
            <div class="Usuario">
                <a href="PerfilEmpleado.html"><img src="../images/Usuario.png" alt="Usuario"></a>
                <a href="PerfilEmpleado.html">Mi cuenta</a>
            </div>
        </div>
    </header>

    <main>
        <section id="Container-consulta">
            <div class="titulo-suc1">
                <h1>Inventario</h1>
            </div>
            <form method="post">
                <div class="Consulta-sucursal">
                    <div>
                        <label for="ISBN">ISBN: </label>
                        <input type="text" id="ISBN" name="ISBN" title="Escriba el ISBN" placeholder="0000" required><br>
                    </div>
                    <div>
                        <label for="Sucursal">Sucursal:</label>
                        <select name="Sucursal" id="Sucursal" size="1" title="Seleccione una sucursal" required>
                            <option value="Panamá">Panamá</option>
                            <option value="Arraiján">Arraiján</option>
                            <option value="Chiriquí">Chiriquí</option>
                        </select>
                    </div>
                    <div>
                        <input type="submit" value="Enviar Consulta" id="boton-enviar"><br>
                    </div>
                </div>
            </form>
        </section>

        <section class="Container-inventario">
            <div class="Inventario1">
                <table>
                    <tr>
                        <th>ISBN</th>
                        <th>Titulo</th>
                        <th>Autor</th>
                        <th>Editorial</th>
                        <th>Precio</th>
                        <th>Cantidad Disponible</th>
                    </tr>
                    <!--se va a cargar el inventario aca -->
                    <%
                        if (request.getMethod().equalsIgnoreCase("POST")) {
                            String isbn = request.getParameter("ISBN");
                            String sucursal = request.getParameter("Sucursal");

                            Connection conexion = null;
                            CallableStatement llamada = null;
                            ResultSet rs = null;

                            try {
                                // Cargar el driver de Oracle
                                Class.forName("oracle.jdbc.driver.OracleDriver");

                                // Establecer la conexión con la base de datos Oracle
                                String jdbcUrl = "jdbc:oracle:thin:@localhost:1521:xe";
                                String username = "martin1"; // se ingresa el nombre del usuario de tu base de datos oracle 
                                String password = "1234"; // se ingresa la contraseña de tu usuario 
                                conexion = DriverManager.getConnection(jdbcUrl, username, password);

                                // Llamar al procedimiento almacenado
                                String procedimiento = "{call buscar_libros_por_sucursal(?, ?, ?)}";
                                llamada = conexion.prepareCall(procedimiento);

                                // Establecer los parámetros del procedimiento
                                llamada.setString(1, isbn);
                                llamada.setString(2, sucursal);
								llamada.registerOutParameter(3, OracleTypes.CURSOR);

                                // Ejecutar el procedimiento almacenado
                                llamada.execute();
                                rs = (ResultSet) llamada.getObject(3);

                                // Mostrar los resultados en la tabla
                                if (!rs.isBeforeFirst()) { 
                                    // No hay resultados, mostrar filas predeterminadas
                                    %>
                                    <tr>
                                        <td>1234</td>
                                        <td>El Quijote de la Mancha</td>
                                        <td>Miguel de Cervantes</td>
                                        <td>Sudamericana</td>
                                        <td>$20.00</td>
                                        <td>50</td>
                                    </tr>
                                    <tr>
                                        <td>5678</td>
                                        <td>Cien Años de Soledad</td>
                                        <td>Gabriel García Márquez</td>
                                        <td>Oceano</td>
                                        <td>$25.00</td>
                                        <td>30</td>
                                    </tr>
                                    <tr>
                                        <td>0000</td>
                                        <td>Gamboa Road Gang</td>
                                        <td>Joaquín Beleño</td>
                                        <td>Universitaria</td>
                                        <td>$15.00</td>
                                        <td>25</td>
                                    </tr>
                                    <%
                                } else {
                                    while (rs.next()) {
                                        %>
                                        <tr>
                                            <td><%= rs.getInt("isbn") %></td>
                                            <td><%= rs.getString("titulo") %></td>
                                            <td><%= rs.getString("autor") %></td>
                                            <td><%= rs.getString("editorial") %></td>
                                            <td><%= rs.getString("precio") %></td>
                                            <td><%= rs.getInt("cant_disponible") %></td>
                                        </tr>
                                        <%
                                    }
                                }
                            } catch (Exception e) {
                                out.println("<h2>Error: " + e.getMessage() + "</h2>");
                            } finally {
                                if (rs != null) try { rs.close(); } catch (SQLException e) { e.printStackTrace(); }
                                if (llamada != null) try { llamada.close(); } catch (SQLException e) { e.printStackTrace(); }
                                if (conexion != null) try { conexion.close(); } catch (SQLException e) { e.printStackTrace(); }
                            }
                        } else {
                            // No se ha enviado una consulta, mostrar filas predeterminadas
                            %>
                            <tr>
                                <td>1234</td>
                                <td>El Quijote de la Mancha</td>
                                <td>Miguel de Cervantes</td>
                                <td>Sudamericana</td>
                                <td>$20.00</td>
                                <td>50</td>
                            </tr>
                            <tr>
                                <td>5678</td>
                                <td>Cien Años de Soledad</td>
                                <td>Gabriel García Márquez</td>
                                <td>Oceano</td>
                                <td>$25.00</td>
                                <td>30</td>
                            </tr>
                            <tr>
                                <td>0000</td>
                                <td>Gamboa Road Gang</td>
                                <td>Joaquín Beleño</td>
                                <td>Universitaria</td>
                                <td>$15.00</td>
                                <td>25</td>
                            </tr>
                            <%
                        }
                    %>
                </table>
            </div>
        </section>
    </main>

    <footer>
        <div class="Menu-footer">
            <ul>
                <li><a href="home.html">Home</a></li>
                <li><a href="Inventario.html">Inventario</a></li>
                <li><a href="HistorialVentas.html">Ventas</a></li>
                <li><a href="sobrenosotros.html">Sobre Nosotros</a></li>
                <li><a href="sucursal.html">Contacto</a></li>
            </ul>
            <div class="Usuario-footer">
                <a href="PerfilEmpleado.html"><img src="../images/Usuario.png" alt="Usuario"></a>
                <a href="PerfilEmpleado.html">Mi cuenta</a>
            </div>
            <ul>
                <li><a href="perfiles.html">Cerrar Sesión</a></li>
            </ul>
        </div>
        <div class="Copyright">
            <p>© 2024, Libreria ¡Donde Paco!</p>
        </div>
    </footer>
</body>
</html>


