<?php

class Empleado {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function obtenerEmpleados() {
        $sql = "SELECT * FROM Empleado";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerEmpleadoPorId($id) {
        $sql = "SELECT * FROM Empleado WHERE ID_empleado = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarEmpleado($id, $data) {
        $sql = "UPDATE Empleado SET telefono = :telefono, correo = :correo, contrasena = :contrasena, sueldo = :sueldo WHERE ID_empleado = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':telefono', $data['telefono']);
        $stmt->bindParam(':correo', $data['correo']);
        $stmt->bindParam(':contrasena', $data['contrasena']);
        $stmt->bindParam(':sueldo', $data['sueldo']);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function eliminarEmpleado($id) {
        $sql = "DELETE FROM Empleado WHERE ID_empleado = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function agregarEmpleado($data) {
        $sql = "INSERT INTO Empleado (CIP, nombre, apellido, nacionalidad, fecha_contrato, fecha_nac, edad, sueldo, cargo, telefono, correo, contrasena, ID_libreria_e) VALUES (:CIP, :nombre, :apellido, :nacionalidad, :fecha_contrato, :fecha_nac, :edad, :sueldo, :cargo, :telefono, :correo, :contrasena, :id_libreria)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':CIP', $data['CIP']);
        $stmt->bindParam(':nombre', $data['nombre']);
        $stmt->bindParam(':apellido', $data['apellido']);
        $stmt->bindParam(':nacionalidad', $data['nacionalidad']);
        $stmt->bindParam(':fecha_contrato', $data['fecha_contrato']);
        $stmt->bindParam(':fecha_nac', $data['fecha_nac']);
        $stmt->bindParam(':edad', $data['edad']);
        $stmt->bindParam(':sueldo', $data['sueldo']);
        $stmt->bindParam(':cargo', $data['cargo']);
        $stmt->bindParam(':telefono', $data['telefono']);
        $stmt->bindParam(':correo', $data['correo']);
        $stmt->bindParam(':contrasena', $data['contrasena']);
        $stmt->bindParam(':id_libreria', $data['id_libreria']);
        return $stmt->execute();
    }
}
?>
