<?php
$con =mysqli_connect("localhost" , "form_user" , "hbs" , "hotel_booking");
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}


$selected = mysqli_select_db($con,"city");
$choice = mysql_real_escape_string($_GET['choice']);
?>
<!DOCTYPE html>
<html>
<body>
	<form name="form1" action="" method="get">
		<table>
			<tr>
				<td>SELECT CITY</td>
				<td>
					<select>
					<option>select</option>
					<?php
					$query = "SELECT * FROM city WHERE city_name = '$choice'";
					$result1 = mysqli_query($con, $query);

  
          while($row = mysqli_fetch_array($result)) {
          echo "<option>" . $row{'city'} . "</option>";
      }
      ?>

     
				</select>
					
				</td>
			</tr>
		</table>







mysqli_close($con);
?>
</form>