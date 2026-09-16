<?php
header("Content-Type: application/json; charset=UTF-8");
require_once "config.php";

$method = $_SERVER["REQUEST_METHOD"];

try {
    switch ($method) {
        case "GET":
            $stmt = $pdo->query("SELECT id, destinatario, direccion, descripcion, creado_en FROM envios ORDER BY id DESC");
            echo json_encode($stmt->fetchAll());
            break;

        case "POST":
            $data = json_decode(file_get_contents("php://input"), true);

            if (!is_array($data)) {
                throw new Exception("Datos JSON inválidos.");
            }

            $destinatario = trim($data["destinatario"] ?? "");
            $direccion = trim($data["direccion"] ?? "");
            $descripcion = trim($data["descripcion"] ?? "");

            if ($destinatario === "" || $direccion === "" || $descripcion === "") {
                http_response_code(400);
                echo json_encode(["error" => "Todos los campos son obligatorios."]);
                exit;
            }

            $stmt = $pdo->prepare(
                "INSERT INTO envios (destinatario, direccion, descripcion)
                 VALUES (?, ?, ?)"
            );
            $stmt->execute([$destinatario, $direccion, $descripcion]);

            echo json_encode([
                "mensaje" => "Envío creado correctamente.",
                "id" => $pdo->lastInsertId()
            ]);
            break;

        case "PUT":
            $data = json_decode(file_get_contents("php://input"), true);
            $id = intval($data["id"] ?? 0);

            if ($id <= 0) {
                http_response_code(400);
                echo json_encode(["error" => "ID inválido."]);
                exit;
            }

            $destinatario = trim($data["destinatario"] ?? "");
            $direccion = trim($data["direccion"] ?? "");
            $descripcion = trim($data["descripcion"] ?? "");

            if ($destinatario === "" || $direccion === "" || $descripcion === "") {
                http_response_code(400);
                echo json_encode(["error" => "Todos los campos son obligatorios."]);
                exit;
            }

            $stmt = $pdo->prepare(
                "UPDATE envios
                 SET destinatario = ?, direccion = ?, descripcion = ?
                 WHERE id = ?"
            );
            $stmt->execute([$destinatario, $direccion, $descripcion, $id]);

            echo json_encode(["mensaje" => "Envío actualizado correctamente."]);
            break;

        case "DELETE":
            $id = intval($_GET["id"] ?? 0);

            if ($id <= 0) {
                http_response_code(400);
                echo json_encode(["error" => "ID inválido."]);
                exit;
            }

            $stmt = $pdo->prepare("DELETE FROM envios WHERE id = ?");
            $stmt->execute([$id]);

            echo json_encode(["mensaje" => "Envío eliminado correctamente."]);
            break;

        default:
            http_response_code(405);
            echo json_encode(["error" => "Método no permitido."]);
    }
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
?>
