<?php
session_start();
//$gend=$_SESSION['gen'];
$con = new mysqli("localhost", "root", "", "hostel");
if ($con->connect_error) {
  echo "<script>alert('Could Not Connect');</script>";
  //   exit;
  echo "<script>window.location.href='http://localhost/hostel/home/home.html';</script>";
}

if (isset($_GET['username'])) {
  @$us = $_GET['username'];
}

@$userid = $us;

$bqry = "select * from warden where email='".$userid."' or wid='".$userid."'";
$srslt = $con->query($bqry);
if ($srslt) {
  $f = $srslt->fetch_assoc();
  @$uid = $f['email'];
  @$name = $f['wname'];
  @$wid = $f['wid'];
}

$sqry = "select * from stregister where student_status='ACTIVE'";
$srslt = $con->query($sqry);
$nor = $srslt->num_rows;

// if (isset($_POST['calculate'])) {
//   $daysList = $_POST['days'];
//   $feeList = array();

//   $s_email = $_POST['calculate'];

//   foreach ($daysList as $days) {
//     $days = intval($days);
//     if ($days > 22 && $days <= 31) {
//       $mfee = 1500;
//     } else {
//       $mfee = 50 * $days;
//     }
//     $feeList[] = $mfee;

//   }
//   // echo'<script>alert("'.$s_email.'");</script>';
//   $pqry="update payment set month_meal_price='$'";
// }

$currentDate = date('d');

$sdate='2';
$edate='12';
// Check if today is the first day of the month
if ($currentDate >= $sdate and $currentDate<=$edate) 
{
  $abcd= '<i style="color:maroon;" class="fa fa-circle-info"></i> You can calculate the meal fees from '.$sdate.'st to '.$edate.'st in the month.';
}
else
{
  $abcd='<i style="color:maroon;" class="fa fa-circle-info"></i> You can calculate the meal fees from '.$sdate.'st to '.$edate.'st in the month.';
  echo '<script>document.addEventListener("DOMContentLoaded", function() { 
    var calculateBtns = document.querySelectorAll(".calculate");
    calculateBtns.forEach(function(btn) {
      btn.disabled = true;
      btn.innerHTML="Disabled";
    });
  });</script>';
}



if (isset($_POST['calculate'])) {
  $daysList = $_POST['days'];
  $feeList = array();
  $registerNumber = $_POST['calculate']; // Get the register number of the clicked button

  // Process the calculation for each student
  $srslt = $con->query($sqry); // Fetch the student records again
  for ($i = 0; $i < $nor; $i++) {
    $sr = $srslt->fetch_assoc();
    $regn = $sr['regno'];
    $semailid = $sr['email']; // Add this line to fetch the email ID

    // Check if the current student matches the register number of the clicked button
    if ($semailid === $registerNumber) {
      $days = intval($daysList[$i]);

      // Perform the fee calculation for the specific student
      if ($days > 22 && $days <= 31) {
        $mfee = 1500;
      } else {
        $mfee = 50 * $days;
      }

      // Set the calculated fee for the associated student
      $feeList[$i] = $mfee;
      // Set the value of the fee input field using JavaScript
      // echo '<script>document.getElementById("fee-' . $regn . '").value = ' . $mfee . ';</script>';
    }
  }
  // echo'<script>alert("'.$mfee.','.$registerNumber.'")</script>';
  $pqry="update payment set month_meal_price='$mfee' where email='$registerNumber'";
  if($con->query($pqry))
  {
    $finish="yes";
  }
  else
  {
    $finish="no";
  }

  echo"<script>window.location.href='cal_mealfee.php?username=$us';</script>";
  // echo'<script>alert('.$uid.');</script>';
  // echo'<script>window.location.href="cal_mealfee.php?username='.$uid.'";</script>';
  // header('location:cal_mealfee.php?username="'.$uid.'"');
  

}





