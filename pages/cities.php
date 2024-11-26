<?php
include_once("functions.php");

$countryId = intval($_GET['countryid'] ?? 0);

if ($countryId > 0) {
    $mysqli = connect();
    $stmt = $mysqli->prepare("SELECT id, city FROM cities WHERE countryid = ? ORDER BY city");
    $stmt->bind_param("i", $countryId);
    $stmt->execute();
    $result = $stmt->get_result();
    $cities = [];

    while ($row = $result->fetch_assoc()) {
        $cities[] = $row;
    }

    echo json_encode($cities);
    $stmt->close();
}
?>
