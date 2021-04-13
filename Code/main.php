<!DOCTYPE html>
<html>
<head>
<script>
function showCity(str) {
  document.getElementById("resultProvinceValue").innerHTML = str;
  if (str=="") {
    document.getElementById("resultProvinceValue").innerHTML="";
    return;
  }
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("resultProvinceValue").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","getcity.php?q="+str,true);
  xmlhttp.send();
}
</script>
</head>
<body>

<p>Choose a province :</p>
<select name="Province" id="select_province" onchange="showCity(this.value)">
      <?php
      $servername = "localhost";
      $username =   "form_user";
      $password =   "hbs";
      $dbname =     "hotel_booking";
      $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }

      $sql = "SELECT prv_id, prv_name FROM province;";

      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
              echo "<option value=". $row["prv_id"].">" . $row['prv_name'] . "</option>";
          }
      } else {
          echo "0 results";
      }

      $conn->close();
      ?>
</select>
<p>Your choice is: </p><p id="resultProvinceValue"></p>

 </body>
</html>
