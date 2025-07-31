<?php
header("Content-Type: application/json; charset=UTF-8");
$weapons = file_get_contents("weapons.json");
if ($weapons === false) {
    http_response_code(500);
    echo json_encode(["error" => "Failed to read weapons file."]);
    exit;
}
echo $weapons;