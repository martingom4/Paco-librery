<?php

class Administrador {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function buscarPorCorreo($correo) {
        $query = "SELECT * FROM Admin WHERE correo = :correo";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result !== false ? $result : [];
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
