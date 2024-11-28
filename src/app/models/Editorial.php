<?php
class Editorial{

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getEditorial(): array {
        $query = "SELECT * FROM Editorial";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
    public function addEditorial($nombre, $corregimiento, $calle, $num_loc, $telefono, $correo) {
        $query = "INSERT INTO Editorial (nombre, corregimiento, calle, num_loc, telefono, correo) VALUES (:nombre, :corregimiento, :calle, :num_loc, :telefono, :correo)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':corregimiento', $corregimiento);
        $stmt->bindParam(':calle', $calle);
        $stmt->bindParam(':num_loc', $num_loc);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();
    }

    public function eliminarEditorial($id) {
        $query = "DELETE FROM Editorial WHERE ID_editorial = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
