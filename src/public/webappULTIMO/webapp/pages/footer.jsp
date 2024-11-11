<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<%
    String tipoUsuario = (String) session.getAttribute("tipoUsuario");
%>

<% if ("empleado".equals(tipoUsuario)) { %>
    <!--FOOTER PARA EMPLEADO-->
    <footer>
        <!--MENU-->
        <div class="Menu-footer">
            <ul>
                <li><a href="home.html">Home</a></li>
                <li><a href="Inventario.jsp">Inventario</a></li>
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
        <!--COPYRIGHT-->
        <div class="Copyright">
            <p>Â© 2024, Libreria ¡Donde Paco!</p>
        </div>
    </footer>
<% } else { %>
    <!--FOOTER PARA CLIENTE-->
    <footer>
        <!--MENU-->
        <div class="Menu-footer">
            <ul>
                <li><a href="home.html">Home</a></li>
                <li><a href="catalogo.jsp">Catálogo</a></li>
                <li><a href="sobrenosotros.html">Sobre Nosotros</a></li>
                <li><a href="sucursal.html">Contacto</a></li>
            </ul>
            <div class="Usuario-footer">
                <a href="PerfilCliente.html"><img src="../images/Usuario.png" alt="Usuario"></a>
                <a href="PerfilCliente.html">Mi cuenta</a>
            </div>
            <ul>
                <li><a href="perfiles.html">Cerrar Sesión</a></li>
            </ul>
        </div>
        <!--COPYRIGHT-->
        <div class="Copyright">
            <p>© 2024, Libreria ¡Donde Paco!</p>
        </div>
    </footer>
<% } %>