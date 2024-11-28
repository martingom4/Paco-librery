<?php

class Administrador {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function verificarCredenciales($correo, $password) {
        $query = "SELECT * FROM Admin WHERE correo = :correo";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    public function obtenerAdminPorId($id) {
        $sql = "SELECT * FROM Admin WHERE ID_admin = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>
