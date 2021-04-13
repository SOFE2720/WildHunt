<!DOCTYPE html>
<html>
<body>
<p> Select a city </p>
<form>CITY:
<select name="city" id="select_city">
	<option disabled selected> --- select city ---</option>

<?php
$servername = "localhost";
          $username =   "form_user";
          $password =   "hbs";
          $dbname =     "hotel_booking";
          $con = new mysqli($servername, $username, $password, $dbname);
if(isset($_GET['q'])){
$q = $_GET['q'];
'<br>';
}
$con = mysqli_connect('localhost','form_user','hbs','hotel_booking');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}


    global $db;

mysqli_select_db($con,"city");
$sql="SELECT COUNT (*) From 'city' Where 'city_province_id' = '".$q."'";
$result = mysqli_query($con,$sql);


      if (mysqli_num_rows($result) > 0) {
          // output data of each row
      	echo "<table>";
      	echo "<tr>";
      	echo "<th> city name </th>";
      	echo "</tr>";
          while($row = mysqli_fetch_assoc($result)) {
              echo "<option value=". $row["city_id"].">" . $row['city_name'] . "</option>";
          }
      } else {
          echo "0 results";
      }


?>


</select>
</form>
<?php 
mysqli_close($con);
?>
</body>
</html>




