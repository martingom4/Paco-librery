<%@ page contentType="text/html; charset=UTF-8" language="java" %>
<%@ page import="jakarta.servlet.http.HttpSession" %>

<%
    // Obtener la sesión actual
    HttpSession currentsession = request.getSession(false);
    if (session == null || session.getAttribute("usuario") == null) {
        response.sendRedirect("logincliente.jsp"); // Redirige al login si no hay sesión activa
        return;
    }

    String usuario = (String) session.getAttribute("usuario");
    String email = (String) session.getAttribute("email");
%>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi cuenta</title>
    <link rel="shortcut icon" href="../images/LOGO.png" alt="logo">
    <link rel="stylesheet" href="../css/PerfilCliente.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+GB+S:wght@100..400&display=swap" rel="stylesheet">
</head>
<body>
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
                <li><a href="catalogo.html">Catálogo</a></li>
                <li><a href="sobrenosotros.html">Sobre Nosotros</a></li>
                <li><a href="sucursal.html">Contacto</a></li>
            </ul>
            <div class="Usuario">
                <a href="PerfilCliente.jsp"><img src="../images/Usuario.png" alt="Usuario"></a>
                <a href="PerfilCliente.jsp">Mi cuenta</a>
            </div>
        </div>
    </header>

    <main>
        <section class="titulo">
            <h1>Mi cuenta</h1>
        </section>
        <section class="Container-infoper">
            <div class="campoizquierdo">
                <div class="fotoperfil">
                    <img src="../images/sinfotoperfil.png" alt="FotoPerfil" title="Foto de Perfil">
                </div>
                <div class="boton">
                    <button id="boton-editar">Editar perfil</button>
                </div>
            </div>
            <div class="infop">
                <h4>Nombre: <%= usuario %></h4>
                <h4>Email: <%= email %></h4>
                <h4>Contraseña: ****</h4>
            </div>
        </section>

        <section class="titulo">
            <h1>Historial de Compras</h1>
        </section>
        <section class="Container-historial">
            <div class="imagenlibro">
                <img src="../images/cienanosdesoledad.jpg">
            </div>
            <div class="infolibro">
                <h2>Cien años de soledad</h2>
                <p>Cien años de soledad es una novela del escritor colombiano Gabriel García Márquez, ganador del Premio Nobel de Literatura en 1982. Es considerada una obra maestra de la literatura hispanoamericana y universal, así como una de las obras más traducidas y leídas en español.</p>
                <h4>Fecha compra: 01/07/2024</h4>
                <h4>Precio: $15.00</h4>
            </div>
        </section>
        <section class="Container-historial">
            <div class="imagenlibro">
                <img src="../images/rayuela.jpg">
            </div>
            <div class="infolibro">
                <h2>Rayuela</h2>
                <p>Rayuela es la segunda novela del escritor argentino Julio Cortázar. Constituye una de las obras centrales del boom latinoamericano y de la literatura en español.</p>
                <h4>Fecha compra: 30/06/2024</h4>
                <h4>Precio: $20.00</h4>
            </div>
        </section>
    </main>
    <jsp:include page="footer.jsp" />
