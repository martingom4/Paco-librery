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

    public function eliminarLibreria($idLibreria): bool {
        try {
            // Iniciar una transacción
            $this->db->beginTransaction();

            // 1. Actualizar las dependencias en las tablas relacionadas
            // Desvincular empleados asociados a la librería
            $queryEmpleados = "UPDATE Empleado SET ID_libreria_e = NULL WHERE ID_libreria_e = :id_libreria";
            $stmtEmpleados = $this->db->prepare($queryEmpleados);
            $stmtEmpleados->execute([':id_libreria' => $idLibreria]);

            // Eliminar inventario relacionado con la librería
            $queryInventario = "DELETE FROM Inventario WHERE ID_libreria_inv = :id_libreria";
            $stmtInventario = $this->db->prepare($queryInventario);
            $stmtInventario->execute([':id_libreria' => $idLibreria]);

            // Desvincular ventas relacionadas con la librería
            $queryVentas = "UPDATE Venta SET ID_libreria_v = NULL WHERE ID_libreria_v = :id_libreria";
            $stmtVentas = $this->db->prepare($queryVentas);
            $stmtVentas->execute([':id_libreria' => $idLibreria]);

            // 2. Eliminar la librería
            $queryLibreria = "DELETE FROM Libreria WHERE ID_libreria = :id_libreria";
            $stmtLibreria = $this->db->prepare($queryLibreria);
            $stmtLibreria->execute([':id_libreria' => $idLibreria]);

            // Confirmar la transacción
            $this->db->commit();
            return true;
        } catch (PDOException $e) {
            // Revertir la transacción en caso de error
            $this->db->rollBack();
            error_log("Error al eliminar la librería: " . $e->getMessage());
            return false;
        }
    }
}
