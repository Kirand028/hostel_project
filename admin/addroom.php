<?php
$message='<b><i class="fas fa-circle-info"> </i> Add Room </b><span style="color:gray;opacity:50%;">  (B1* for boys, G1* for girls)</span>';
session_start();
@$us=$_SESSION['us'];
if(isset($_POST['add']))
{
        $roomno=$_POST['roomno'];
        $seater=$_POST['seater'];
        $roomfor=$_POST['roomfor'];
        $status="AVAILABLE";
        $filled=0;
        // $studentsinroom="";
          //setting connection and checking for existence of room
        $con=new mysqli("localhost","root","","hostel");
        if($con->connect_error)
        {
            echo"<script>alert('Could Not Connect');</script>";
            // exit;
            echo"<script>window.location.href='http://localhost/hostel/home/load.html';</script>";
        }
        $qry="select * from mroom where roomno='".$roomno."'";
        $idrslt=$con->query($qry);
        if($idrslt->num_rows>0)
        {
            $message='<b style="color:red;"><i class="fas fa-warning"> </i> Room with this number already exists<b>';
            // echo"<script>alert('**Room with this number already exist**');</script>";
            // echo"<script>window.location.href='home.html';</script>";
        }
        else
        {
            //inserting to room to table
            $qry="insert into mroom values('".$roomno."','".$seater."','".$roomfor."','".$status."','".$filled."')";
            $ins=$con->query($qry);
            if($ins)
            {
                // echo"<script>alert('Room added successfully.');</script>";
                $message='<b style="color:green;"><i class="fas fa-check-circle"> </i> Room Added Successfully</b>';
                
            }
        }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="addroom.css">
    <link rel="stylesheet" href="fontawesome-free-6.4.0-web/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <title>Document</title>
</head>
<script>
      function validateInput(event) {
  const input = event.target;
  const value = input.value;
  const sanitizedValue = value.replace(/[^a-zA-Z0-9]/g, '');
  input.value = sanitizedValue;
}

</script>
<body>
    <label class="msg"><?php echo $message; ?></label>
    <form method="post" action="" autocomplete="off">
    <div class="admin">    
    <i class="fa fa-wallet"></i>
        <h1>ADMIN</h1>
    </div>

    <div class="sidebar">
        <div class="info" style="overflow:hidden;">
            <div class="img"></div>
            <labe class="hiadmin">Hi,<span>Admin</span></label>
            <div class="emma" ><label class="email" for="">dkiran@gmail.com</label></div>
        </div>
    <div class="menu">
        

            <a href="admindashboard.php"><i class="fas fa-home"></i>  DASHBOARD</a>
            <a href="managestudent.html"><i class="fas fa-user"></i>  MANAGE STUDENT</a>
            <a href="managewarden.html"><i class="fas fa-user-tie"></i>  MANAGE WARDEN</a>
           
            <a href="manageroom.html" ><i class="fas fa-chair"></i>  MANAGE ROOM</a>
            <a href="managefood.php"><i class="fas fa-burger"></i>  MANAGE FOOD</a>
            <a href="manageevent.php"><i class="fas fa-calendar"></i>  MANAGE EVENT</a>
            <a href="spayment.php"><i class="fas fa-bank"></i>  PAYMENT</a>
            
    </div>
</div>


<div class="navbar">
<h1 class="h1">Add Rooms</h1>
<a  class="logout" href="http://localhost/hostel/home/load.html">  LOG OUT   <i class="fas fa-sign-out-alt"></i> </a>
</div>

<div class="cardcontainer">

    <div class="card">
        <div class="input">
            <input class="input1" type="text" style="text-transform:uppercase;" required  name="roomno" placeholder="ROOM NUMBER" oninput="validateInput(event);">
            <input class="input2" type="number" required min="1" max="4" name="seater" placeholder="TOTAL SEATER" oninput="validateInput(event);">

            <select class="select1" name="status" id="" title="STATUS">
                <option value="">AVAILABLE</option>
                <!-- <option>FULL</option> -->
            </select>

            
            <select class="select2" name="roomfor"  id="" title="STATUS">
                <option>MALE</option>
                <option>FEMALE</option>
            </select>

          

            <div class="button"></div>
            <button name="add" class="btn1">ADD</button>
</form>
            <a class="btn2" href="manageroom.html">BACK</a>
            


        </div>
    </div>
</div>

    


</div>
</div>
</body>
</html>