<%@ page language="java" contentType="text/html; charset=ISO-8859-1" pageEncoding="ISO-8859-1"%>
<%@ page import="java.sql.*" %>
<%@ page import="java.util.logging.*" %>

<%
    // Crear una instancia del logger
    Logger logger = Logger.getLogger("MyLogger");

    String email = request.getParameter("email");
    String contrasena = request.getParameter("password");

    Connection conexion = null;
    PreparedStatement orden = null;
    ResultSet resultado = null;

    try {
        Class.forName("oracle.jdbc.driver.OracleDriver");
        String jdbcUrl = "jdbc:oracle:thin:@localhost:1521:xe";
        String username = "martin1"; 
        String password = "1234"; 
        conexion = DriverManager.getConnection(jdbcUrl, username, password);

        String verificacion_sql = "SELECT * FROM reg_empleado WHERE EMAIL = ? AND CONTRASENA = ?";
        orden = conexion.prepareStatement(verificacion_sql);
        orden.setString(1, email);
        orden.setString(2, contrasena);

        // Log the exact query being executed
        logger.info("Executing query: " + verificacion_sql + " with parameters email=" + email + " and password " + contrasena); // Mask the password for security

        resultado = orden.executeQuery();

        if (resultado.next()) {
            // Log the response of the query
            logger.info("Query successful: User found with email=" + email);
            session.setAttribute("usuario", resultado.getString("nombre"));
            session.setAttribute("cod_libreria", resultado.getString("cod_libreria"));
            session.setAttribute("cargo", resultado.getString("cargo"));
            session.setAttribute("email", resultado.getString("email"));
            session.setAttribute("tipoUsuario", "empleado");
            response.sendRedirect("home.jsp");
        } else {
            // Log the response of the query
            logger.info("Query result: No user found with email=" + email);
            out.println("<h2>Correo o contraseña incorrectos. Por favor, intente nuevamente.</h2>");
        }
    } catch (Exception e) {
        // Log the exception
        logger.severe("Error during query execution: " + e.getMessage());
        e.printStackTrace();
        out.println("<h2>Hubo un error en el inicio de sesión. Por favor, intente nuevamente.</h2>");
        out.println("<p>Error: " + e.getMessage() + "</p>");
    } finally {
        if (resultado != null) try { resultado.close(); } catch (SQLException ignore) {}
        if (orden != null) try { orden.close(); } catch (SQLException ignore) {}
        if (conexion != null) try { conexion.close(); } catch (SQLException ignore) {}
    }
%>