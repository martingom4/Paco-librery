<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<%@ page import="java.sql.*, oracle.jdbc.OracleTypes" %>

<!DOCTYPE html>
<html lang="es">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cátalogo</title>
    <link rel="shortcut icon" href="../images/LOGO.PNG" alt="logo">
    <!--Documentos CSS utilizados-->
    <link rel="stylesheet" href="../css/catalogo.css">
    <!---Fuente Nunito de Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <!---Fuente Playwrite England SemiJoined de Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+GB+S:wght@100..400&display=swap" rel="stylesheet">
</head>
<body>
   <jsp:include page="header.jsp" />

    <main>
        <div class="main-content">
            <aside class="filter-section">
                <h3>Filtrar</h3>
                <form method="post" action="catalogo.jsp">
                    <div class="filter-group">
                        <label for="autor">Por autor</label>
                        <input type="text" id="autor" name="autor" title="Escriba el Autor" placeholder="Gabriel García Márquez">
                    </div>
                    <div class="filter-group">
                        <label for="editorial">Por editorial</label>
                        <select id="editorial" name="editorial">
                            <option value="" selected>Seleccione una editorial</option>
                            <option value="Oceano">Oceano</option>
                            <option value="Sudamericana">Sudamericana</option>
                            <option value="Universitaria">Universitaria</option>
                        </select>
                    </div>
                    <button type="submit" class="btn-filtrar">Filtrar</button>
                </form>
            </aside>
            <section class="catalog-section">
                <%
                    String autor = request.getParameter("autor");
                    String editorial = request.getParameter("editorial");

                    if ((autor != null && !autor.isEmpty()) || (editorial != null && !editorial.isEmpty())) {
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
                            String procedimiento = "{call buscar_libros(?, ?, ?)}";
                            llamada = conexion.prepareCall(procedimiento);

                            // Establecer los parámetros del procedimiento
                            llamada.setString(1, autor);
                            llamada.setString(2, editorial);
                            llamada.registerOutParameter(3, OracleTypes.CURSOR);

                            // Ejecutar el procedimiento almacenado
                            llamada.execute();
                            rs = (ResultSet) llamada.getObject(3);

                            // Mostrar los resultados en la tabla
                            while (rs.next()) {
                                String isbn = rs.getString("isbn");
                                String titulo = rs.getString("titulo");
                                String autorLibro = rs.getString("autor");
                                String editorialLibro = rs.getString("editorial");
                                String precio = rs.getString("precio");
                                %>
                                <div class="product-card">
                                    <img src="../images/cienanosdesoledad.jpg" alt="Imagen del producto">
                                    <h4><%= titulo %></h4>
                                    <p>Autor: <%= autorLibro %></p>
                                    <p>Editorial: <%= editorialLibro %></p>
                                    <p>Precio: <%= precio %></p>
                                    <button><a href="comprar.html">Comprar</a></button>
                                </div>
                                <%
                            }
                        } catch (Exception e) {
                            out.println("<h2>Error: " + e.getMessage() + "</h2>");
                        } finally {
                            if (rs != null) try { rs.close(); } catch (SQLException e) { e.printStackTrace(); }
                            if (llamada != null) try { llamada.close(); } catch (SQLException e) { e.printStackTrace(); }
                            if (conexion != null) try { conexion.close(); } catch (SQLException e) { e.printStackTrace(); }
                        }
                    }
                %>
            </section>
        </div>
    </main>

    <footer>
        <jsp:include page="footer.jsp" />
    <script src="../scripts/home.js"></script>
    </footer>
    <script src="../scripts/catalogo.js"></script>
</body>
</html>


