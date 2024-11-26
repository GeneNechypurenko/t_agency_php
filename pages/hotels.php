<?php
include_once("functions.php");

$cityId = intval($_GET['cityid'] ?? 0);

if ($cityId > 0) {
    $mysqli = connect();
    $stmt = $mysqli->prepare("SELECT id, hotel, cost, stars FROM hotels WHERE cityid = ? ORDER BY hotel");
    $stmt->bind_param("i", $cityId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<table class="table table-striped">';
        echo '<thead><tr><th>Отель</th><th>Цена</th><th>Звезды</th><th>Детали</th></tr></thead>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['hotel']) . '</td>';
            echo '<td>$' . $row['cost'] . '</td>';
            echo '<td>' . str_repeat('⭐', $row['stars']) . '</td>';
            echo '<td><a href="pages/hotelinfo.php?hotel=' . $row['id'] . '" class="btn btn-info btn-sm">Подробнее</a></td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p>Нет отелей в выбранном городе.</p>';
    }

    $stmt->close();
}
?>
