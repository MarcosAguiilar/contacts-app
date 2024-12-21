<?php

require "database.php";

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    http_response_code(400);
    echo "Invalid ID";
    return;
}

$id = (int)$_GET["id"]; // Asegurar que sea un número entero

try {
    $statement = $conn->prepare("DELETE FROM contacts WHERE id = :id");
    $statement->execute([":id" => $id]);

    if ($statement->rowCount() == 0) {
        http_response_code(404);
        echo "HTTP 404 NOT FOUND";
        return;
    }

    header("Location: index.php");
    exit();
} catch (PDOException $e) {
    http_response_code(500);
    echo "Database error: " . $e->getMessage();
}
