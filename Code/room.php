<!DOCTYPE html>
<html>
<head>
    <title>Book a Room</title>
    <link rel="stylesheet" type="text/css" href="hotelBooking.css">
    <link href="https://fonts.googleapis.com/css?family=Mada:300,400,600,700" rel="stylesheet">
</head>
<body>
    <div id="rooms" class="section">
    <?php
    if(isset($_GET['hotelid'])){
    $hotelid = $_GET['hotelid'];
    '<br>';
}
    $con = mysqli_connect('localhost','form_user','hbs','hotel_booking');
    if (!$con) {
        die('Could not connect: ' . mysqli_error($con));
    }

    global $db;

    mysqli_select_db($con,"room");
    //$sql = "SELECT * FROM hotel WHERE Htl_city_id = '" .$q."'";
    $sql ="SELECT * FROM 'room' WHERE 'Rm_Hotel_id = '$hotelid''";
    $result = mysqli_query($con,$sql);

          if (mysql_num_rows($result) > 0) {
              // output data of each row
              echo"<table name='room' id='select_rm'>";
              echo"<tr><th>Room</th><th>Smoking Allowed:</th><th>Free Parking:</th><th>Free Breakfaast:</th><th>Free Internet:</th><th></th></tr>";
              while($row = mysql_fetch_assoc($result) {
                  $yesS = "no";
                  $yesP = "no";
                  $yesB = "no";
                  $yesI = "no";
                  if($row['Rm_smoke']==1){
                      $yesS = "yes";
                  }
                  if($row['Rm_free_barking']==1){
                      $yesP = "yes";
                  }
                  if($row['Rm_free_breakfast']==1){
                      $yesB = "yes";
                  }
                  if ($row['Rm_free_internet']==1) {
                     $yesI = "yes";
                  }
                  echo "<tr value=" .$row["room_type_id"]. "><td>" .$row['Rm_name']."</td><td>" .$yesS."</td><td>". $yesP."</td><td>" . $yesB."</td><td>" .$yesI."</td><td><input type='button' value='View'></td></tr>";
              }
          }

    mysqli_close($con);
    ?>
    </table>
    </div>
</body>
</html>
