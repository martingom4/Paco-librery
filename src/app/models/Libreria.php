<?php
class Libreria {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Registrar librería
    public function registrarLibreria($datosLibreria): bool {
        $query = "INSERT INTO Libreria (ID_libreria, nom_lib, corregimiento, calle, num_loc, telefono, correo)
                  VALUES (:id_libreria, :nombre, :corregimiento, :calle, :num_loc, :telefono, :correo)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute($datosLibreria);
    }

    // Actualizar información de librería
    public function actualizarLibreria($datosLibreria): bool {
        $query = "UPDATE Libreria
                  SET nom_lib = :nombre, corregimiento = :corregimiento, calle = :calle, 
                      num_loc = :num_loc, telefono = :telefono, correo = :correo
                  WHERE ID_libreria = :id_libreria";
        $stmt = $this->db->prepare($query);
        return $stmt->execute($datosLibreria);
    }

    // Ver detalles de una librería específica
    public function obtenerLibreriaPorID($idLibreria): ?array {
        $query = "SELECT * FROM Libreria WHERE ID_libreria = :id_libreria";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_libreria', $idLibreria, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    // Obtener todas las librerías
    public function obtenerTodasLasLibrerias(): array {
        $query = "SELECT * FROM Libreria";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
