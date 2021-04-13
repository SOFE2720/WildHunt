<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="hotelBooking.css">
    <link href="https://fonts.googleapis.com/css?family=Mada:300,400,600,700" rel="stylesheet">
</head>
<body>
<form method="GET" action="room.php">
  <select name="city" id="select_city">
<?php
$q =$_GET['q'];
'<br>';

$con = mysqli_connect('localhost','form_user','hbs','hotel_booking');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"city");
$sql="SELECT * FROM city WHERE 'city_province_id = $q' ORDER BY city_name";
$result = mysqli_query($con,$sql);


      if ($result->num_rows > 0) {
          // output data of each row
          echo "<select name='city' id='select_city'>";
          while($row = $result->fetch_assoc()) {
              echo "<option value=". $row["city_id"].">" . $row['city_name'] . "</option>";
          }
          echo"</select>";
      }
      else {
          echo "0 results";
      } 


mysqli_close($con);
?>

<?php
$q = intval($_GET['q']);
'<br>';

$con = mysqli_connect('localhost','form_user','hbs','hotel_booking');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"hotel");
//$sql = "SELECT * FROM hotel WHERE Htl_city_id = '" .$q."'";
$sql ="SELECT hotel.Hotel_id, Hotel_name, Hotel_Rate, Hotel_address, hotel_id, image FROM hotel INNER JOIN pictures ON hotel.Hotel_id = pictures.hotel_id WHERE hotel.Hotel_city_id = '".$q."' ORDER BY hotel.Hotel_Rate DESC";
$result = mysqli_query($con,$sql);


      if ($result && $result->num_rows > 0) {
          // output data of each row
          echo"<table name='hotels' id='select_hotel'>";
          echo "<tr><th></th><th>Hotel</th><th>Rating</th><th>Address</th><th></th></tr>";
          while($row = $result->fetch_assoc()) {
              echo "<input type='hidden' name='hotelid' value=". $row["Hotel_id"].">";

              echo "<tr><td><img src= 'data:image/png;base64," . base64_encode($row['image'])."'".
              "/></td><td>" .$row['Hotel_name'] . "</td><td>"
              . $row['Hotel_Rate'] . "</td><td>" . $row['Hotel_address'] .
              "</td><td><input type='submit' value='View' href='room.php'></td></tr>";
          }
          echo"</table>";
      }

mysqli_close($con);
?>
</form>
</body>
</html>