?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="fontawesome-free-6.4.0-web/css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <title>Meal Fee Calculator</title>
  <style>
    body {
      background: linear-gradient(160deg, #f0f1f4 0%, #e4e6eb 100%);
    }

    .total {
      display: flex;
      align-items: center;
      justify-content: center;
      height: auto;
      font-family: Arial, sans-serif;
      margin-top: 10px;
    }

    .body {
      height: 500px;
      font-family: Arial, sans-serif;
      overflow-y: scroll;
      border-radius: 15px;
      background: linear-gradient(160deg, #f0f1f4 0%, #e4e6eb 100%);
    box-shadow: -3px -3px 6px 2px #ffffff,
    5px 5px 8px 0px rgba(0, 0, 0, 0.17), 
    1px 2px 2px 0px rgba(0, 0, 0, 0.1);
  transition: .4s ease-in-out;
    }

    .container {
      /* border-radius: 15px;
      background: linear-gradient(160deg, #f0f1f4 0%, #e4e6eb 100%);
    box-shadow: -3px -3px 6px 2px #ffffff,
    5px 5px 8px 0px rgba(0, 0, 0, 0.17), 
    1px 2px 2px 0px rgba(0, 0, 0, 0.1);
  transition: .4s ease-in-out; */
      padding: 20px;
      text-align: center;
    }

    .hello{
        padding:30px;
        margin-left:80px;
    }

    h1 {
      color: #333;
      margin-top: 0;
    }

    table {
      margin: 0 auto;
      border-collapse: collapse;
    }

    th, td {
      padding: 10px;
      border: 1px solid #ccc;
    }

    th {
      background-color: #f0f0f0;
      color:maroon;
      font-weight: bold;
      position: sticky;
      top: 0;
    }

    .input-container {
      margin-bottom: 20px;
    }

    label {
      font-weight: bold;
    }

    input {
      padding: 7px;
      border: none;
      border-radius: 5px;
      width: 170px;
      background: linear-gradient(160deg, #f0f1f4 0%, #e4e6eb 100%);
    box-shadow: -3px -3px 6px 2px #ffffff,
    5px 5px 8px 0px rgba(0, 0, 0, 0.17), 
    1px 2px 2px 0px rgba(0, 0, 0, 0.1);
    text-align:center;
    text-transform:capitalize;
    }

    button {
      padding: 10px 20px;
      color: black;
      font-weight: bold;
      cursor: pointer;
      border-radius: 10px;
      border: none;
      outline: none;

      background: linear-gradient(160deg, #f0f1f4 0%, #e4e6eb 100%);
    box-shadow: -3px -3px 6px 2px #ffffff,
    5px 5px 8px 0px rgba(0, 0, 0, 0.17), 
    1px 2px 2px 0px rgba(0, 0, 0, 0.1);
    }

    button:active {
      outline:none;
      background: linear-gradient(160deg, #f0f1f4 0%, #e4e6eb 100%);
      box-shadow: 3px 3px 6px 2px #ffffff,
      -5px -5px 8px 0px rgba(0, 0, 0, 0.17), 
      1px 2px 2px 0px rgba(0, 0, 0, 0.1);

        border: 1px inset green;
        color: red;
}


    #fee {
      font-weight: bold;
    }

    .icontainer{
    /* display: flex;
    justify-content: center;
    align-items: center; */
    position: relative;

  }
.iholder{
    width: 100px;
    height: 100px;
    background-color: rgb(230, 231, 233);
 
    box-shadow: 
    
    4px 4px 7px rgb(189 200 213),
  
    -4px -4px 7px rgb(255 255 255);
    border-radius: 150px;
    position: absolute;
    /* top: -20px; */
    /* left: 700px; */
    display: flex;
    justify-content: center;
    align-items: center;
}

.iholder1{
    width: 85px;
    height: 85px;
    background-image: url(staff3.png);
    background-repeat: no-repeat;
    background-size: contain;
    /* background-color: rgb(230, 231, 233); */
    box-shadow: 
    
    4px 4px 7px rgb(189 200 213),
  
    -4px -4px 7px rgb(255 255 255);
    border-radius: 130px;
}

.label{
  text-align:center;
  margin-top:10px;
  font-size:16px;
  font-weight:bold;
}
a{
  color:maroon;
  font-size:17px;
}

  </style>
</head>
<body>
<div class="icontainer">
    <div class="iholder">
        <div class="iholder1"></div>
    </div>
<div>
<h1 class="hello">Hello, <span style="color:maroon;"> <?php echo ucfirst($name); ?></span></h1>


<div class="total">
  <div class="body">
    <div class="container">
      <h1 >Month Meal Fee Calculator</h1>
      <form action="" method="post">
        <table>
          <tr>
            <th>Register Number</th>
            <th>Name</th>
            <th>Number of Days</th>
            <th>Meal Fee</th>
            <th>Calculate</th>
          </tr>
          <?php
            $sqry = "select * from stregister where student_status='ACTIVE'";
            $srslt = $con->query($sqry);
            $nor = $srslt->num_rows;
            

            for($i=0;$i<$nor;$i++)
            {
            $sr = $srslt->fetch_assoc();
            $regn = $sr['regno'];
            $sname = $sr['fname'];
            $semailid=$sr['email'];

            $pqry="select * from payment where email='".$semailid."'";
            if($f=$con->query($pqry))
            {
              $fetch=$f->fetch_assoc();
              $old_fees=$fetch['month_meal_price'];
            }

            echo '<tr title="'.$semailid.'">';
            echo '<td><input type="text" name="register-number[]" value="' . $regn . '" readonly></td>';
            echo '<td><input type="text" name="name[]" value="' . $sname . '" readonly></td>';
            echo '<td><input type="number" name="days[]" min="1" max="31" placeholder="Number Of Days"></td>';
            echo '<td>&#8377; <input type="number" name="fee[]" id="fee-' . $regn . '" readonly value="'.$old_fees.'" ></td>';
            // echo '<td>&#8377; <input type="number" name="fee[]" readonly value="' . $mfee . '"></td>';
            echo'<td><button class="calculate" name="calculate" value="'.$semailid.'" >Calculate</button></td>';
            echo '</tr>';
              
            }
          ?>
        </table>
        
      </form>
    </div>
  </div>

</div>
<div class="label"><label for=""><?php echo $abcd; ?></label>
<a href="wardendashboard.php?username=<?= $uid ?>">BACK</a>
</div>
</body>
</html>
