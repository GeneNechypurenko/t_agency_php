<?php
include_once("functions.php");

$hotelId = intval($_GET['hotel_id'] ?? 0);

if ($hotelId > 0) {
    $mysqli = connect();
    $stmt = $mysqli->prepare("SELECT imagepath FROM images WHERE hotelid = ?");
    $stmt->bind_param("i", $hotelId);
    $stmt->execute();
    $result = $stmt->get_result();
    $photos = [];

    while ($row = $result->fetch_assoc()) {
        $photos[] = $row;
    }

    echo json_encode($photos);
    $stmt->close();
}
?>
