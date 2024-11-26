<h2>Добавить комментарий</h2>
<hr>
<?php
$mysqli = connect();

$sel = 'SELECT id, hotel FROM hotels ORDER BY hotel';
$res = $mysqli->query($sel);

echo '<form action="index.php?page=2" method="post">';
echo '<div class="form-group">';
echo '<label for="hotel">Выберите отель:</label>';
echo '<select name="hotel_id" class="form-control" required>';
while ($row = $res->fetch_assoc()) {
    echo '<option value="' . $row['id'] . '">' . htmlspecialchars($row['hotel']) . '</option>';
}
echo '</select>';
echo '</div>';
echo '<div class="form-group">';
echo '<label for="comment">Ваш комментарий:</label>';
echo '<textarea name="comment" class="form-control" rows="3" required></textarea>';
echo '</div>';
echo '<button type="submit" name="submit_comment" class="btn btn-primary">Отправить</button>';
echo '</form>';
mysqli_free_result($res);

if (isset($_POST['submit_comment'])) {
    $hotel_id = intval($_POST['hotel_id']);
    $comment = trim(htmlspecialchars($_POST['comment']));

    if (!empty($comment)) {
        $ins = "INSERT INTO comments (hotel_id, comment) VALUES ($hotel_id, '$comment')";
        $mysqli->query($ins);

        if ($mysqli->errno) {
            echo '<div class="alert alert-danger">Ошибка добавления комментария: ' . $mysqli->error . '</div>';
        } else {
            echo '<div class="alert alert-success">Комментарий успешно добавлен!</div>';
        }
    }
}

echo '<h3>Список комментариев</h3>';
$sel_comments = "SELECT c.comment, h.hotel 
                 FROM comments c 
                 JOIN hotels h ON c.hotel_id = h.id 
                 ORDER BY c.id DESC";
$res_comments = $mysqli->query($sel_comments);

echo '<table class="table table-striped">';
echo '<thead><tr><th>Отель</th><th>Комментарий</th></tr></thead>';
while ($row = $res_comments->fetch_assoc()) {
    echo '<tr><td>' . htmlspecialchars($row['hotel']) . '</td><td>' . htmlspecialchars($row['comment']) . '</td></tr>';
}
echo '</table>';
mysqli_free_result($res_comments);
?>
