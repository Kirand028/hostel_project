<?php
    $message="";
    $rno="";
    $seat="";
    $sts="";
    $rf="";
    session_start();

    @$us=$_SESSION['us'];
    $con=new mysqli("localhost","root","","hostel");
    if($con->connect_error)
    {
        echo"<script>alert('Could Not Connect');</script>";
        // exit;
        echo"<script>window.location.href='http://localhost/hostel/home/load.html';</script>";
    }

    if(isset($_POST['search']))
    {
        $rno="";
        $roomno=$_POST['roomno'];    

        $ro=strval($roomno);
        if($ro=="")
        {
            $message='<b style="color:red;"><i class="fas fa-warning"> </i> Enter the roomno in the search box</b>';
        }
        else
        {
            // $_SESSION['dtrno']=$roomno;
            $qry="select * from mroom where roomno='".$roomno."'";
            $rslt=$con->query($qry);
        
            if($rslt->num_rows>0)
            {
                $r=$rslt->fetch_assoc();
                $seat=$r['seater'];
                $sts=$r['status'];
                $rf=$r['roomfor'];
                $rno=$r['roomno'];
                $message='<b style="color:green;"><i class="fas fa-check-circle"> </i> Found</b>';
            }
            else
            {
                $rno="";
                $message='<b style="color:red;"><i class="fas fa-warning"> </i> Not Found</b>';
            }
        }
    }
    if(isset($_POST['delete']))
    {
        // $dtrno=$_SESSION['dtrno'];
        $rmno=$_POST['rmno'];
        $rmseat=$_POST['rmseat'];
        $rmst=$_POST['rmst'];
        $rmfor=$_POST['rmfor'];
        $butt=$_POST['delete'];
        if($rmno=="")
        {
            $message='<b style="color:rgba(256,0,0,1);"><i class="fas fa-warning"> </i> Search the Room Number to Delete</b>';
        }
        else
        {
            $roomqry="INSERT IGNORE INTO mroom (roomno, seater, roomfor, status, filled)
            VALUES ('Not Assigned', 0, 'none', 'none', 0)";


            $qry="delete from mroom where roomno='".$rmno."'";                    
            $sqry="update stregister set roomno='Not Assigned' where roomno='".$rmno."' and student_status='ACTIVE'";

            if($con->query($roomqry)&&$con->query($sqry)&&$con->query($qry))
            {
                // echo"<script>alert('Room Deleted Successfully');</script>";
                $message='<b style="color:green;"><i class="fas fa-check-circle"> </i> Deleted Successfully</b>';
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
    <link rel="stylesheet" href="deleteroom.css">
    <link rel="stylesheet" href="fontawesome-free-6.4.0-web/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <title>Document</title>
    <script>

            function vInput(event) {
            const input = event.target;
            const value = input.value;
            const sanitizedValue = value.replace(/[^a-zA-Z0-9]/g, '');
            input.value = sanitizedValue;
            }
    </script>


</head>
<body>

<label style="margin-left:200px;margin-top:80px;"><?php echo $message; ?></label>
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
<h1 class="h1">Delete Rooms</h1>
<a  class="logout" href="http://localhost/hostel/home/load.html">  LOG OUT   <i class="fas fa-sign-out-alt"></i> </a>
</div>

<form method="post" action="">
<div class="search">
   <input type="text" placeholder="SEARCH" style="text-transform:uppercase;" name="roomno" oninput="vInput(event)">
   <button name="search" ><i class="fas fa-search"></i></button>
</div>

<div class="cardcontainer">
    <div class="card">
        <div class="input">
            <input class="input1" name="rmno" style="text-transform:uppercase;" value="<?php echo $rno; ?>" type="text"  placeholder="ROOM NUMBER" readonly>
            <input class="input2" name="rmseat" value="<?php echo $seat; ?>" type="text" placeholder="TOTAL SEATER" readonly>

            <input type="text" class="select1" name="rmst" value="<?php echo $sts; ?>" id="" placeholder="STATUS" readonly>
                <!-- <option>AVAILABLE</option>
                <option>FULL</option> -->
            <!-- </select> -->

            
            <input type="text" class="select2" name="rmfor" value="<?php echo $rf; ?>" id="" placeholder="ROOM FOR" readonly>
                <!-- <option >BOYS</option>
                <option>GIRLS</option> -->
            <!-- </select> -->

          

            <div class="button"></div>
            <button name="delete" class="btn1">DELETE</button>
            </form>
            <a class="btn2" href="manageroom.html">BACK</a>
            


        </div>
    </div>
</div>

    


</div>


</div>
<div class="tip" style="margin-top:1120px;margin-left:200px;position:absolute"><i class="fas fa-warning"> </i> when you delete room, If Students are present in the room, their room number will be updated as "Not assigned"</div>
</body>
</html>