<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%@ page import="java.sql.*, oracle.jdbc.OracleTypes, java.text.SimpleDateFormat" %>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Ventas</title>
    <link rel="shortcut icon" href="../images/LOGO.png" alt="logo">
    <link rel="stylesheet" href="../css/header_footerEmpleado.css">
    <link rel="stylesheet" href="../css/HistorialVentas.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+GB+S:wght@100..400&display=swap" rel="stylesheet">
</head>
<body>
    <jsp:include page="header.jsp" />

    <main>
        <section id="Container-consulta">
            <div class="titulo-suc1">
                <h1>Historial de Ventas</h1>
            </div>
            <form method="post">
                <div class="Consulta-sucursal">
                    <div>
                        <label for="num_factura">Num de Factura: </label>
                        <input type="text" id="num_factura" name="num_factura" title="Escriba el número de factura" placeholder="0000"><br>
                    </div>
                    <div>
                        <label for="Sucursal">Sucursal:</label>
                        <select name="Sucursal" id="Sucursal" size="1" title="Seleccione una sucursal">
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
                        <th>Num. de Factura</th>
                        <th>Sucursal</th>
                        <th>Hora</th>
                        <th>Fecha</th>
                        <th>Costo Total</th>
                        <th>Cantidad</th>
                        <th></th>
                    </tr>
                    <!--se va a cargar el historial de ventas acá -->
                    <%
                        if (request.getMethod().equalsIgnoreCase("POST")) {
                            String numFactura = request.getParameter("num_factura");
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
                                String procedimiento = "{call p_historial_ventas(?, ?, ?)}";
                                llamada = conexion.prepareCall(procedimiento);

                                // Establecer los parámetros del procedimiento
                                if (numFactura != null && !numFactura.isEmpty()) {
                                    llamada.setString(1, numFactura);
                                } else {
                                    llamada.setNull(1, java.sql.Types.VARCHAR);
                                }
                                llamada.setString(2, sucursal);
                                llamada.registerOutParameter(3, OracleTypes.CURSOR);

                                // Ejecutar el procedimiento almacenado
                                llamada.execute();
                                rs = (ResultSet) llamada.getObject(3);

                                // Formatear las fechas y horas
                                SimpleDateFormat dateFormatter = new SimpleDateFormat("dd/MM/yyyy");
                                SimpleDateFormat timeFormatter = new SimpleDateFormat("HH:mm");

                                // Mostrar los resultados en la tabla
                                if (!rs.isBeforeFirst()) { 
                                    // No hay resultados, mostrar filas predeterminadas
                                    %>
                                    <tr id="fila-data">
                                        <td>001</td>
                                        <td>Panamá</td>
                                        <td>10:30</td>
                                        <td>01/07/2024</td>
                                        <td>20</td>
                                        <td>1</td>
                                        <td><a href="VerDetalles.html" class="btn-ver-detalles">Ver detalles</a></td>
                                    </tr>
                                    <tr id="fila-data">
                                        <td>002</td>
                                        <td>Arraiján</td>
                                        <td>11:00</td>
                                        <td>02/07/2024</td>
                                        <td>50</td>
                                        <td>2</td>
                                        <td><a href="VerDetalles.html" class="btn-ver-detalles">Ver detalles</a></td>
                                    </tr>
                                    <tr id="fila-data">
                                        <td>003</td>
                                        <td>Chiriquí</td>
                                        <td>09:45</td>
                                        <td>03/07/2024</td>
                                        <td>15</td>
                                        <td>1</td>
                                        <td><a href="VerDetalles.html" class="btn-ver-detalles">Ver detalles</a></td>
                                    </tr>
                                    <tr id="fila-data">
                                        <td>004</td>
                                        <td>Chiriquí</td>
                                        <td>09:00</td>
                                        <td>04/07/2024</td>
                                        <td>30</td>
                                        <td>2</td>
                                        <td><a href="VerDetalles.html" class="btn-ver-detalles">Ver detalles</a></td>
                                    </tr>
                                    <tr id="ultimafila">
                                        <td>005</td>
                                        <td>Panamá</td>
                                        <td>11:00</td>
                                        <td>05/07/2024</td>
                                        <td>30</td>
                                        <td>2</td>
                                        <td><a href="VerDetalles.html" class="btn-ver-detalles">Ver detalles</a></td>
                                    </tr>
                                    <%
                                } else {
                                    while (rs.next()) {
                                        String formattedHora = timeFormatter.format(rs.getTimestamp("hora"));
                                        String formattedFecha = dateFormatter.format(rs.getDate("fecha"));
                                        %>
                                        <tr>
                                            <td><%= rs.getString("num_factura").trim() %></td>
                                            <td><%= rs.getString("sucursal").trim() %></td>
                                            <td><%= formattedHora %></td>
                                            <td><%= formattedFecha %></td>
                                            <td><%= rs.getBigDecimal("costo_total") %></td>
                                            <td><%= rs.getInt("cantidad") %></td>
                                            <td><a href="VerDetalles.html" class="btn-ver-detalles">Ver detalles</a></td>
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
                            <tr id="fila-data">
                                <td>001</td>
                                <td>Panamá</td>
                                <td>10:30</td>
                                <td>01/07/2024</td>
                                <td>20</td>
                                <td>1</td>
                                <td><a href="VerDetalles.html" class="btn-ver-detalles">Ver detalles</a></td>
                            </tr>
                            <tr id="fila-data">
                                <td>002</td>
                                <td>Arraiján</td>
                                <td>11:00</td>
                                <td>02/07/2024</td>
                                <td>50</td>
                                <td>2</td>
                                <td><a href="VerDetalles.html" class="btn-ver-detalles">Ver detalles</a></td>
                            </tr>
                            <tr id="fila-data">
                                <td>003</td>
                                <td>Chiriquí</td>
                                <td>09:45</td>
                                <td>03/07/2024</td>
                                <td>15</td>
                                <td>1</td>
                                <td><a href="VerDetalles.html" class="btn-ver-detalles">Ver detalles</a></td>
                            </tr>
                            <tr id="fila-data">
                                <td>004</td>
                                <td>Chiriquí</td>
                                <td>09:00</td>
                                <td>04/07/2024</td>
                                <td>30</td>
                                <td>2</td>
                                <td><a href="VerDetalles.html" class="btn-ver-detalles">Ver detalles</a></td>
                            </tr>
                            <tr id="ultimafila">
                                <td>005</td>
                                <td>Panamá</td>
                                <td>11:00</td>
                                <td>05/07/2024</td>
                                <td>30</td>
                                <td>2</td>
                                <td><a href="VerDetalles.html" class="btn-ver-detalles">Ver detalles</a></td>
                            </tr>
                            <%
                        }
                    %>
                </table>
            </div>
        </section>
    </main>

    <jsp:include page="footer.jsp" />
    <script src="../scripts/home.js"></script>
</body>
</html>


