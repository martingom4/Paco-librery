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

    
}