<?php
    $host = 'localhost'; // Cambia esto al host de tu base de datos
    $dbname = 'c2031211_cjchica'; // Cambia esto al nombre de tu base de datos
    $username = 'c2031211_system'; // Cambia esto al nombre de usuario de tu base de datos
    $password = 'Dimicgi1006'; // Cambia esto a la contraseña de tu base de datos

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $date = $_POST["date"];
        $amount = $_POST["amount"];
        $type = $_POST["type"];
        $reason = $_POST["reason"];
        $invoice = $_POST["invoice"];
        $plate = $_POST["plate"];
        $provider = $_POST["provider"];

        $sql = "INSERT INTO transacciones (fecha, monto, tipo, razon, factura, placa, proveedor)
                VALUES (:fecha, :monto, :tipo, :razon, :factura, :placa, :proveedor)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':fecha', $date);
        $stmt->bindParam(':monto', $amount);
        $stmt->bindParam(':tipo', $type);
        $stmt->bindParam(':razon', $reason);
        $stmt->bindParam(':factura', $invoice);
        $stmt->bindParam(':placa', $plate);
        $stmt->bindParam(':proveedor', $provider);

        try {
            $stmt->execute();
            echo "¡Datos insertados correctamente!";
        } catch(PDOException $e) {
            echo "Error al insertar datos: " . $e->getMessage();
        }
    } else {
        echo "Error: No se recibieron datos del formulario.";
    }
?>
