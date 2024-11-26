<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Hotel Info</title>
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/info.css">
	</head>
<body>
<?php
include_once ("functions.php");
if(isset($_GET['hotel']))
{
	$hotel=$_GET['hotel'];
	$mysqli = connect();
	$sel='select * from hotels where id='.$hotel;
	$res=$mysqli->query($sel);
	$row=mysqli_fetch_array($res, MYSQLI_NUM);
	$hname=$row[1];
	$hstars=$row[4];
	$hcost=$row[5];
	$hinfo=$row[6];
	mysqli_free_result($res);
	echo '<h2 class="title">'.$hname.'</h2>';
    echo '<div class="container">';
    echo '<div class="stars">';
    for ($i=0; $i<$hstars; $i++)
    {
        echo '<img src="../images/star.png" alt="star">';
    }
    echo '</div>';
	$mysqli = connect();
	$sel='select imagepath from images where hotelid='.$hotel;
	$res=$mysqli->query($sel);
	echo'<ul id="gallery">';
	$i=0;
	while($row=mysqli_fetch_array($res, MYSQLI_NUM))
	{
		echo '<li><img src="../'.$row[0].'"></li>';
	}
	mysqli_free_result($res);
	echo '</ul>';

	echo '<h2 class="text-center">Cost&nbsp;<span class="label label-info">'
	.$hcost.' $</span>';
	echo '<a href="#" class="btn btn-success">Book This Hotel</a></h2>';
	echo '</div><p class="well">'.$hinfo.'</p>';
	echo '</div>';
}
 ?>

<script src="../js/jquery-3.1.0.min.js"></script>
<script src="../js/gallery.js"></script>
<script src="../js/info2.js"></script>
</body>
</html>