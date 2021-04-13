<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="hotelBooking.css">
    <link href="https://fonts.googleapis.com/css?family=Mada:300,400,600,700" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
    <title> DISCOVER CANADA!!!!</title>
    <script>
    function showSection(val,nextSec) {
      document.getElementById(nextSec).innerHTML = val;

      if (val=="") {
        document.getElementById(nextSec).innerHTML="";
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
          document.getElementById(nextSec).innerHTML=this.responseText;
        }
      }
      xmlhttp.open("GET","getOption.php?q="+val,true);
      xmlhttp.send();
    }
    </script>
    <script>
    function init(){
        var dateOb = new Date();
        var dateStr1 = dateOb.getFullYear() + "-" + (dateOb.getMonth() + 1) + "-" + dateOb.getDate();
        var dateStr2 = dateOb.getFullYear() + "-" + (dateOb.getMonth() + 1) + "-" + dateOb.getDate();
        document.getElementById("arrival").value = dateStr1;
        document.getElementById("arrival").setAttribute("min", dateStr1);
        document.getElementById("depart").setAttribute("min", dateStr2);
    }
    </script>
    </head>

    <body onload="init()">

        <form method="GET"action="room.php">
<div class="section">
    <div class="flex-container">
       
        <h1>DISCOVER CANADA!!</h1>
</div>
<div class="mem-container">
    <input type="button" value="Register" onclick="openRegister()">
    <div id="newMem" class="item"></div>
    <input type="button" value="Sign In" onclick="openSignIn()">
    <div id="oldMem" class="item"></div>
</div>
    <script>
    var newMember = document.getElementById('newMem');
    var oldMember = document.getElementById('oldMem');
    function openRegister(){
        oldMember.style.display = "none";
        newMember.style.display = "block";
        newMember.innerHTML = "<input type='text' placeholder='First Name'><br><br><input type='text' placeholder='Last Name'><br><br><input type='email' placeholder='Email'><br><br><input type='password' placeholder='Password'><br><br><input type='password' placeholder='Confirm Password'>"
    }
    function openSignIn(){
        newMember.style.display = "none";
        oldMember.style.display = "block";
        oldMember.innerHTML = "<input type='email' placeholder='Email'><br><br><input type='password' placeholder='Password'>";
    }
    </script>
</div>
<div class="section">
    <p>
        <label for="arrival">*Arrival Date</label>
        <input type="date" id="arrival" name="arrival" onchange="checkDate()">
        <label for="depart">*Departure Date</label>
        <input type="date" id="depart" name="depart" onchange="checkDate()" data-validation="date required">
        <p id="date"> </p>
        <br>
        <label for="numAdult">*Number of Adults (Max of 5)</label>
        <input type="number" min="1" max="5" id="numAdult" name="numAdult" data-validation="number required" data-validation-allowing="range[1;4]">
        <br>
        <br>
        <label for="numChild">*Number of Children (Max of 10 ages 0-12)</label>
        <input type="number" min="0" max="10" id="numChild" name="numChild" data-validation="number required" data-validation-allowing="range[0;11]">
    </p>
    <script>
    function checkDate() { // checks if the user put in the same depart date as arrival
        var arrival = document.getElementById('arrival').value;
        var depart = document.getElementById('depart').value;
        var dateArrive = new Date(arrival);
        var dateDepart = new Date(depart);

        if (dateDepart.valueOf() == dateArrive.valueOf()) { //sends warning message to user
            document.getElementById('date').innerHTML = "Depart date cannot be same day as arrival";
        } else {
            document.getElementById('date').innerHTML = ""; //get rid of message if entry is okay
        }
    }
        $("[type='number']").keypress(function(evt) {
            evt.preventDefault();
        });
        $.validate({
            onError: function($form) {
                alert('Validation of form ' + $form.attr('id') + ' is missing or is wrong.');
            }
        });
    </script>
</div>
<div class="section">
    Province<br>
    <select name="Province" id="select_province" onchange="showSection(this.value,'city')">
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

          $sql = "SELECT prv_id, prv_name FROM province ORDER BY prv_name";

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
    </select><br> <br>
    <div id="city"></div>
</div>

<div class ="section">
    <input type="button" value="Search" onclick="showSection(document.getElementById('select_city').value,'hotel')">
    <br><div id="hotel"></div>
     </div>
</form>
</body>
</html>
