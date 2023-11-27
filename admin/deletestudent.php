<?php
session_start();
@$us=$_SESSION['us'];


$message="";
$sroll="";
$ssroll="";
//variables
$fname="";
$lname="";
$fmname="";
$dob="";
$blood="";
$gender="";
$caste="";
$adhar="";

$clgname="";
$regno="";
$course="";
$rollno="";
$coursedur="";
$pymark="";
$joindate="";
$stay="";

$mobno="";
$pmobno="";
$regemail="";
$paddress="";
$country="";
$state="";
$district="";
$pincode="";
$roomno="";

//connection
$con=new mysqli("localhost","root","","hostel");
if($con->connect_error)
{
    echo"<script>alert('Could Not Connect');</script>";
    // exit;
    echo"<script>window.location.href='http://localhost/hostel/home/load.html';</script>";
}


if(isset($_POST['search']))
{
    $sroll=$_POST['sroll'];
    $ssroll=strval($sroll);
    if($ssroll=="")//checking if search box is empty
    {
        $message='<b style="color:rgba(256,0,0,1);"><i class="fa fa-warning"> </i> Enter the Register number in search box to Delete</b>';
    }
    else
    {
        $qry="select * from stregister where regno='".$sroll."' and student_status='ACTIVE'";
        $rslt=$con->query($qry);
        if($rslt->num_rows<=0)//finding the student
        {
            $message='<b style="color:rgba(256,0,0,1);"><i class="fa fa-warning"> </i> Student with that Register number not found</b>';
        }
        else
        {   
            $message='<b style="color:green;"><i class="fa fa-circle-check"> </i> Record Found</b>';
            $r=$rslt->fetch_assoc();

            $fname=$r['fname'];
            $lname=$r['lname'];
            $fmname=$r['fmname'];
            $dob=$r['dob'];
            $blood=$r['blood'];
            $gender=$r['gender'];
            $caste=$r['caste'];
            $adhar=$r['adhar'];

            $clgname=$r['clgname'];
            $regno=$r['regno'];
            $course=$r['course'];
            $rollno=$r['rollno'];
            $coursedur=$r['coursedur'];
            $pymark=$r['pymark'];
            $joindate=$r['joindate'];
            $stay=$r['stay'];

            $mobno=$r['mobno'];
            $pmobno=$r['pmobno'];
            $regemail=$r['email'];
            $paddress=$r['paddress'];
            $country=$r['country'];
            $state=$r['state'];
            $district=$r['district'];
            $pincode=$r['pincode'];
            $roomno=$r['roomno'];
        }
    }
}
if(isset($_POST['delete']))
{
    $fname=$_POST['fname'];
    $regemail=$_POST['regemail'];
    $room_id=$_POST['roomno'];

    if($regemail=="")//cannot update directly
    {
        $message='<b style="color:rgba(256,0,0,1);"><i class="fa fa-warning"> </i> Please Search the Register number to Delete</b>';
    }
    else
    {
        $qry="update stregister set student_status='OLD_STUDENT' where email='".$regemail."'";                    
        

        if($con->query($qry))
        {
            // echo"<script>alert('Room Deleted Successfully');</script>";
            $rqry="select * from mroom where roomno='".$room_id."'";
            $rrslt=$con->query($rqry);

            $s1=$rrslt->fetch_assoc();
            @$total_filled=$s1['filled'];
            @$room_status=$s1['status'];
            $total_filled=$total_filled-1;
            // echo"<script>alert('".$room_id,$room_status,$total_filled."');</script>";
            if($room_id=="Not Assigned")
            {
                $zzzzz="zzzzzz";
            }
            elseif($room_status=='FULL')
            {
                $urqry="update mroom set filled='$total_filled', status='AVAILABLE' where roomno='".$room_id."'";
                $con->query($urqry);
            }
            else
            {
                $urqry="update mroom set filled='$total_filled' where roomno='".$room_id."'";
                $con->query($urqry);
            }
            

            $message='<b style="color:green;"><i class="fa fa-circle-check"> </i> Deleted Successfully</b>';
            $fname="";
            $lname="";
            $fmname="";
            $dob="";
            $blood="";
            $gender="GENDER";
            $caste="";
            $adhar="";
            
            $clgname="";
            $regno="";
            $course="COURSE";
            $rollno="";
            $coursedur="";
            $pymark="";
            $joindate="";
            $stay="";
            
            $mobno="";
            $pmobno="";
            $regemail="";
            $paddress="";
            $country="";
            $state="";
            $district="";
            $pincode="";
            $roomno="";
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
    <link rel="stylesheet" href="deletestudent.css">
    <link rel="stylesheet" href="fontawesome-free-6.4.0-web/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <style>
        input{
            text-align:center;
            text-transform:uppercase;
        }
    </style>


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
<h1 class="h1">Delete Student</h1>
<a  class="logout" href="http://localhost/hostel/home/load.html">  LOG OUT   <i class="fas fa-sign-out-alt"></i> </a>
</div>

<form method="post" action="">
<label style="margin-left:290px;"><?php echo $message; ?></label>
<div class="search">
   <input type="text" name="sroll" placeholder="SEARCH REGISTER NO" oninput="vInput(event)">
   <button name="search" style="right:320px;" ><i class="fas fa-search" style="font-size:23px;"></i></button>
</div>




<div class="container">

    <form action="" method="post">
        <!-- <div class="logo">
        <h1 class="hdng">REGISTER</h1>
        </div> -->

        <div class="pd">

            <div class="pdalign">


                    <input class="name" type="text" value="<?php echo $fname; ?>" name="fname" readonly placeholder="FIRST NAME" >
                    <input class="fname" type="text" value="<?php echo $lname; ?>" name="lname" readonly placeholder="LAST NAME" >
                    <input class="fname" type="text" value="<?php echo $fmname; ?>" name="fmname" readonly placeholder="FATHER/MOTHER NAME">
                    <input class="dob" type="text" value="<?php echo $dob; ?>" readonly name="dob" title="BIRTH DATE" placeholder="DATE OF BIRTH" >
                    <input class="name" type="text" value="<?php echo $blood; ?>" name="blood" readonly placeholder="BLOOD GROUP" >
                    <!-- <select class="selalgn" name="gender"  title="Select Gender"> -->
                    <input class="fname" type="text" readonly placeholder="GENDER" value="<?php echo $gender; ?>">
                    
                    <input class="fname" type="text" placeholder="CASTE" value="<?php echo $caste; ?>" readonly name="caste" >
                
                <input class="fname" type="number"  value="<?php echo $adhar; ?>" readonly placeholder="AADHAR NUMBER" name="adhar" >

            
            </div>
            
            
        </div>

        </div>
        <div class="eq">
            <div class="eqalign">
            <input class="name" type="text" value="<?php echo $clgname; ?>" readonly placeholder="COLLEGE NAME" name="clgname" >
            <input class="fname" type="number" value="<?php echo $regno; ?>" readonly placeholder="REGISTER NUMBER" name="regno" >
            <input class="fname" type="text" value="<?php echo $course; ?>" readonly placeholder="COURSE" name="course" >
            
            
                <input class="fname" type="number" value="<?php echo $rollno; ?>" readonly placeholder="ROLL NUMBER" name="rollno">
                <input class="name" type="number" value="<?php echo $coursedur; ?>" readonly placeholder="  COURSE DURATION" name="coursedur" >
                <input class="fname" type="number" value="<?php echo $pymark; ?>" readonly placeholder="LAST YEAR MARKS(%)" name="pymark" >
                <input class="join" type="text" value="<?php echo $joindate; ?>" title="JOINING DATE" readonly placeholder="JOINING DATE" name="joindate" >
                <input class="fname" type="text" value="<?php echo $stay; ?>" readonly placeholder="STAY DURATION" name="stay" >
                <input class="fname" type="text" value="<?php echo $roomno; ?>" readonly placeholder="ROOM NUMBER" name="roomno" >
                
                
                </div>
                
        </div>
        <div class="ad">
            <div class="adalign">
                    <input class="name" type="number" value="<?php echo $mobno; ?>" readonly min="1000000000" max="9999999999" placeholder="MOBILE NUMBER" name="mobno" >
                    <input class="fname" type="number" value="<?php echo $pmobno; ?>" readonly min="1000000000" max="9999999999" placeholder="PARENT'S MOB NO" name="pmobno" >
                    <input class="dob" type="email" value="<?php echo $regemail; ?>" readonly placeholder="EMAIL" name="regemail" readonly>
                    <input class="fname" type="text" value="<?php echo $paddress; ?>" readonly placeholder="PERMANENT ADDREESS" name="paddress" >
                    <input class="name" type="text" value="<?php echo $country; ?>" readonly placeholder="COUNTRY" name="country" >
                    <input class="fname" type="text" value="<?php echo $state; ?>" readonly placeholder="STATE" name="state" >
                    <input class="dob" type="text" value="<?php echo $district; ?>" readonly placeholder="DISTRICT" name="district" >
                    <input class="fname" type="number" value="<?php echo $pincode; ?>" readonly placeholder="PINCODE" name="pincode" >
                
                </div>
                
        </div>
    

        <!-- <div class="balgn">
        <button class="signin">SIGN IN</button>
        <button class="back">BACK</button>
    </div> -->
        
</div>


          

            <div class="button"></div>
            <button class="btn1" name="delete">DELETE</button>
            </form>
            <a class="btn2" href="managestudent.html">BACK</a>
            


        </div>
    </div>
</div>

    


</div>


</div>
</body>
</html>