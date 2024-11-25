<?php

class Cliente {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Método para buscar un cliente por correo
    public function buscarPorCorreo($correo) {
        $query = "SELECT * FROM Cliente WHERE correo = :correo";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para registrar un nuevo cliente
    public function registrarCliente($nombre, $apellido, $contrasena, $telefono, $correo) {
        $query = "INSERT INTO Cliente (nombre, apellido, contrasena, telefono, correo)
                  VALUES (:nombre, :apellido, :contrasena, :telefono, :correo)";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':contrasena', $contrasena);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':correo', $correo);

        return $stmt->execute();
    }

    public function actualizarCliente($id, $nombre, $apellido, $telefono, $correo) {
        $sql = "UPDATE Cliente SET nombre = :nombre, apellido = :apellido, telefono = :telefono, correo = :correo WHERE ID_cliente = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function eliminarCliente($id, $correo) {
        $query = "DELETE FROM Cliente WHERE ID_cliente = :id AND correo = :correo";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); // ID del cliente
        $stmt->bindParam(':correo', $correo, PDO::PARAM_STR); // Correo del cliente
        return $stmt->execute();
    }

    // Obtener todos los clientes
    public function obtenerClientes(): array {
        $query = "SELECT * FROM Cliente";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerClientePorId($id) {
        $query = "SELECT * FROM Cliente WHERE ID_cliente = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para obtener el historial de compras del cliente
    public function obtenerHistorialCompras($clienteId) {
        $query = "SELECT p.fecha_pago AS fecha, l.imagen, l.titulo, vd.cantidad, vd.precio
                  FROM Venta v
                  JOIN VentaDetalle vd ON v.ID_venta = vd.ID_venta
                  JOIN Libro l ON vd.ISBN = l.ISBN
                  JOIN Pago p ON v.ID_venta = p.ID_venta
                  WHERE v.ID_cliente_v = :clienteId";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':clienteId', $clienteId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
